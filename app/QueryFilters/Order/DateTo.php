<?php


namespace App\QueryFilters\Order;


use App\QueryFilters\Filter;
use Carbon\Carbon;

class DateTo extends Filter
{
    protected function applyFilter($builder)
    {
        return  $builder->where('date', '<=', Carbon::parse(strtotime(request($this->filterName())))->format('Y-m-d H:i:s'));
    }
}
