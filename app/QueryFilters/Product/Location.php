<?php


namespace App\QueryFilters\Product;


use App\QueryFilters\Filter;

class Location extends Filter
{
    protected function applyFilter($builder)
    {
        return $builder
            ->select('products.*','product_sublocation.sublocation_id')
            ->join('product_sublocation', 'products.id', '=', 'product_sublocation.product_id')
            ->whereIn('product_sublocation.sublocation_id', request($this->filterName()));
    }
}
