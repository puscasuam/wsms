<?php


namespace App\QueryFilters\Transaction;


use App\QueryFilters\Filter;

class Status extends Filter
{
    protected function applyFilter($builder)
    {
        return $builder->where('status_id', request($this->filterName()));
    }
}
