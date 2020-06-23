<?php


namespace App\QueryFilters\Product;


use App\QueryFilters\Filter;

class stockSort extends Filter
{
    protected function applyFilter($builder)
    {
        return $builder->orderBy('stock', request($this->filterName()));
    }
}
