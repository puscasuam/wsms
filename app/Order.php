<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    protected $table = "orders";
    use SoftDeletes;

    public function partner()
    {
        return $this->belongsTo(Partner::class)->withTrashed();;
    }

    public function order_type()
    {
        return $this->belongsTo(Order_type::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product')->withTrashed();
    }
}
