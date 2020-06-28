@extends('layouts.includes.main')


@section('content')

    <!-- view -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">

            <h6 class="m-0 font-weight-bold text-dark">View
                product {{ isset($product->name) ? $product->name : '' }}</h6>

        </div>
        <div class="card-body">

            <div class="card mb-12" style="width: 100%;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <div class="wrapper">
                            <div class="box">
                                <div class="js--image-preview js--no-default"
                                     style="background-image: url({{ $product->image }}); height: 300px"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold text-dark">{{ isset($product->name) ? $product->name : '' }}</h5>

                            <p class="card-text">
                                Price: {{ isset($product->price) ? $product->price : '' }}<br/>
                                Stock: {{ isset($product->stock) ? $product->stock : '' }}<br/>
                                Brand:
                                @foreach($brands as $brand)
                                    {{(isset($product->brand_id) && $brand->id == $product->brand_id) ? $brand->name : ''}}
                                @endforeach
                                <br/>
                                Category:
                                @foreach($categories as $category)
                                    {{(isset($product->category_id) && $category->id == $product->category_id) ? $category->name : ''}}
                                @endforeach
                                <br/>
                                Materials:
                                @foreach($product->materials as $material)
                                    {{isset($material) ? $material->name . ', ' : ''}}
                                @endforeach
                                <br/>
                                Gemstones:
                                @foreach($product->gemstones as $gemstone)
                                    {{isset($gemstone) ? $gemstone->name . ', ' : ''}}
                                @endforeach
                                <br/>
                                Locations:
                            {{ \App\Helper\ProductHelper::getProductsNoFromSublocation($product) }}
                                <br/>
                                Description: {{ isset($product->description) ? $product->description : '' }}<br/>
                            <p class="card-text"></p>
                            <p class="card-text"><small class="text-muted">
                                    Added at {{ isset($product->created_at) ? $product->created_at : '' }}
                                </small></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-sm-1"></div>
                <div class="col">
                    @can('isAuthorized', \App\Product::class)
                        <a href="{{ URL('/product/'.$product->id )}}" class="btn btn-dark">
                            Edit
                        </a>
                    @endcan
                    <a href="{{ URL::route('productsAll') }}" class="btn btn-secondary float-right">Back</a>
                </div>
                <div class="col-sm-1"></div>
            </div>

        </div>
    </div>

@endsection
