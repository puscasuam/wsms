<?php


namespace App\QueryFilters\Product;


use App\QueryFilters\Filter;

class NameSort extends Filter
{
    protected function applyFilter($builder)
    {
        return $builder->orderBy('name', request($this->filterName()));
    }
}
