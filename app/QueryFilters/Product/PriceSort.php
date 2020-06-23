<?php


namespace App\QueryFilters\Product;


use App\QueryFilters\Filter;

class PriceSort extends Filter
{
    protected function applyFilter($builder)
    {
        return $builder->orderBy('price', request($this->filterName()));
    }
}
