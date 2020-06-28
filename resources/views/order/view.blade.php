@extends('layouts.includes.main')

@section('content')
    <!-- view -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">

            <h6 class="m-0 font-weight-bold text-dark">View order {{ isset($order->id) ? $order->id : '' }}</h6>

        </div>
        <div class="card-body">
            <table class="table table-bordered">

                <tr>
                    <th class="card-header" style="width: 15%;">Order type</th>
                    <td>{{( isset($order->order_type_id) && $order->order_type_id === 1) ? 'In' : 'Out' }}</td>
                </tr>

                <tr>
                    <th class="card-header">Partner</th>
                    <td>
                        @foreach($partners as $partner)
                            {{(isset($order->partner_id) && $partner->id == $order->partner_id) ?  $partner->name : ''}}
                        @endforeach
                    </td>
                </tr>

                <tr>
                    <th class="card-header">Products</th>
                    <td>
                        @foreach($order->products as $product)
                            {{isset($product) ?  $product->name . ', units: ' . $product->units . ', price: ' . $product->price : ''}}<br/>
                        @endforeach
                    </td>
                </tr>

                <tr>
                    <th class="card-header"> Amount</th>
                    <td>{{ isset($order->amount) ? $order->amount : '' }}</td>
                </tr>

                <tr>
                    <th class="card-header"> Update price operation</th>
                    <td>{{ isset($order->update_operation) ? $order->update_operation : 'n/a' }}</td>
                </tr>

                <tr>
                    <th class="card-header">Update price percentage</th>
                    <td>{{ isset($order->update_percentage) ? $order->update_percentage : 'n/a' }}</td>
                </tr>

                <tr>
                    <th class="card-header">Final amount</th>
                    <td>{{ isset($order->final_amount) ? $order->final_amount : '' }}</td>
                </tr>

                <tr>
                    <th class="card-header">Added at</th>
                    <td>{{ isset($order->created_at) ? $order->created_at : '' }}</td>
                </tr>

                <tr>
                    <th class="card-header">Added by</th>
                    <td>
                        @foreach($employees as $employee)
                            {{(isset($order->employee_id) && $employee->id == $order->employee_id) ?  $employee->firstname : ''}}
                        @endforeach
                    </td>
                </tr>

            </table>

        </div>
        <div class="row mt-3 mb-3">
            <div class="col-sm-1"></div>
            <div class="col">

                <a href="{{ URL::route('ordersAll') }}" class="btn btn-secondary float-right">Back</a>
            </div>
            <div class="col-sm-1"></div>
        </div>
    </div>

@endsection
