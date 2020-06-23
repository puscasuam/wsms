<?php


namespace App\QueryFilters\Product;

use App\QueryFilters\Filter;

class Material extends Filter
{
    protected function applyFilter($builder)
    {
        return $builder
            ->select('products.*')
            ->distinct()
            ->join('material_product', 'products.id', '=', 'material_product.product_id')
            ->whereIn('material_product.material_id', request($this->filterName()));
    }
}

