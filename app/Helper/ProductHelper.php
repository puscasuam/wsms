<?php


namespace App\Helper;


use App\Brand;
use App\Category;
use App\Gemstone;
use App\Material;
use App\Product;
use App\Sublocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductHelper implements InterfaceHelper
{

    public function form()
    {
        $brands = Brand::all();
        $gemstones = Gemstone::all();
        $categories = Category::all();
        $materials = Material::all();
        $sublocations = Sublocation::all();

        return view('/product/new', [
            'brands' => $brands,
            'gemstones' => $gemstones,
            'categories'=> $categories,
            'materials' =>$materials,
            'sublocations' => $sublocations]);
    }


    public function get(int $id){
        $product = Product::find($id);
        if($product){
            $result = $product;
        }
        return $result;
    }

    public function all(Request $request){
        $products = Product::all();
        $brands = Brand::all();
        $gemstones = Gemstone::all();
        $categories = Category::all();
        $materials = Material::all();
        $sublocations = Sublocation::all();

//        if($request->has('brand')){
//            $products = DB::table('products')
//                ->select('products.*')
//                ->join('brands', 'brands.id', '=', 'products.brand_id')
//                ->where('brands.name', "Ettika")
//                ->get()->toArray();
//
//            dd($products);
//        }

//        $products = Product::query()
//            ->select('products.name', 'products.price')
//            ->join('brands', 'brands.id', '=', 'products.brand_id')
//            ->where('brands.name', "Ettika")
//            ->where('products.name', "thju65")
//            ->get()->toArray();

//        dd($products);



        return view('product/all', [
            'products' => $products,
            'brands' => $brands,
            'gemstones' => $gemstones,
            'categories'=> $categories,
            'materials' =>$materials,
            'sublocations' => $sublocations
            ]);

//        $products = Product::all();
//        return view('product/all', ['products' => $products]);
    }

    public function post(Request $request){
        $data = $request->validate([
            'name' => 'required | min:2',
            'price' => 'required',
            'stock' => 'required',
            'brand' => 'required',
            'category' => 'required',
            'image' => 'required',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->image = "prod1";
        $product->brand_id = $request->brand;
        $product->category_id = $request->category;
        $product->description = $request->description;
        $product->save();

        $product->gemstone()->attach($request->gemstone);
        $product->material()->attach($request->material);

        return redirect()->back();
    }

    public function put(Request $request){

    }

    public function delete(int $id){
        $product = Product::find($id);
        if($product){
            $destroy = $product->delete();
        }
        return $destroy;
    }


}
