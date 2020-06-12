<?php


namespace App\QueryFilters\Product;

use App\QueryFilters\Filter;
use Closure;

class PriceTo extends Filter
{
    protected function applyFilter($builder)
    {
        return $builder->where('price', '<=', request($this->filterName()));
    }
}
