<?php

namespace App\Policies;

use App\Employee;
use App\Transaction;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransactionPolicy
{
    use HandlesAuthorization;

    public function isAuthorized(User $user){
        $employee = Employee::find($user->employee_id);
        if($employee && $employee->admin === 1) {
            return true;
        }
        return false;
    }
}
