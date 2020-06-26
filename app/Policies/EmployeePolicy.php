<?php

namespace App\Policies;

use App\Employee;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class EmployeePolicy
{
    use HandlesAuthorization;

    public function isAuthorized(User $user){
        $employee = Employee::find($user->employee_id);
        if($employee && $employee->admin === 1) {
            return true;
        }
        return false;
    }

    public function isAuthorizedOrIsUser(User $user, $isCurrentUser = false){
        $employee = Employee::find($user->employee_id);
        if($employee && ($employee->admin === 1 || $isCurrentUser === true)) {
            return true;
        }
        return false;
    }
}
