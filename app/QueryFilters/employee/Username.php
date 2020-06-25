<?php


namespace App\QueryFilters\employee;


use App\QueryFilters\Filter;

class Username extends Filter
{
    protected function applyFilter($builder)
    {
        return $builder
            ->select('employees.*')
            ->join('users', 'employees.id', '=', 'users.employee_id')
            ->where('users.name', 'like', '%' . request($this->filterName()) . '%');
    }
}
