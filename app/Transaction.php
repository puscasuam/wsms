<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = "transactions";

    public function order()
    {
        return $this->hasOne(Order::class);
    }
//
//    public function status()
//    {
//        return $this->belongsTo(Status::class);
//    }
}
