<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    protected $table = "products";
    use SoftDeletes;

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function material()
    {
        return $this->belongsToMany(Material::class, 'material_product');
    }

    public function gemstone()
    {
        return $this->belongsToMany(Gemstone::class, 'gemstone_product');
    }

    public function sublocation()
    {
        return $this->belongsToMany(Sublocation::class, 'product_sublocation');
    }

    public function order()
    {
        return $this->belongsToMany(Order::class, 'order_product');
    }
}
