<?php


namespace App\QueryFilters\Order;


use App\QueryFilters\Filter;

class AmountTo extends Filter
{
    protected function applyFilter($builder)
    {
        return $builder->where('amount', '<=', request($this->filterName()));
    }
}
