<?php


namespace App\QueryFilters\employee;


use App\QueryFilters\Filter;

class FirstnameSort extends Filter
{
    protected function applyFilter($builder)
    {
        return $builder->orderBy('firstname', request($this->filterName()));
    }
}
