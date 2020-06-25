<?php


namespace App\QueryFilters\employee;

use App\QueryFilters\Filter;
use Closure;

class Firstname extends Filter
{
    protected function applyFilter($builder)
    {
        return $builder->where('firstname', 'like', '%' . request($this->filterName()) . '%');
    }
}
