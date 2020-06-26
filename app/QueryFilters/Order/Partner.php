<?php


namespace App\QueryFilters\Order;

use App\QueryFilters\Filter;

class Partner extends Filter
{
    protected function applyFilter($builder)
    {
        return $builder
            ->select('orders.*')
            ->join('partners', 'orders.partner_id', '=', 'partners.id')
            ->where('partners.deleted_at','=', 'NULL')
            ->whereIn('partner_id', request($this->filterName()));

//        return $builder->whereIn('partner_id', request($this->filterName()));



    }


}

