<?php


namespace App\QueryFilters\Employee;


use App\QueryFilters\Filter;

class Mobile extends Filter
{
    protected function applyFilter($builder)
    {
        return $builder->where('mobile', 'like', '%' . request($this->filterName()) . '%');
    }
}
