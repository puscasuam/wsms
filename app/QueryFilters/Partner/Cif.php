<?php


namespace App\QueryFilters\Partner;


use App\QueryFilters\Filter;

class Cif extends Filter
{
    protected function applyFilter($builder)
    {
        return $builder->where('cif', 'like', '%' . request($this->filterName()) . '%');
    }

}
