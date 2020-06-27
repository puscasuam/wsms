<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Location;
use App\Order;
use App\Sublocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function occupancyRateJson(Request $request)
    {
        $sublocationsOccupancyRate = Sublocation::query()->sum('capacity');

        return json_encode(round((1000 - $sublocationsOccupancyRate) * 100 / 1000));
    }

    public function employeesNoJson(Request $request)
    {
        $employeesNo = Employee::query()->count('id');

        return json_encode($employeesNo);
    }

    public function incomeNoJson(Request $request)
    {
        $incomeNo = Order::query()
            ->where('order_type_id', 2)
            ->sum('final_amount');

        return json_encode($incomeNo);
    }

    public function outcomeNoJson(Request $request)
    {
        $outcomeNo = Order::query()
            ->where('order_type_id', 1)
            ->sum('final_amount');

        return json_encode($outcomeNo);
    }

    public function locationOccupancyJson(Request $request)
    {
        $locationsOccupancy = Sublocation::query()
            ->groupBy('location_id')
            ->selectRaw('location_id, sum(capacity) as sum_capacity')
            ->get();

        $results = array();
        foreach ($locationsOccupancy as $locationOccupancy) {
            $results[$locationOccupancy->location_id] = [
                'text' => $locationOccupancy->sum_capacity . ' / 100',
                'value' =>  $locationOccupancy->sum_capacity,
            ];
        }

        return json_encode($results);
    }
}
