@extends('layouts.includes.main')

@section('content')

    <!-- Data tables for Products -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-black">Products</h6>
        </div>
        <div class="card-body">

            <div class="card mb-4">

                <a class="nav-link collapsed card-header m-0 text-black" href="#" data-toggle="collapse"
                   data-target="#collapseFilters"
                   aria-expanded="true" aria-controls="collapsePages">
                    <i class="fa fas fa-filter"></i>
                    <span>Filters</span>
                </a>
                <div id="collapseFilters" class="collapse">
                    <div class="bg-white py-2 collapse-inner rounded">

                        <form action="/products" method="POST">
                            @csrf

                            <div class="row">

                                <div class="col-sm-6 pl-5">

                                    <!-- Filter Name -->
                                    <div class="form-row form-group row">
                                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="name" name="name"
                                                   value="{{ isset($filters->name) ? $filters->name : '' }}">
                                        </div>
                                        <div class="col-sm-1">
                                            <button type="button" class="btn" id="name_sort_button"
                                                    name="name_sort_button"
                                                    onclick="change_sort_direction($(this), '#name_sort')">
                                                <i class="fa fa-sort" aria-hidden="true"></i>
                                            </button>
                                            <input type="hidden" id="name_sort" name="name_sort" value="">
                                        </div>
                                    </div>

                                    <!-- Filter PriceFrom -->
                                    <div class="form-row form-group row">
                                        <label for="price" class="col-sm-2 col-form-label">Price</label>
                                        <div class="col-sm-4">
                                            <input type="number" class="form-control" id="price_from" name="price_from" min="0"
                                                   value="{{ isset($filters->price_from) ? $filters->price_from : '' }}">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="number" class="form-control" id="price_to" name="price_to" min="0"
                                                   value="{{ isset($filters->price_to) ? $filters->price_to : '' }}">
                                        </div>
                                        <div class="col-sm-1">
                                            <button type="button" class="btn" id="price_sort_button"
                                                    name="price_sort_button"
                                                    onclick="change_sort_direction($(this), '#price_sort')">
                                                <i class="fa fa-sort" aria-hidden="true"></i>
                                            </button>
                                            <input type="hidden" id="price_sort" name="price_sort" value="">
                                        </div>
                                    </div>

                                    <!-- Filter Stock -->
                                    <div class="form-row form-group row">
                                        <label for="stock" class="col-sm-2 col-form-label">Stock</label>
                                        <div class="col-sm-4">
                                            <input type="number" class="form-control" id="stock_from" name="stock_from" min="0"
                                                   value="{{ isset($filters->stock_from) ? $filters->stock_from : '' }}">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="number" class="form-control" id="stock_to" name="stock_to" min="0"
                                                   value="{{ isset($filters->stock_to) ? $filters->stock_to : '' }}">
                                        </div>
                                        <div class="col-sm-1">
                                            <button type="button" class="btn" id="stock_sort_button"
                                                    name="stock_sort_button"
                                                    onclick="change_sort_direction($(this), '#stock_sort')">
                                                <i class="fa fa-sort" aria-hidden="true"></i>
                                            </button>
                                            <input type="hidden" id="stock_sort" name="stock_sort" value="">
                                        </div>
                                    </div>

                                    <!-- Filter Brand -->
                                    <div class="form-row form-group row">
                                        <label for="brand" class="col-sm-2 col-form-label">Brand</label>
                                        <div class="col-sm-8">
                                            <select style="width: 100%;" id="brand" class="form-control" name="brand[]"
                                                    multiple>
                                                @foreach($brands as $brand)
                                                    <option value={{$brand->id}}
                                                        @if (isset($filters->brand) && in_array($brand->id, $filters->brand))
                                                        selected="selected"
                                                        @endif
                                                    >{{ $brand->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-1">
                                            <button type="button" class="btn" id="brand_sort_button"
                                                    name="brand_sort_button"
                                                    onclick="change_sort_direction($(this), '#brand_sort')">
                                                <i class="fa fa-sort" aria-hidden="true"></i>
                                            </button>
                                            <input type="hidden" id="brand_sort" name="brand_sort" value="">
                                        </div>
                                    </div>
                                </div>


                                <div class="col-sm-6 pl-5">
                                    <!-- Filter Category -->
                                    <div class="form-row form-group row">
                                        <label for="category" class="col-sm-2 col-form-label">Category</label>
                                        <div class="col-sm-8">
                                            <select style="width: 100%;" id="category" class="form-control"
                                                    name="category[]" multiple>
                                                @foreach($categories as $category)
                                                    <option value={{$category->id}}
                                                        @if (isset($filters->category) && in_array($category->id, $filters->category))
                                                        selected="selected"
                                                        @endif
                                                    >{{ $category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Filter Material -->
                                    <div class="form-row form-group row">
                                        <label for="material" class="col-sm-2 col-form-label">Materials</label>
                                        <div class="col-sm-8">
                                            <select style="width: 100%;" id="material" class="form-control"
                                                    name="material[]" multiple>
                                                @foreach($materials as $material)
                                                    <option value={{$material->id}}
                                                        @if (isset($filters->material) && in_array($material->id, $filters->material))
                                                        selected="selected"
                                                        @endif
                                                    >{{ $material->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Filter Gemstone -->
                                    <div class="form-row form-group row">
                                        <label for="gemstone" class="col-sm-2 col-form-label">Gemstones</label>
                                        <div class="col-sm-8">
                                            <select style="width: 100%;" id="gemstone" class="form-control"
                                                    name="gemstone[]" multiple>
                                                @foreach($gemstones as $gemstone)
                                                    <option value={{$gemstone->id}}
                                                        @if (isset($filters->gemstone) && in_array($gemstone->id, $filters->gemstone))
                                                        selected="selected"
                                                        @endif
                                                    >{{ $gemstone->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Filter Location -->
                                    <div class="form-row form-group row">
                                        <label for="location" class="col-sm-2 col-form-label">Locations</label>
                                        <div class="col-sm-8">
                                            <select style="width: 100%;" id="location" class="form-control"
                                                    name="location[]" multiple>
                                                @foreach($sublocations as $sublocation)
                                                    <option value={{$sublocation->id}}
                                                        @if (isset($filters->location) && in_array($sublocation->id, $filters->location))
                                                        selected="selected"
                                                        @endif
                                                    >{{ $sublocation->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col col-sm-12 pl-5">
                                    <button type="submit" class="btn btn-dark">Apply</button>
                                    <a class="btn btn-secondary" href="{{ route('productsAll') }}">Reset</a>
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
                        <th>Name</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Brand</th>
                        <th>Category</th>
                        <th>Materials</th>
                        <th>Gemstones</th>
                        <th>Location</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                    <tbody>

                    @foreach($products as $product)
                        <tr>
                            <td> {{$product->name}} </td>
                            <td> {{$product->price}} </td>
                            <td> {{$product->stock}} </td>
                            <td> {{$product->brand->name}} </td>
                            <td> {{$product->category->name}} </td>
                            <td>
                                @foreach($product->material as $material)
                                    {{$material->name}}{{$loop->last ? '' : ','}}
                                @endforeach
                            </td>
                            <td>
                                @foreach($product->gemstone as $gemstone)
                                    {{$gemstone->name}}{{$loop->last ? '' : ','}}
                                @endforeach
                            </td>
                            <td>
                            @foreach($product->sublocation as $sublocation)
                                {{$sublocation->name}}{{$loop->last ? '' : ','}}
                            @endforeach
                            <td>
                                <div class="open">
                                    <button role="button" type="button" class="btn" data-toggle="dropdown">
                                        <i class="fa fa-bars"></i>
                                    </button>

                                    <ul class="dropdown-menu" style="text-align: left; padding-left: 20px">
                                        <li>
                                            <a href="{{ URL('/product/'. $product->id . '/view')}}">
                                                <i class="fa fa-eye"></i> View
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ URL('/product/'.$product->id )}}">
                                                <i class="fa fa-cog"></i> Edit
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" aria-label="Delete" data-toggle="modal" data-target="#deleteProductModal-{{ $product->id }}">
                                                <i class="fa fa-eraser"></i> Delete
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Delete Product Modal-->
                                <div class="modal fade" id="deleteProductModal-{{ $product->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel-{{ $product->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel-{{ $product->id }}">
                                                    Are you sure you want to delete the product?
                                                </h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Select "Delete" below if you are ready to delete your selected product.
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                <a class="btn btn-dark" href="{{ URL('/product/' . $product->id )}}"
                                                   onclick="event.preventDefault(); document.getElementById('delete-product-form-{{ $product->id }}').submit();">Delete</a>
                                                <form id="delete-product-form-{{ $product->id }}" action="{{ URL('/product/' . $product->id )}}"
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

                </table>
                {{--                {!! $products->appends(\Request::except('page'))->render()!!}--}}
                {{--                {{ $products->links()}}--}}
                {{ $products->appends(request()->input())->links()}}
            </div>
        </div>
    </div>

@endsection
