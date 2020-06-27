<?php


namespace App\Helper;


use App\Product;
use App\Sublocation;
use Illuminate\Support\Facades\DB;

class HomeHelper
{
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
