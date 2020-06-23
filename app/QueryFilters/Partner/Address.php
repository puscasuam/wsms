<?php


namespace App\QueryFilters\Partner;


use App\QueryFilters\Filter;

class Address extends Filter
{
    protected function applyFilter($builder)
    {
        return $builder->where('address', 'like', '%' . request($this->filterName()) . '%');
    }
}
