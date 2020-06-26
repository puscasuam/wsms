<?php


namespace App\QueryFilters\Employee;


use App\QueryFilters\Filter;

class Lastname extends Filter
{
    protected function applyFilter($builder)
    {
        return $builder->where('lastname', 'like', '%' . request($this->filterName()) . '%');
    }
}
