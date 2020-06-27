<?php

namespace App\Helper;

use App\Employee;
use App\Order;
use App\Order_type;
use App\Product;
use App\Status;
use App\Sublocation;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\DB;

class TransactionHelper implements InterfaceHelper
{

    public function form()
    {
        // TODO: Implement form() method.
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
        $transactions = Transaction::all();
        $orders = Order::all();
        $orderTypes = Order_type::all();
        $employees = Employee::all();
        $statuses = Status::all();

        if ($request->isMethod('get')) {

            $pipeline = app(Pipeline::class)
                ->send(Transaction::query())
                ->through([
                    \App\QueryFilters\Transaction\Order::class,
                    \App\QueryFilters\Transaction\Status::class,
                ])
                ->thenReturn();

            $transactions = $pipeline->paginate(6);
        }

        if ($request->isMethod('post')) {
            $pipeline = app(Pipeline::class)
                ->send(Transaction::query())
                ->through([
                    \App\QueryFilters\Transaction\Order::class,
                    \App\QueryFilters\Transaction\Status::class,
                ])
                ->thenReturn();

            $transactions = $pipeline->paginate(6);
        }

        return view('transaction/all', [
            'orders' => $orders,
            'orderTypes' => $orderTypes,
            'transactions' => $transactions,
            'employees' => $employees,
            'statuses' => $statuses,
            'filters' => $request,
        ]);
    }

    public function post(Request $request)
    {
        // TODO: Implement put() method.
    }

    public function put(Request $request)
    {
        // TODO: Implement put() method.
    }

    public function delete(int $id)
    {
        // TODO: Implement delete() method.
    }

    public function paid(int $id)
    {
        $transaction = Transaction::find($id);

        if ($transaction) {
            $transaction->status_id = 2;
            $transaction->save();
        }
        return redirect()->back();
    }

    public function canceled(int $id)
    {
        $transaction = Transaction::find($id);
        $order = Order::find($transaction->order_id);


        // Get products from order
        $orderProducts = DB::table('order_product')
            ->select('product_id', 'units', 'price')
            ->where('order_id', $order->id)
            ->get();

        if ($order->order_type_id === 1) {

            foreach ($orderProducts as $orderProduct) {
                $product = Product::find($orderProduct->product_id);
                if ($product) {

                    if ($product->stock < $orderProduct->units) {
                        return redirect()->back()->withErrors([
                            'The product ' . $product->name . ' might not have enough stock.',
                        ]);
                    } else {
                        $product->stock = $product->stock - $orderProduct->units;
                        $product->save();

                        // Deallocate products from sublocations
                        $productSublocations = DB::table('product_sublocation')
                            ->groupBy('sublocation_id')
                            ->selectRaw('sublocation_id, sum(units) as sum_units')
                            ->where('product_id', '=', $product->id)
                            ->get();

                        $productUnitesToDelete = intval($orderProduct->units);

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
                } else {

                    return redirect()->back()->withErrors([
                        'The product' . $product->name . ' does not exists anymore.',
                    ]);
                }
            }

        } elseif ($order->order_type_id === 2) {

            foreach ($orderProducts as $orderProduct) {
                $product = Product::find($orderProduct->product_id);
                if ($product) {

                    $totalCapacityOfWarehouse = DB::table('sublocations')
                        ->sum('capacity')
                        ->get();


                    if ($product->stock > $totalCapacityOfWarehouse) {
                        return redirect()->back()->withErrors([
                            'No nore space is available in the warehouse',
                        ]);
                    } else {
                        $product->stock = $product->stock + $orderProduct->units;
                        $product->save();

                        // Allocate products on sublocations
                        $sublocations = Sublocation::query()
                            ->where('capacity', '>', 0)
                            ->get();

                        $productUnitesToInsert = intval($orderProduct->units);

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
                    }
                } else {
                    return redirect()->back()->withErrors([
                      'The product ' . $product->name . ' does not exists anymore.',
                    ]);
                }
            }
        }

        $transaction->status_id = 3;
        $transaction->save();

        return redirect()->back();
    }
}
