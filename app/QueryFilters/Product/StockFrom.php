<?php


namespace App\QueryFilters\Product;


use App\QueryFilters\Filter;

class StockFrom extends Filter
{
    protected function applyFilter($builder)
    {
        return  $builder->where('stock', '>=', request($this->filterName()));
    }

}
