<?php

namespace App\Helper;

use App\Brand;
use App\Category;
use App\Gemstone;
use App\Material;
use App\Product;
use App\QueryFilters\Product\Name;
use App\QueryFilters\Product\PriceFrom;
use App\QueryFilters\Product\PriceTo;
use App\QueryFilters\Product\StockFrom;
use App\QueryFilters\Product\StockTo;
use App\Sublocation;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;

class ProductHelper implements InterfaceHelper
{
    /**
     * Form used for add new product, edit product and view details
     *
     * @param null $product - initial is null (for add new product case). For edit and view will be the selected product
     * @param string $type - initial is 'new'. Can be changed for 'edit' or 'view'
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function form($product = null, $type = 'new')
    {
        $brands = Brand::all();
        $gemstones = Gemstone::all();
        $categories = Category::all();
        $materials = Material::all();
        $sublocations = Sublocation::all();

        return view('/product/new', [
            'brands' => $brands,
            'gemstones' => $gemstones,
            'categories' => $categories,
            'materials' => $materials,
            'sublocations' => $sublocations,
            'product' => $product,
            'type' => $type,
        ]);
    }

    /**
     * Get a product - used for editing the product
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function get(int $id)
    {
        $product = Product::find($id);
        if ($product) {
            return $this->form($product, 'edit');
        }
    }

    /**
     * Get a product - used for view a product
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view(int $id)
    {
        $product = Product::find($id);
        if ($product) {
            return $this->form($product, 'view');
        }
    }

    public function all(Request $request)
    {
        $products = Product::all();
        $brands = Brand::all();
        $gemstones = Gemstone::all();
        $categories = Category::all();
        $materials = Material::all();
        $sublocations = Sublocation::all();

        if ($request->isMethod('post')) {
            $pipeline = app(Pipeline::class)
                ->send(Product::query()
//                    ->select('products.*', 'gemstone_product.gemstone_id', 'material_product.material_id',
//                        'product_sublocation.sublocation_id')
//                    ->join('gemstone_product', 'products.id', '=', 'gemstone_product.product_id')
//                    ->join('material_product', 'products.id', '=', 'material_product.product_id')
//                    ->join('product_sublocation', 'products.id', '=', 'product_sublocation.product_id')
                )
                ->through([
                    Name::class,
                    PriceFrom::class,
                    PriceTo::class,
                    StockFrom::class,
                    StockTo::class,
                    \App\QueryFilters\Product\Brand::class
                ])
                ->thenReturn();

            $products = $pipeline->get();
        }

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
            'categories' => $categories,
            'materials' => $materials,
            'sublocations' => $sublocations
        ]);

//        $products = Product::all();
//        return view('product/all', ['products' => $products]);
    }

    /**
     *
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function post(Request $request)
    {
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
        $product->image = $request->name . '.png';
        $product->brand_id = $request->brand;
        $product->category_id = $request->category;
        $product->description = $request->description;
        $product->save();

        //for relations many to many
        $product->gemstone()->attach($request->gemstone);
        $product->material()->attach($request->material);

        // stave image in public/storage/product
        ImageHelper::base64ToJpg($request->image['body'], $product->image);

        return redirect()->back();
    }

    public function put(Request $request)
    {

    }

    public function delete(int $id)
    {
        $product = Product::find($id);
        if ($product) {
            $destroy = $product->delete();
        }
        return $destroy;
    }
}
