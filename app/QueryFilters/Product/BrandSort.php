<?php


namespace App\QueryFilters\Product;


use App\QueryFilters\Filter;

class BrandSort extends Filter
{
    protected function applyFilter($builder)
    {
        return $builder
            ->select('products.*', 'brands.name')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->orderBy('brands.name', request($this->filterName()));
    }
}
