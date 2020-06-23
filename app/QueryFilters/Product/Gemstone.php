<?php


namespace App\QueryFilters\Product;


use App\QueryFilters\Filter;

class Gemstone extends Filter
{
    protected function applyFilter($builder)
    {
        return $builder
            ->select('products.*')
            ->distinct()
            ->leftJoin('gemstone_product', 'products.id', '=', 'gemstone_product.product_id')
            ->whereIn('gemstone_product.gemstone_id', request($this->filterName()));
    }
}
