<?php


namespace App\QueryFilters\Transaction;

use App\QueryFilters\Filter;

class Order extends Filter
{
    protected function applyFilter($builder)
    {
        return $builder->where('order_id', 'like', '%' . request($this->filterName()) . '%');
    }
}
