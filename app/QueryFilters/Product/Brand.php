<?php


namespace App\QueryFilters\Product;

use App\QueryFilters\Filter;

class Brand extends Filter
{
    protected function applyFilter($builder)
    {
        return $builder->whereIn('brand_id', request($this->filterName()));
    }
}
