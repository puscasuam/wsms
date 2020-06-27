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
                                    @if($transaction->status_id === 1)
                                        <button role="button" type="button" class="btn" data-toggle="dropdown">
                                            <i class="fa fa-bars"></i>
                                        </button>
                                        <ul class="dropdown-menu" style="text-align: left; padding-left: 20px">
                                            <li>
                                                <a href="#" aria-label="Paid" data-toggle="modal"
                                                   data-target="#paidTransactionModal-{{ $transaction->id }}">
                                                    <i class="fa fa-check"></i> Paid
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" aria-label="Canceled" data-toggle="modal"
                                                   data-target="#cancelTransactionModal-{{ $transaction->id }}">
                                                    <i class="fa fa-ban"></i> Canceled
                                                </a>
                                            </li>
                                        </ul>
                                    @endif
                                </div>


                                <!-- Paid Transaction Modal-->
                                <div class="modal fade" id="paidTransactionModal-{{ $transaction->id }}" tabindex="-1"
                                     role="dialog"
                                     aria-labelledby="exampleModalLabel-{{ $transaction->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel-{{ $transaction->id }}">
                                                    Are you sure you want to mark as paid this transaction?
                                                </h5>
                                                <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Select "Mark as Paid" below if you are ready to mark as paid your
                                                selected transaction.
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">
                                                    Cancel
                                                </button>
                                                <a class="btn btn-dark"
                                                   href="{{ URL('/transaction/paid/' . $transaction->id )}}"
                                                   onclick="event.preventDefault(); document.getElementById('paid-transaction-form-{{ $transaction->id }}').submit();">Mark
                                                    as Paid</a>
                                                <form id="paid-transaction-form-{{ $transaction->id }}"
                                                      action="{{ URL('/transaction/paid/' . $transaction->id )}}"
                                                      method="post" style="display: none;">
                                                    @method('delete')
                                                    @csrf
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Canceled Transaction Modal-->
                                <div class="modal fade" id="cancelTransactionModal-{{ $transaction->id }}" tabindex="-1"
                                     role="dialog"
                                     aria-labelledby="exampleModalLabel-{{ $transaction->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel-{{ $transaction->id }}">
                                                    Are you sure you want to mark as canceled this transaction?
                                                </h5>
                                                <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Select "Mark as Canceled" below if you are ready to mark as canceled
                                                your selected transaction.
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">
                                                    Cancel
                                                </button>
                                                <a class="btn btn-dark"
                                                   href="{{ URL('/transaction/canceled/' . $transaction->id )}}"
                                                   onclick="event.preventDefault(); document.getElementById('canceled-transaction-form-{{ $transaction->id }}').submit();">Mark
                                                    as Canceled</a>
                                                <form id="canceled-transaction-form-{{ $transaction->id }}"
                                                      action="{{ URL('/transaction/canceled/' . $transaction->id )}}"
                                                      method="post" style="display: none;">
                                                    @method('delete')
                                                    @csrf
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>

                    @endforeach
                    </tbody>

                    <!-- Error Transaction Modal-->
                    <div class="modal fade" id="errorTransactionModal" tabindex="-1" role="dialog"
                         aria-labelledby="errorTransactionModal" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Error</h5>
                                </div>
                                <div class="modal-body">
                                    @if(!empty($errors))
                                        {{$errors->first()}}
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(!empty($errors))
                        <input type="hidden" value="{{$errors->first()}}" id="error-transaction">
                    @endif

                </table>
                {{ $transactions->appends(request()->input())->links()}}
            </div>
        </div>
    </div>

@endsection

