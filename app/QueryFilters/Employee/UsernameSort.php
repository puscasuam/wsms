<?php


namespace App\QueryFilters\Employee;


use App\QueryFilters\Filter;

class UsernameSort extends Filter
{
    protected function applyFilter($builder)
    {
        return $builder
            ->select('employees.*', 'users.*')
            ->join('users', 'employees.id', '=', 'users.employee_id')
            ->prderBy('users.name', request($this->filterName()));
    }

}
