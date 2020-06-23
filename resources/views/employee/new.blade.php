@section('content')

    <!-- Form -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <input type="hidden" id="product-form-type" value="{{$type}}"/>

            @if ($type == 'new')
                <h6 class="m-0 font-weight-bold text-primary">Add new employee</h6>
            @elseif ($type == 'edit')
                <h6 class="m-0 font-weight-bold text-primary">Edit employee</h6>
            @else ()
                <h6 class="m-0 font-weight-bold text-primary">View employee</h6>
            @endif

        </div>
        <div class="card-body">
            <form id="product-form" action="/product" method="post" class="form-horizontal row-fluid">
                @csrf

                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-6">
                        <div class="form-row form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{ isset($product->name) ? $product->name : '' }}"
                                       placeholder="Enter product name" autocomplete="off">
                                <div class="validation">@error('name') {{$message}} @enderror </div>
                            </div>
                        </div>


                        @if ($type == 'edit' || $type == 'view')
                            <div class="form-row form-group row">
                                <label for="price" class="col-sm-2 col-form-label">Price</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="price" name="price"
                                           value="{{ isset($product->price) ? $product->price : '' }}"
                                           placeholder="Enter product price">
                                    <div class="validation"> @error('price') {{$message}}@enderror </div>
                                </div>
                            </div>
                        @endif


                        @if ($type == 'edit' || $type == 'view')
                            <div class="form-row form-group row">
                                <label for="stock" class="col-sm-2 col-form-label">Stock</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="stock" name="stock"
                                           value="{{ isset($product->stock) ? $product->stock : '' }}"
                                           placeholder="Enter product stock">
                                    <div class="validation"> @error('stock') {{$message}}@enderror </div>
                                </div>
                            </div>
                        @endif

                        <div class="form-row form-group row">
                            <label for="brand" class="col-sm-2 col-form-label">Brand</label>
                            <div class="col-sm-8">
                                <select id="brand" name="brand" class="form-control">
                                    <option selected>Choose brand</option>
                                    @foreach($brands as $brand)
                                        <option value={{$brand->id}}
                                        @if (isset($product->brand_id) && $brand->id == $product->brand_id)
                                            selected="selected"
                                            @endif
                                        >{{ $brand->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-row form-group row">
                            <label for="category" class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-8">
                                <select id="category" name="category" class="form-control">
                                    <option selected>Choose category</option>
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
                                        <input type="file" class="image-upload" name="image[name]" accept="image/*"/>
                                        <input type="hidden" id="image-body" name="image[body]" value=""/>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-1"></div>
                </div>

                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col">
                        @if ($type == 'new')
                            <button type="submit" class="btn btn-primary">Add product</button>
                        @elseif($type == 'edit')
                            <button type="submit" class="btn btn-primary">Edit product</button>
                        @endif
                        <a href="{{ URL::route('productsAll') }}" class="btn btn-secondary float-right">Back</a>
                    </div>
                    <div class="col-sm-1"></div>
                </div>
            </form>
        </div>
    </div>

@endsection
