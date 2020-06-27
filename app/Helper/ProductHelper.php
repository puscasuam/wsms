<?php

namespace App\Helper;

use App\Brand;
use App\Category;
use App\Gemstone;
use App\Material;
use App\Product;
use App\QueryFilters\Product\BrandSort;
use App\QueryFilters\Product\Location;
use App\QueryFilters\Product\Name;
use App\QueryFilters\Product\NameSort;
use App\QueryFilters\Product\PriceFrom;
use App\QueryFilters\Product\PriceSort;
use App\QueryFilters\Product\PriceTo;
use App\QueryFilters\Product\StockFrom;
use App\QueryFilters\Product\stockSort;
use App\QueryFilters\Product\StockTo;
use App\Sublocation;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\DB;

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

        if ($type == 'edit' || $type == 'view') {

            $product->materials = DB::table('material_product')
                ->select('material_id')
                ->where('product_id', $product->id)
                ->pluck('material_id')->toArray();

            $product->gemstones = DB::table('gemstone_product')
                ->select('gemstone_id')
                ->where('product_id', $product->id)
                ->pluck('gemstone_id')->toArray();

            $product->sublocations = DB::table('product_sublocation')
                ->select('sublocation_id')
                ->where('product_id', $product->id)
                ->pluck('sublocation_id')->toArray();

            $product->image = ImageHelper::pngToBase64('product', $product->image);
        }

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
        $brands = Brand::all();
        $product = Product::find($id);
        $categories = Category::all();
        $materials = Material::all();
        $gemstones = Gemstone::all();

        if ($product) {
            $product->materials = DB::table('material_product')
                ->select('material_product.material_id', 'materials.name')
                ->join('materials', 'material_product.material_id', '=', 'materials.id')
                ->where('product_id', $product->id)
                ->get();

            $product->gemstones = DB::table('gemstone_product')
                ->select('gemstone_product.gemstone_id', 'gemstones.name')
                ->join('gemstones', 'gemstone_product.gemstone_id', '=', 'gemstones.id')
                ->where('product_id', $product->id)
                ->get();

            $product->sublocations = DB::table('product_sublocation')
                ->select('sublocation_id')
                ->where('product_id', $product->id)
                ->pluck('sublocation_id')->toArray();

            $product->image = ImageHelper::pngToBase64('product', $product->image);
        }

        return view('/product/view', [
            'brands' => $brands,
            'gemstones' => $gemstones,
            'categories' => $categories,
            'materials' => $materials,
//            'sublocations' => $sublocations,
            'product' => $product,
        ]);
    }

    public function all(Request $request)
    {
        $products = Product::all();
        $brands = Brand::all();
        $gemstones = Gemstone::all();
        $categories = Category::all();
        $materials = Material::all();
        $sublocations = Sublocation::query()->where('capacity', '<', '10')->get();

        if($request->isMethod('get')){

            $pipeline = app(Pipeline::class)
                ->send(Product::query())
                ->through([
                    Name::class,
                    PriceFrom::class,
                    PriceTo::class,
                    StockFrom::class,
                    StockTo::class,
                    \App\QueryFilters\Product\Brand::class,
                    \App\QueryFilters\Product\Gemstone::class,
                    \App\QueryFilters\Product\Material::class,
                    \App\QueryFilters\Product\Category::class,
                    Location::class,
                    NameSort::class,
                    BrandSort::class,
                    PriceSort::class,
                    StockSort::class,
                ])
                ->thenReturn();

            $products = $pipeline->paginate(6);
        }

        if ($request->isMethod('post')) {
            $pipeline = app(Pipeline::class)
                ->send(Product::query())
                ->through([
                    Name::class,
                    PriceFrom::class,
                    PriceTo::class,
                    StockFrom::class,
                    StockTo::class,
                    \App\QueryFilters\Product\Brand::class,
                    \App\QueryFilters\Product\Gemstone::class,
                    \App\QueryFilters\Product\Material::class,
                    \App\QueryFilters\Product\Category::class,
                    Location::class,
                    NameSort::class,
                    BrandSort::class,
                    PriceSort::class,
                    StockSort::class,
                ])
                ->thenReturn();

            $products = $pipeline->paginate(6);
        }

        return view('product/all', [
            'products' => $products,
            'brands' => $brands,
            'gemstones' => $gemstones,
            'categories' => $categories,
            'materials' => $materials,
            'sublocations' => $sublocations,
            'filters' => $request,
        ]);
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
            'brand' => 'required| not_in:0',
            'category' => 'required| not_in:0',
            'image.*' => 'required | string',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->price = 0;
        $product->stock = 0;
        $product->image = $request->name . '.png';
        $product->brand_id = $request->brand;
        $product->category_id = $request->category;
        $product->description = $request->description;
        $product->save();

        // For relations many to many
        $product->gemstone()->attach($request->gemstone);
        $product->material()->attach($request->material);

        // Save image in public/storage/product
        ImageHelper::base64ToPng('product', $request->image['body'], $product->image);

        return redirect()->route('productsAll');
    }

    public function put(Request $request)
    {
        $data = $request->validate([
            'name' => 'required | min:2',
            'brand' => 'required',
            'category' => 'required',
//            'image.*' => 'required | string',
        ]);

        $product = Product::find($request->id);

        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->image = $request->name . '.png';
        $product->brand_id = $request->brand;
        $product->category_id = $request->category;
        $product->description = $request->description;
        $product->save();

        // Remove all old many to many relations
        $oldGemstones = DB::table('gemstone_product')
            ->select('gemstone_id')
            ->where('product_id', $product->id)
            ->pluck('gemstone_id')->toArray();
        $product->gemstone()->detach($oldGemstones);

        $oldMaterials = DB::table('material_product')
            ->select('material_id')
            ->where('product_id', $product->id)
            ->pluck('material_id')->toArray();
        $product->material()->detach($oldMaterials);

        // Add all new many to many relations
        $product->gemstone()->attach($request->gemstone);
        $product->material()->attach($request->material);

        // Save image in public/storage/product
        ImageHelper::base64ToPng('product', $request->image['body'], $product->image);

        return redirect()->route('productsAll');
    }

    public function delete(int $id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
        }
        return redirect()->back();
    }

    /**
     * Get Number of Products displayed on each Sublocation that
     * he is part from.
     *
     * @param Product $product
     * @return false|string
     */
    public static function getProductsNoFromSublocation(Product $product)
    {
        // Deallocate products from sublocations
        $productSublocations = DB::table('product_sublocation')
            ->groupBy('sublocation_id')
            ->selectRaw('sublocation_id, sum(units) as sum_units')
            ->where('product_id', '=', $product->id)
            ->having('sum_units', '>', 0)
            ->get();

        $productNoFromSublocationsString = '';
        foreach ($productSublocations as $productSublocation) {
            $sublocation = Sublocation::find($productSublocation->sublocation_id);

            $productNoFromSublocationsString .= $sublocation->name . '[ ' . $productSublocation->sum_units . ' ], ';
        }

        return substr($productNoFromSublocationsString, 0 , -2);
    }
}
