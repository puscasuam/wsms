<?php


namespace App\QueryFilters\Order;


use App\QueryFilters\Filter;

class AmountSort extends Filter
{
    protected function applyFilter($builder)
    {
        return $builder->orderBy('amount', request($this->filterName()));
    }
}
