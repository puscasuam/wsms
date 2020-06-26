<?php


namespace App\QueryFilters\Order;


use App\QueryFilters\Filter;

class FinalAmountSort extends Filter
{
    protected function applyFilter($builder)
    {
        return $builder->orderBy('final_amount', request($this->filterName()));
    }
}
