<?php


namespace App\QueryFilters\Order;


use App\QueryFilters\Filter;

class OrderType extends Filter
{
    protected function applyFilter($builder)
    {
        return $builder->whereIn('order_type_id', request($this->filterName()));
    }
}
