<?php


namespace App\QueryFilters\Employee;


use App\QueryFilters\Filter;

class Role extends Filter
{
    protected function applyFilter($builder)
    {
        return $builder->where('admin', '=', request($this->filterName()));
    }
}
