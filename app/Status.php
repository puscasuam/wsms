<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = "statuses";

    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }
}
