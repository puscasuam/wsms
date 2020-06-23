<?php


namespace App\QueryFilters\Partner;

use App\QueryFilters\Filter;

class Type extends Filter
{
    protected function applyFilter($builder)
    {
        return $builder
            ->select('partners.*')
            ->distinct()
            ->leftJoin('orders', 'partners.id', '=', 'orders.partner_id')
            ->where('orders.order_type_id', '=', request($this->filterName()));
    }
}
