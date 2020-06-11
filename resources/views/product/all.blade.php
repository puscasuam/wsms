@extends('layouts.includes.main')

@section('content')

    <!-- Data tables for Products -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Products</h6>
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

                        <form action="/product" method="POST">
                            @csrf

                            <div class="row">


                                <div class="col-sm-6 pl-5">

                                    <!-- Filter Brand -->
                                    <div class="form-row form-group row">
                                        <label for="brand" class="col-sm-2 col-form-label">Brand</label>
                                        <div class="col-sm-8">
                                            <select style="width: 100%;" id="brand" class="form-control" name="brand[]"
                                                    multiple>
                                                @foreach($brands as $brand)
                                                    <option value={{$brand->id}}>{{ $brand->name}}</option>
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
                                                    <option value={{$material->id}}>{{ $material->name}}</option>
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
                                                    <option value={{$sublocation->id}}>{{ $sublocation->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-6 pl-5">

                                    <!-- Filter Category -->
                                    <div class="form-row form-group row">
                                        {{--                            <label class="col-form-label col-sm-2 pt-0">category</label>--}}
                                        <label for="category" class="col-sm-2 col-form-label">Category</label>
                                        <div class="col-sm-8">
                                            <select style="width: 100%;" id="category" class="form-control"
                                                    name="category[]" multiple>
                                                @foreach($categories as $category)
                                                    <option value={{$category->id}}>{{ $category->name}}</option>
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
                                                    <option value={{$gemstone->id}}>{{ $gemstone->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="row">
                                <div class="col col-sm-12 pl-5">
                                    <button type="submit" class="btn btn-primary">Apply</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead >
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
                                <a class="btn btn-default" href="{{ route('productAdd')}}" aria-label="View">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </a>
                                <a class="btn btn-default" href="{{ route('productAdd')}}" aria-label="Edit">
                                    <i class="fa fa-cog" aria-hidden="true"></i>
                                </a>
                                <a class="btn btn-default" href="{{ route('productAdd')}}" aria-label="Delete">
                                    <i class="fa fa-eraser" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
