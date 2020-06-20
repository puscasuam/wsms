<?php


namespace App\Helper;


use App\Employee;
use App\Order;
use App\Order_type;
use App\Partner;
use App\Product;
use App\Status;
use App\Transaction;
use Illuminate\Http\Request;

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
        $partners = Partner::all();
        $products = Product::all();
        $employees = Employee::all();
        $statuses = Status::all();

        if($request->isMethod('get')){
            $transactions = Transaction::all();
        }

//        if ($request->isMethod('post')) {
//            $pipeline = app(Pipeline::class)
//                ->send(Product::query())
//                ->through([
//                    Name::class,
//                    PriceFrom::class,
//                    PriceTo::class,
//                    StockFrom::class,
//                    StockTo::class,
//                    \App\QueryFilters\Product\Brand::class,
//                    \App\QueryFilters\Product\Gemstone::class,
//                    \App\QueryFilters\Product\Material::class,
//                    \App\QueryFilters\Product\Category::class,
//                    Location::class,
////                    NameSort::class,
//                ])
//                ->thenReturn();
//
//            $products = $pipeline->get();
//        }

        return view('transaction/all', [
            'orders' => $orders,
            'orderTypes' => $orderTypes,
            'partners' => $partners,
            'products' => $products,
            'transactions' => $transactions,
            'employees' => $employees,
            'statuses' => $statuses,
        ]);
    }

    public function post(Request $request)
    {

    }

    public function put(Request $request)
    {
        // TODO: Implement put() method.
    }

    public function delete(int $id)
    {
        // TODO: Implement delete() method.
    }
}
