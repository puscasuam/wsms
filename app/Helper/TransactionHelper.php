<?php


namespace App\Helper;


use App\Employee;
use App\Order;
use App\Order_type;
use App\Status;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;

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

        if($request->isMethod('get')){

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
