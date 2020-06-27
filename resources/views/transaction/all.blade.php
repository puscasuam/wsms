@extends('layouts.includes.main')

@section('content')

    <!-- Data tables for Transactions -->
    <div class="card shadow mb-4" id="orders-page">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">Transactions</h6>
        </div>
        <div class="card-body">

            <div class="card mb-4">
                <a class="nav-link collapsed card-header m-0 text-primary" href="#" data-toggle="collapse"
                   data-target="#collapseFilters"
                   aria-expanded="true" aria-controls="collapsePages">
                    <i class="fa fas fa-filter"></i>
                    <span>Filters</span>
                </a>
                <div id="collapseFilters" class="collapse">
                    <div class="bg-white py-2 collapse-inner rounded">

                        <form action="/transactions" method="POST">
                            @csrf

                            <div class="row">

                                <div class="col-sm-6 pl-5">

                                    <!-- Filter Order -->
                                    <div class="form-row form-group row">
                                        <label for="order" class="col-sm-2 col-form-label">Order</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="order" name="order"
                                                   value="{{ isset($filters->order) ? $filters->order : '' }}">
                                        </div>
                                    </div>

                                </div>


                                <div class="col-sm-6 pl-5">
                                    <!-- Filter Status -->
                                    <div class="form-row form-group row">
                                        <label for="status" class="col-sm-2 col-form-label">Status</label>
                                        <div class="col-sm-8">
                                            <select style="width: 100%;" id="status" class="form-control" name="status">
                                                <option value=""></option>
                                                <option value="1"
                                                        @if (isset($filters->status) && $filters->status === "1")
                                                        selected="selected"
                                                    @endif
                                                >Pending
                                                </option>
                                                <option value="2"
                                                        @if (isset($filters->status) && $filters->status === "2")
                                                        selected="selected"
                                                    @endif
                                                >Paid
                                                </option>
                                                <option value="3"
                                                        @if (isset($filters->status) && $filters->status === "3")
                                                        selected="selected"
                                                    @endif
                                                >Canceled
                                                </option>
                                            </select>
                                        </div>
                                    </div>


                                </div>

                            </div>

                            <div class="row">
                                <div class="col col-sm-12 pl-5">
                                    <button type="submit" class="btn btn-dark">Apply</button>
                                    <a class="btn btn-secondary" href="{{ route('transactionsAll') }}">Reset</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr class="card-header">
                        <th>Order Id</th>
                        <th>Status</th>
                        <th style="text-align:center;">Change status</th>
                    </tr>
                    </thead>

                    <tbody>

                    @foreach($transactions as $transaction)
                        <tr>
                            <td>
                                <a href="{{ URL('/order/'. $transaction->order_id . '/view')}}">
                                    Order {{$transaction->order_id}} </a>
                            </td>
                            <td> {{ ($transaction->status_id === 1) ? "Pending" : (($transaction->status_id === 2) ? "Paid" : "Canceled")}} </td>
                            <td style="width: 15%;">
                                <div class="open" style="text-align:center;">
                                    <button role="button" type="button" class="btn" data-toggle="dropdown">
                                        <i class="fa fa-bars"></i>
                                    </button>

                                    <ul class="dropdown-menu" style="text-align: left; padding-left: 20px">
                                        <li><a>
                                                <i class="fa fa-check"></i> Paid
                                            </a>
                                        </li>
                                        <li><a>
                                                <i class="fa fa-ban"></i> Canceled
                                            </a>
                                        </li>

                                    </ul>
                                </div>

                            </td>
                        </tr>

                    @endforeach
                    </tbody>

                </table>
                {{ $transactions->appends(request()->input())->links()}}
            </div>
        </div>
    </div>

@endsection

