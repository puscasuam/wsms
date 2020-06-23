<?php


namespace App\QueryFilters\Partner;


use App\QueryFilters\Filter;

class Email extends Filter
{
    protected function applyFilter($builder)
    {
        return $builder->where('email', 'like', '%' . request($this->filterName()) . '%');
    }
}
