<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    public function order_type()
    {
        return $this->belongsTo(Order_type::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product');
    }
}
