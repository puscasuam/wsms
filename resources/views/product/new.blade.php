@extends('layouts.includes.main')

@section('content')

    <!-- Form -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add new product</h6>
        </div>
        <div class="card-body">
            <form action="/product" method="post" class="form-horizontal row-fluid">
                @csrf

                <div class = "row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-6">
                        <div class="form-row form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter product name" autocomplete="off">
                                <div class="validation">@error('name') {{$message}} @enderror </div>
                            </div>
                        </div>


                        <div class="form-row form-group row">
                            <label for="price" class="col-sm-2 col-form-label">Price</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="price" name="price" placeholder="Enter product price">
                                <div class="validation"> @error('price') {{$message}}@enderror </div>
                            </div>
                        </div>

                        <div class="form-row form-group row">
                            <label for="stock" class="col-sm-2 col-form-label">Stock</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="stock" name="stock" placeholder="Enter product stock">
                                <div class="validation"> @error('stock') {{$message}}@enderror </div>
                            </div>
                        </div>

                        <div class="form-row form-group row">
                            <label for="brand" class="col-sm-2 col-form-label">Brand</label>
                            <div class="col-sm-8">
                                <select id="brand" name="brand" class="form-control">
                                    <option selected>Choose brand</option>
                                    @foreach($brands as $brand)
                                        <option value={{$brand->id}}>{{ $brand->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <fieldset class="form-group">
                            <div class="row">
                                <legend class="col-form-label col-sm-2 pt-0">Category</legend>
                                <div class="col-sm-8">
                                    <select id="category" name="category" class="form-control">
                                        <option selected>Choose category</option>
                                        @foreach($categories as $category)
                                            <option value={{$category->id}}>{{ $category->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('category') {{$message}}@enderror
                                </div>
                            </div>
                        </fieldset>

                        <div class="form-row form-group row">
                            <label for="material" class="col-sm-2 col-form-label">Materials</label>
                            <div class="col-sm-8">
                                <select id="material" class="form-control" name="material[]" multiple>
                                    @foreach($materials as $material)
                                        <option value={{$material->id}}>{{ $material->name}}</option>
                                    @endforeach
                                    @error('materials') {{$message}}@enderror
                                </select>
                            </div>
                        </div>

                        <div class="form-row form-group row">
                            <label for="gemstone" class="col-sm-2 col-form-label">Gemstones</label>
                            <div class="col-sm-8">
                                <select id="gemstone" class="form-control" name="gemstone[]" multiple>
                                    @foreach($gemstones as $gemstone)
                                        <option value={{$gemstone->id}}>{{ $gemstone->name}}</option>
                                    @endforeach
                                </select>
                                @error('gemstone') {{$message}}@enderror
                            </div>
                        </div>


{{--                        <fieldset class="form-group">--}}
{{--                            <div class="row">--}}
{{--                                <legend class="col-form-label col-sm-2 pt-0">Category</legend>--}}
{{--                                <div class="col-sm-8">--}}
{{--                                    @foreach($categories as $category)--}}
{{--                                        <div class="form-check">--}}
{{--                                            <input class="form-check-input" type="radio" name="category" id="category-{{$category->id}}" value="{{$category->id}}" >--}}
{{--                                            <label class="form-check-label" for="category-{{$category->id}}">--}}
{{--                                                {{$category->name}}--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                    @endforeach--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </fieldset>--}}

                        <div class="form-row form-group row">
                            <label for="description" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="form-row form-group row">
                            <button type="submit" class="btn btn-primary">Add product</button>
                        </div>

                    </div>

                    <div class="col-sm-4">

                        <div class="wrapper">

                            <div class="box" id="box-image">
                                <div class="js--image-preview"></div>
                                <div class="upload-options">
                                    <label>
                                        <input type="file" class="image-upload"  name="image" accept="image/*" />
                                    </label>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="col-sm-1"></div>
                </div>

            </form>
        </div>
    </div>

@endsection
