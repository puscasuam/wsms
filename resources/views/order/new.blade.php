@extends('layouts.includes.main')

@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Form -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <input type="hidden" id="product-form-type" value="{{$type}}"/>

            @if ($type == 'new')
                <h6 class="m-0 font-weight-bold text-dark">Add new order</h6>
            @elseif ($type == 'edit')
                <h6 class="m-0 font-weight-bold text-dark">Edit order</h6>
            @else ()
                <h6 class="m-0 font-weight-bold text-dark">View order</h6>
            @endif

        </div>
        <div class="card-body">
            <form id="order-form" action="/order" method="post" class="form-horizontal row-fluid">
                @csrf

                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-6">

                        <div class="form-row form-group row">
                            <label for="order_type" class="col-sm-2 col-form-label">Order Type</label>
                            <div class="col-sm-8">
                                <select id="order_type" name="order_type" class="form-control"
                                        onchange="show_hide_final_amount($(this))">
                                    <option value="0" selected>Choose order type</option>
                                    @foreach($orderTypes as $orderType)
                                        <option value={{$orderType->id}}
                                        @if (isset($order->order_type_id) && $orderType->id == $order->order_type_id)
                                            selected="selected"
                                            @endif
                                        >{{ $orderType->type}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-row form-group row">
                            <label for="partner" class="col-sm-2 col-form-label">Partner</label>
                            <div class="col-sm-8">
                                <select id="partner" name="partner" class="form-control">
                                    <option selected>Choose partner</option>
                                    @foreach($partners as $partner)
                                        <option value={{$partner->id}}
                                        @if (isset($order->partner_id) && $partner->id == $order->partner_id)
                                            selected="selected"
                                            @endif
                                        >{{ $partner->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <?php $count = 1; ?>
                        {{--                        @foreach($orderProducts as $orderProduct)--}}
                        {{--                            --}}
                        {{--                            // here code--}}
                        {{--                            --}}
                        {{--                        @endforeach--}}


                        <div class="form-row form-group row product-row product-add-row">
                            <label for="product" class="col-sm-2 col-form-label">Products</label>
                            <div class="col-sm-3">
                                <select class="form-control product" name="product[]" onchange="get_units_and_price($(this))">
                                    <option value="" selected>Choose product</option>
                                    @foreach($products as $product)
                                        <option value={{$product->id}}
                                        @if (isset($order->products) && in_array($product->id, $order->products))
                                            selected="selected"
                                            @endif
                                        >{{ $product->name}}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" class="selected-products" name="product[]">
                            </div>
                            <div class="col-sm-2">
                                <input type="number" class="form-control product_units" name="product_units[]" data-initial=""
                                       onchange="recalculate_amount($(this))"
                                       placeholder="units">
                                <div class="validation">@error('product_units') {{$message}} @enderror </div>
                            </div>
                            <div class="col-sm-2">
                                <input type="number" class="form-control product_price" name="product_price[]"
                                       onchange="recalculate_amount($(this))"
                                       placeholder="price">
                                <div class="validation">@error('product_price') {{$message}} @enderror </div>
                            </div>

                            <div class="col-sm-1">
                                <?php if ($count === 1): ?>
                                <?php $count++; ?>

                                <button type="button" class="btn btn-success"
                                        onClick="add_or_remove_product_row($(this));" disabled>
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </button>

                                <?php else: ?>

                                <button type="button" class="btn btn-danger"
                                        onClick="add_or_remove_product_row($(this));">
                                    <i class="fa fa-minus" aria-hidden="true"></i>
                                </button>

                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-row form-group row">
                            <label for="amount" class="col-sm-2 col-form-label">Amount</label>
                            <div class="col-sm-8">
                                <input readonly type="text" class="form-control" id="amount" name="amount"
                                       value="{{ isset($order->amont) ? $order->amount : '' }}">
                            </div>
                        </div>

                        <div class="form-row form-group row d-none price-update-row">
                            <label for="update_type" class="col-sm-2 col-form-label">Price update</label>
                            <div class="col-sm-6">
                                <select id="update_type" name="update_type" class="form-control" onchange="recalculate_amount($(this))">
                                    <option selected>Choose update type</option>
                                    <option value="discount">Discount</option>
                                    <option value="surcharge">Surcharge</option>
                                </select>
                            </div>

                            <div class="col-sm-2">
                                <input type="number" class="form-control" id="update_percentage"
                                       name="update_percentage"
                                       placeholder="%"
                                       onchange="recalculate_amount($(this))">
                                <div class="validation">@error('update_percentage') {{$message}} @enderror </div>
                            </div>
                        </div>

                        <div class="form-row form-group row d-none final-amount-row">
                            <label for="final_amount" class="col-sm-2 col-form-label">Final amount</label>
                            <div class="col-sm-8">
                                <input readonly type="text" class="form-control" id="final_amount"
                                       name="final_amount">
                            </div>
                        </div>


                        <div class="form-row form-group row">
                            <label for="date" class="col-sm-2 col-form-label">Date</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="date" name="date" autocomplete="off">
                            </div>
                        </div>

                    </div>

                    <div class="col-sm-1"></div>
                </div>

                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col">
                        @if ($type == 'new')
                            <button type="submit" class="btn btn-dark">Add order</button>
                        @elseif($type == 'edit')
                            <button type="submit" class="btn btn-dark">Edit order</button>
                        @endif
                        <a href="{{ URL::route('ordersAll') }}" class="btn btn-secondary float-right">Back</a>
                    </div>
                    <div class="col-sm-1"></div>
                </div>
            </form>
        </div>
    </div>

    <!-- Product Remove Row -->
    <div class="form-row form-group row product-dummy-row" style="display: none">
        <label for="product" class="col-sm-2 col-form-label"></label>
        <div class="col-sm-3">
            <select class="form-control product" name="product[]" onchange="get_units_and_price($(this))">
                <option value="" selected>Choose product</option>
                @foreach($products as $product)
                    <option value={{$product->id}}
                    @if (isset($order->products) && in_array($product->id, $order->products))
                        selected="selected"
                        @endif
                    >{{ $product->name}}</option>
                @endforeach
            </select>
            <input type="hidden" class="selected-products" name="product[]">
        </div>
        <div class="col-sm-2">
            <input type="number" class="form-control product_units" name="product_units[]" data-initial=""
                   onchange="recalculate_amount($(this))"
                   placeholder="units">
            <div class="validation">@error('product_units') {{$message}} @enderror </div>
        </div>
        <div class="col-sm-2">
            <input type="number" class="form-control product_price" name="product_price[]"
                   onchange="recalculate_amount($(this))"
                   placeholder="price">
            <div class="validation">@error('product_price') {{$message}} @enderror </div>
        </div>

        <div class="col-sm-1">
            <button type="button" class="btn btn-danger" onClick="add_or_remove_product_row($(this));">
                <i class="fa fa-minus" aria-hidden="true"></i>
            </button>
        </div>
    </div>

@endsection
