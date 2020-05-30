<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function addProduct()
    {
        $product = new Product();
        $product->name = "prod1";
        $product->price = 20.20;
        $product->description = "descrip prod 1";
        $product->stock = 6;
        $product->image = "prod1";
        $product->brand_id = 1;
        $product->category_id = 5;
        $product->save();

        return "Product saved";
    }

    public function addProductMaterial()
    {
        $product = Product::find(1);
        $product->material()->attach([1]);

        return $product;
    }

    public function addGemstoneProduct()
    {
        $product = Product::find(1);
        $product->gemstone()->attach([2,4]);

        return $product;
    }

    public function addProductSublocation()
    {
        $product = Product::find(1);
        $product->sublocation()->attach([2,4]);

        return $product;
    }

    public function getAllProducts(){
        return view('products');
    }
}
