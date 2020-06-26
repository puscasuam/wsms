<?php

namespace App\Helper;

use App\Order;
use App\Order_type;
use App\Partner;
use App\Product;
use App\QueryFilters\Order\AmountFrom;
use App\QueryFilters\Order\AmountSort;
use App\QueryFilters\Order\AmountTo;
use App\QueryFilters\Order\DateFrom;
use App\QueryFilters\Order\DateSort;
use App\QueryFilters\Order\DateTo;
use App\QueryFilters\Order\FinalAmountSort;
use App\QueryFilters\Order\OrderType;
use App\QueryFilters\Order\Partner as PartnerFilter;
use App\QueryFilters\Order\PartnerSort;
use App\Sublocation;
use App\Transaction;
use Carbon\Carbon;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderHelper implements InterfaceHelper
{

    public function form($order = null, $type = 'new')
    {
        $orderTypes = Order_type::all();
        $partners = Partner::all();
        $products = Product::all();

        return view('/order/new', [
            'orderTypes' => $orderTypes,
            'partners' => $partners,
            'products' => $products,
            'type' => $type,
        ]);
    }


    /**
     * Get an order - used for view an order
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view(int $id)
    {
        $order = Order::find($id);
        if ($order) {

            return view('/order/view', [
                'order' => $order,
            ]);
        }
    }

    public function all(Request $request)
    {
        $orders = Order::all();
        $orderTypes = Order_type::all();
        $partners = Partner::all();
        $products = Product::all();

        if ($request->isMethod('get')) {
            $pipeline = app(Pipeline::class)
                ->send(Order::query())
                ->through([
                    PartnerFilter::class,
                    OrderType::class,
                    \App\QueryFilters\Order\Product::class,
                    AmountFrom::class,
                    AmountTo::class,
                    DateFrom::class,
                    DateTo::class,
                    PartnerSort::class,
                    AmountSort::class,
                    DateSort::class,
                ])
                ->thenReturn();

            $orders = $pipeline->paginate(6);;
        }

        if ($request->isMethod('post')) {
            $pipeline = app(Pipeline::class)
                ->send(Order::query())
                ->through([
                    PartnerFilter::class,
                    OrderType::class,
                    \App\QueryFilters\Order\Product::class,
                    AmountFrom::class,
                    AmountTo::class,
                    DateFrom::class,
                    DateTo::class,
                    PartnerSort::class,
                    PartnerSort::class,
                    AmountSort::class,
                    DateSort::class,
                ])
                ->thenReturn();

            $orders = $pipeline->paginate(6);;
        }

        return view('order/all', [
            'orders' => $orders,
            'orderTypes' => $orderTypes,
            'partners' => $partners,
            'products' => $products,
            'filters' => $request,
        ]);
    }

    public function post(Request $request)
    {
        $data = $request->validate([
            'order_type' => 'required',
            'partner' => 'required',
            'product' => 'required',
            'date' => 'required',
        ]);

        $order = new Order();
        $order->order_type_id = $request->order_type;
        $order->partner_id = $request->partner;
        $order->amount = $request->amount;
        $order->date = Carbon::parse(strtotime($request->date))->format('Y-m-d H:i:s');
        $order->final_amount = $request->amount;

        if ($request->order_type === '2') {

            if (isset($request->update_type) && isset($request->update_percentage) && isset($request->final_amount)) {
                $order->update_operation = $request->update_type;
                $order->update_percentage = $request->update_percentage;
                $order->final_amount = $request->final_amount;
            }
        }

        $order->save();

        //Create new transaction with status pending
        $transaction = new Transaction();
        $transaction->order_id = $order->id;
        $transaction->employee_id = Auth::user()->employee_id;
        $transaction->status_id = "1";
        $transaction->date = $order->date;
        $transaction->save();

        //for relations many to many + update stock and price in product table
        foreach ($request->product as $key => $product_id) {

            if (!is_null($product_id)) {
                if (isset($request->product_units[$key]) && isset($request->product_price[$key]) && intval($request->product_units[$key]) > 0) {
                    $order->products()->attach($product_id, ['units' => $request->product_units[$key], 'price' => $request->product_price[$key]]);

                    /** @var Product $product */
                    $product = Product::find($product_id);
                    $oldStock = $product->stock;
                    $oldPrice = $product->price;

                    if ($request->order_type === '1') {
                        $newStock = $oldStock + $request->product_units[$key];
                        if ($oldPrice != 0) {
                            $newPrice = ($oldPrice + $request->product_price[$key]) / 2;
                        } else {
                            $newPrice = $request->product_price[$key];
                        }
                        $product->stock = $newStock;
                        $product->price = $newPrice;

                        // Allocate products on sublocations
                        $sublocations = Sublocation::query()
                            ->where('capacity', '>', 0)
                            ->get();

                        $productUnitesToInsert = intval($request->product_units[$key]);

                        while ($productUnitesToInsert > 0) {
                            foreach ($sublocations as $sublocation) {
                                if ($productUnitesToInsert == 0) {
                                    break;
                                }

                                if ($productUnitesToInsert <= $sublocation->capacity) {
                                    $product->sublocation()->attach($sublocation->id, ['units' => $productUnitesToInsert]);
                                    $sublocation->capacity = $sublocation->capacity - $productUnitesToInsert;
                                    $sublocation->save();
                                    $productUnitesToInsert = 0;
                                } elseif ($productUnitesToInsert > $sublocation->capacity) {
                                    $productUnitesToInsert = $productUnitesToInsert - $sublocation->capacity;
                                    $product->sublocation()->attach($sublocation->id, ['units' => $sublocation->capacity]);
                                    $sublocation->capacity = 0;
                                    $sublocation->save();
                                }
                            }
                        }

                    } elseif ($request->order_type === '2') {
                        $newStock = $oldStock - $request->product_units[$key];
                        $product->stock = $newStock;

                        // Deallocate products from sublocations
                        $productSublocations = DB::table('product_sublocation')
                            ->groupBy('sublocation_id')
                            ->selectRaw('sublocation_id, sum(units) as sum_units')
                            ->where('product_id', '=', $product_id)
                            ->get();

                        $productUnitesToDelete = intval($request->product_units[$key]);

                        while ($productUnitesToDelete > 0) {
                            foreach ($productSublocations as $productSublocation) {
                                if ($productUnitesToDelete == 0) {
                                    break;
                                }

                                $sublocation = Sublocation::find($productSublocation->sublocation_id);

                                if ($productUnitesToDelete <= $productSublocation->sum_units) {
                                    $product->sublocation()->attach($sublocation->id, ['units' => 0 - $productUnitesToDelete]);
                                    $sublocation->capacity = $sublocation->capacity + $productUnitesToDelete;
                                    $sublocation->save();
                                    $productUnitesToDelete = 0;
                                } elseif ($productUnitesToDelete > $productSublocation->sum_units) {
                                    $productUnitesToDelete = $productUnitesToDelete - $productSublocation->sum_units;
                                    $product->sublocation()->attach($sublocation->id, ['units' => 0 - $productSublocation->sum_units]);
                                    $sublocation->capacity = $sublocation->capacity + $productSublocation->sum_units;
                                    $sublocation->save();
                                }
                            }
                        }
                    }
                    $product->save();
                }
            }
        }

        return redirect()->route('ordersAll');
    }

    public function put(Request $request)
    {
        // TODO: Implement put() method.
    }

    public function delete(int $id)
    {
        $order = Order::find($id);
        if ($order) {
            $order->delete();
        }
        return redirect()->back();
    }

    public function get(int $id)
    {
        // TODO: Implement get() method.
    }
}
