<?php

namespace App\Helper;

use App\Order;
use App\Order_type;
use App\Partner;
use App\Product;
use App\QueryFilters\Order\AmountFrom;
use App\QueryFilters\Order\AmountTo;
use App\QueryFilters\Order\DateFrom;
use App\QueryFilters\Order\DateTo;
use App\QueryFilters\Order\OrderType;
use App\QueryFilters\Order\Partner as PartnerFilter;
use App\Sublocation;
use Carbon\Carbon;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Http\Request;

class OrderHelper implements InterfaceHelper
{

    public function form($order = null, $type = 'new')
    {
        $orderTypes = Order_type::all();
        $partners = Partner::all();
        $products = Product::all();

//        if ($type == 'edit') {
//
//            $order->order_type = DB::table('order_types')
//                ->select('material_id')
//                ->where('product_id', $product->id)
//                ->pluck('material_id')->toArray();
//
//            $product->gemstones = DB::table('gemstone_product')
//                ->select('gemstone_id')
//                ->where('product_id', $product->id)
//                ->pluck('gemstone_id')->toArray();
//
//            $product->sublocations = DB::table('product_sublocation')
//                ->select('sublocation_id')
//                ->where('product_id', $product->id)
//                ->pluck('sublocation_id')->toArray();
//
//        }

        return view('/order/new', [
            'orderTypes' => $orderTypes,
            'partners' => $partners,
            'products' => $products,
            'type' => $type,
        ]);
    }

    public function get(int $id)
    {
        // TODO: Implement get() method.
    }

    public function view(int $id)
    {
        // TODO: Implement view() method.
    }

    public function all(Request $request)
    {
        $orders = Order::all();
        $orderTypes = Order_type::all();
        $partners = Partner::withTrashed()->get();
        $products = Product::withTrashed()->get();

        if ($request->isMethod('get')) {
            $orders = Order::all();
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
                ])
                ->thenReturn()->get();

            $orders = $pipeline;
        }

        return view('order/all', [
            'orders' => $orders,
            'orderTypes' => $orderTypes,
            'partners' => $partners,
            'products' => $products,
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

        if ($request->order_type === '2') {

            if (isset($request->update_type) && isset($request->update_percentage) && isset($request->final_amount)) {
                $order->update_operation = $request->update_type;
                $order->update_percentage = $request->update_percentage;
                $order->final_amount = $request->final_amount;
            }
        }

        $order->save();

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
                        $newPrice = ($oldPrice + $request->product_price[$key]) / 2;
                        $product->stock = $newStock;
                        $product->price = $newPrice;

                        // Allocate products on sublocations
                        $sublocations = Sublocation::query()
                            ->where('capacity', '>', 0)
                            ->get();

                        $productUnitesToInsert = intval($request->product_units[$key]);

                        while ($productUnitesToInsert > 0) {
                            foreach ($sublocations as $sublocation){
                                if ($productUnitesToInsert == 0) {
                                    break;
                                }

                                if ($productUnitesToInsert <= $sublocation->capacity) {
                                    $product->sublocation()->attach($sublocation->id, ['units' => $productUnitesToInsert]);
                                    $sublocation->capacity = $sublocation->capacity - $productUnitesToInsert;
                                    $sublocation->save();
                                    $productUnitesToInsert = 0;
                                }
                                elseif ($productUnitesToInsert > $sublocation->capacity){
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
}
