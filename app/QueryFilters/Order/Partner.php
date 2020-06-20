<?php


namespace App\QueryFilters\Order;

use App\QueryFilters\Filter;

class Partner extends Filter
{
    protected function applyFilter($builder)
    {
        return $builder->whereIn('partner_id', request($this->filterName()));
    }
}

