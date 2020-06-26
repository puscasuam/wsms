<?php


namespace App\QueryFilters\Order;


use App\QueryFilters\Filter;

class DateSort extends Filter
{
    protected function applyFilter($builder)
    {
        return $builder->orderBy('date', request($this->filterName()));
    }
}
