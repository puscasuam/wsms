<?php


namespace App\QueryFilters\Product;

use App\QueryFilters\Filter;
use Closure;

class Name extends Filter
{
    protected function applyFilter($builder)
    {
        return $builder->where('name', 'like', '%' . request($this->filterName()) . '%');
    }
}
