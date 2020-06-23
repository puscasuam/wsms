<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partner extends Model
{
    protected $table = "partners";
    use SoftDeletes;

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}

