@extends('layouts.includes.main')

@section('content')

    <!-- Form -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <input type="hidden" id="product-form-type" value="{{$type}}"/>

            @if ($type == 'new')
                <h6 class="m-0 font-weight-bold text-primary">Add new product</h6>
            @elseif ($type == 'edit')
                <h6 class="m-0 font-weight-bold text-primary">Edit product</h6>
            @else ()
                <h6 class="m-0 font-weight-bold text-primary">View product</h6>
            @endif

        </div>
        <div class="card-body">
            <form id="product-form" action="/product" method="post" class="form-horizontal row-fluid">
                @csrf

                @if ($type == 'edit')
                    @method('PATCH')
                    <input type="hidden" name="id" value="{{ $product->id }}">
                @endif

                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-6">
                        <div class="form-row form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                       value="{{ isset($product->name) ? $product->name : '' }}"
                                       placeholder="Enter product name" autocomplete="off">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        @if ($type == 'edit' || $type == 'view')
                            <div class="form-row form-group row">
                                <label for="price" class="col-sm-2 col-form-label">Price</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price"
                                           value="{{ isset($product->price) ? $product->price : '' }}"
                                           placeholder="Enter product price">
                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        @endif


                        @if ($type == 'edit' || $type == 'view')
                            <div class="form-row form-group row">
                                <label for="stock" class="col-sm-2 col-form-label">Stock</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock"
                                           value="{{ isset($product->stock) ? $product->stock : '' }}"
                                           placeholder="Enter product stock">
                                    @error('stock')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        @endif

                        <div class="form-row form-group row">
                            <label for="brand" class="col-sm-2 col-form-label">Brand</label>
                            <div class="col-sm-8">
                                <select id="brand" name="brand" class="form-control">
                                    <option value="0" selected>Choose brand</option>
                                    @foreach($brands as $brand)
                                        <option value={{$brand->id}}
                                        @if (isset($product->brand_id) && $brand->id == $product->brand_id)
                                            selected="selected"
                                            @endif
                                        >{{ $brand->name}}</option>
                                    @endforeach
                                </select>
                                @error('brand')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row form-group row">
                            <label for="category" class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-8">
                                <select id="category" name="category" class="form-control">
                                    <option value="0" selected>Choose category</option>
                                    @foreach($categories as $category)
                                        <option value={{$category->id}}
                                        @if (isset($product->category_id) && $category->id == $product->category_id)
                                            selected="selected"
                                            @endif
                                        >{{ $category->name}}</option>
                                    @endforeach
                                </select>
                                @error('category') {{$message}}@enderror
                            </div>
                        </div>

                        <div class="form-row form-group row">
                            <label for="material" class="col-sm-2 col-form-label">Materials</label>
                            <div class="col-sm-8">
                                <select id="material" class="form-control" name="material[]" multiple>
                                    @foreach($materials as $material)
                                        <option value={{$material->id}}
                                        @if (isset($product->materials) && in_array($material->id, $product->materials))
                                            selected="selected"
                                            @endif
                                        >{{ $material->name}}</option>
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
                                        <option value={{$gemstone->id}}
                                        @if (isset($product->gemstones) && in_array($gemstone->id, $product->gemstones))
                                            selected="selected"
                                            @endif
                                        >{{ $gemstone->name}}</option>
                                    @endforeach
                                </select>
                                @error('gemstone') {{$message}}@enderror
                            </div>
                        </div>

                        @if ($type == 'edit' || $type == 'view')
                            <div class="form-row form-group row">
                                <label for="sublocation" class="col-sm-2 col-form-label">Locations</label>
                                <div class="col-sm-8">
                                    <select id="sublocation" class="form-control" name="sublocation[]" multiple>
                                        @foreach($sublocations as $sublocation)
                                            <option value={{$sublocation->id}}
                                            @if (isset($product->sublocations) && in_array($sublocation->id, $product->sublocations))
                                                selected="selected"
                                                @endif
                                            >{{ $sublocation->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif

                        <div class="form-row form-group row">
                            <label for="description" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" id="description" name="description"
                                          rows="3">{{ isset($product->description) ? $product->description : '' }}</textarea>
                            </div>
                        </div>

                    </div>

                    <div class="col-sm-4">
                        <div class="wrapper">
                            <div class="box" id="box-image">
                                @if ($type == 'edit' || $type == 'view')
                                    <div class="js--image-preview js--no-default"
                                         style="background-image: url({{ $product->image }})"></div>
                                @else
                                    <div class="js--image-preview"></div>
                                @endif
                                <div class="upload-options">
                                    <label>

                                        @if ($type == 'edit')
                                            <input type="file" class="image-upload" name="image[name]" accept="image/*" value="{{ $product->name . '.png' }}"/>
                                            <input type="hidden" id="image-body" name="image[body]" value="{{ $product->image }}"/>
                                        @else
                                            <input type="file" class="image-upload" name="image[name]" accept="image/*"/>
                                            <input type="hidden" id="image-body" name="image[body]" value=""/>
                                        @endif
                                    </label>
                                </div>
                            </div>
                            <div class="validation" style="margin-left: 10px;">@error('image[name]') {{$message}} @enderror </div>
                        </div>
                    </div>

                    <div class="col-sm-1"></div>
                </div>

                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col">
                        @if ($type == 'new')
                            <button type="submit" class="btn btn-dark">Add product</button>
                        @elseif($type == 'edit')
                            <button type="submit" class="btn btn-dark">Edit product</button>
                        @endif
                        <a href="{{ URL::route('productsAll') }}" class="btn btn-secondary float-right">Back</a>
                    </div>
                    <div class="col-sm-1"></div>
                </div>
            </form>
        </div>
    </div>

@endsection
