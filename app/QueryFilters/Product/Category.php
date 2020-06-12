<?php


namespace App\QueryFilters\Product;


use App\QueryFilters\Filter;

class Category extends Filter
{
    protected function applyFilter($builder)
    {
        return $builder->whereIn('category_id', request($this->filterName()));
    }

}
