<?php


namespace App\QueryFilters\Employee;


use App\QueryFilters\Filter;

class LastnameSort extends Filter
{
    protected function applyFilter($builder)
    {
        return $builder->orderBy('lastname', request($this->filterName()));
    }
}
