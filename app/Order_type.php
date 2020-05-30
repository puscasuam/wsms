<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_type extends Model
{
    protected $table = "order_types";
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
