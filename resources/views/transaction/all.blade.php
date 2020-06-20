@extends('layouts.includes.main')

@section('content')

    <!-- Data tables for Transactions -->
    <div class="card shadow mb-4" id="orders-page">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Transactions</h6>
        </div>
        <div class="card-body">

{{--            <div class="card mb-4">--}}
{{--                <a class="nav-link collapsed card-header m-0 text-primary" href="#" data-toggle="collapse"--}}
{{--                   data-target="#collapseFilters"--}}
{{--                   aria-expanded="true" aria-controls="collapsePages">--}}
{{--                    <i class="fa fas fa-filter"></i>--}}
{{--                    <span>Filters</span>--}}
{{--                </a>--}}
{{--                <div id="collapseFilters" class="collapse">--}}
{{--                    <div class="bg-white py-2 collapse-inner rounded">--}}

{{--                        <form action="/orders" method="POST">--}}
{{--                            @csrf--}}

{{--                            <div class="row">--}}

{{--                                <div class="col-sm-6 pl-5">--}}

{{--                                    <!-- Filter PartnerFilter -->--}}
{{--                                    <div class="form-row form-group row">--}}
{{--                                        <label for="partner" class="col-sm-2 col-form-label">Partner</label>--}}
{{--                                        <div class="col-sm-8">--}}
{{--                                            <select style="width: 100%;" id="partner" class="form-control"--}}
{{--                                                    name="partner[]"--}}
{{--                                                    multiple>--}}
{{--                                                @foreach($partners as $partner)--}}
{{--                                                    <option value={{$partner->id}}>{{ $partner->name}}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-sm-1">--}}
{{--                                            <button type="button" class="btn"><i class="fa fa-sort" aria-hidden="true"></i></button>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <!-- Filter Type -->--}}
{{--                                    <div class="form-row form-group row">--}}
{{--                                        <label for="order_type" class="col-sm-2 col-form-label">Order type</label>--}}
{{--                                        <div class="col-sm-8">--}}
{{--                                            <select style="width: 100%;" id="order_type" class="form-control"--}}
{{--                                                    name="order_type[]"--}}
{{--                                                    multiple>--}}
{{--                                                @foreach($orderTypes as $orderType)--}}
{{--                                                    <option value={{$orderType->id}}>{{ $orderType->type}}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-sm-1">--}}
{{--                                            <button type="button" class="btn"><i class="fa fa-sort" aria-hidden="true"></i></button>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <!-- Filter Product -->--}}
{{--                                    <div class="form-row form-group row">--}}
{{--                                        <label for="product" class="col-sm-2 col-form-label">Products</label>--}}
{{--                                        <div class="col-sm-8">--}}
{{--                                            <select style="width: 100%;" id="product" class="form-control"--}}
{{--                                                    name="product[]" multiple>--}}
{{--                                                @foreach($products as $product)--}}
{{--                                                    <option value={{$product->id}}>{{ $product->name}}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-sm-1">--}}
{{--                                            <button type="button" class="btn"><i class="fa fa-sort" aria-hidden="true"></i></button>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                </div>--}}


{{--                                <div class="col-sm-6 pl-5">--}}
{{--                                    <!-- Filter Amount -->--}}
{{--                                    <div class="form-row form-group row">--}}
{{--                                        <label for="amount" class="col-sm-2 col-form-label">Amount</label>--}}
{{--                                        <div class="col-sm-4">--}}
{{--                                            <input type="number" class="form-control" id="amount_from"--}}
{{--                                                   name="amount_from">--}}
{{--                                        </div>--}}
{{--                                        <div class="col-sm-4">--}}
{{--                                            <input type="number" class="form-control" id="amount_to" name="amount_to">--}}
{{--                                        </div>--}}
{{--                                        <div class="col-sm-1">--}}
{{--                                            <button type="button" class="btn"><i class="fa fa-sort" aria-hidden="true"></i></button>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <!-- Filter Date -->--}}
{{--                                    <div class="form-row form-group row">--}}
{{--                                        <label for="date" class="col-sm-2 col-form-label">Date</label>--}}
{{--                                        <div class="col-sm-4">--}}
{{--                                            <input type="text" class="form-control" id="date_from" name="date_from">--}}
{{--                                        </div>--}}
{{--                                        <div class="col-sm-4">--}}
{{--                                            <input type="text" class="form-control" id="date_to" name="date_to">--}}
{{--                                        </div>--}}
{{--                                        <div class="col-sm-1">--}}
{{--                                            <button type="button" class="btn"><i class="fa fa-sort" aria-hidden="true"></i></button>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                </div>--}}

{{--                            </div>--}}

{{--                            <div class="row">--}}
{{--                                <div class="col col-sm-12 pl-5">--}}
{{--                                    <button type="submit" class="btn btn-primary">Apply</button>--}}
{{--                                    <button type="button" class="btn btn-primary">Reset</button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr class="card-header">
                        <th>Partner</th>
                        <th>Transaction type</th>
                        <th>Products</th>
                        <th>Amount</th>
                        <th>Employee</th>
                        <th>Status</th>
                        <th>Date<i class="fa fa-sort" aria-hidden="true"></i></th>
                        <th>Change status</th>
                    </tr>
                    </thead>

                    <tbody>

                    @foreach($orders as $order)
                        <tr>
                            <td> {{$order->partner->name}} </td>
                            <td> {{$order->order_type->type}} </td>
                            <td>
                                @foreach($order->products as $product)
                                    {{$product->name}}{{$loop->last ? '' : ','}}
                                @endforeach
                            </td>
                            <td> {{$order->amount}} </td>
                            <th>Employee</th>
                            <td> {{$transaction->status->status}} </td>
                            <td> {{\Carbon\Carbon::parse($order->date)->format('d-m-Y')}} </td>
                            <th>
                                <div class="open">
                                    <button role="button" type="button" class="btn" data-toggle="dropdown">
                                        <i class="fa fa-bars"></i>
                                    </button>

                                    <ul class="dropdown-menu" style="text-align: left; padding-left: 20px">
                                        <li> paid </li>
                                        <li> cancel </li>
                                    </ul>
                                </div>
                            </th>
                        </tr>

{{--                        <!-- Delete Order Modal-->--}}
{{--                        <div class="modal fade" id="deleteOrderModal" tabindex="-1" role="dialog"--}}
{{--                             aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
{{--                            <div class="modal-dialog" role="document">--}}
{{--                                <div class="modal-content">--}}
{{--                                    <div class="modal-header">--}}
{{--                                        <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete--}}
{{--                                            the order?</h5>--}}
{{--                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">--}}
{{--                                            <span aria-hidden="true">×</span>--}}
{{--                                        </button>--}}
{{--                                    </div>--}}
{{--                                    <div class="modal-body">Select "Delete" below if you are ready to delete your--}}
{{--                                        selected order.--}}
{{--                                    </div>--}}
{{--                                    <div class="modal-footer">--}}
{{--                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel--}}
{{--                                        </button>--}}
{{--                                        <a class="btn btn-primary" href="{{ URL('/order/'.$order->id )}}"--}}
{{--                                           onclick="event.preventDefault(); document.getElementById('delete-order-form').submit();">Delete</a>--}}
{{--                                        <form id="delete-order-form" action="{{ URL('/order/'.$order->id )}}"--}}
{{--                                              method="post" style="display: none;">--}}
{{--                                            @method('delete')--}}
{{--                                            @csrf--}}
{{--                                        </form>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    @endforeach
                    </tbody>

                </table>
                {{--                                {{ $products->appends(request()->input())->links()}}--}}
                {{--                                {{ $products->links()}}--}}
            </div>
        </div>
    </div>

@endsection

