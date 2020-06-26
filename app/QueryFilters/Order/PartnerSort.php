<?php


namespace App\QueryFilters\Order;


use App\QueryFilters\Filter;

class PartnerSort extends Filter
{
    protected function applyFilter($builder)
    {
        return $builder
            ->select('orders.*', 'partners.name')
            ->join('partners', 'orders.partner_id', '=', 'partners.id')
            ->orderBy('partners.name', request($this->filterName()));
    }
}

