<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sublocation extends Model
{
    protected $table = "sublocations";

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
