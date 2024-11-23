<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class propertyfeature extends Model
{
    protected $guarded=[];

    public function property()
    {
        return $this->belongsTo(property::class);
    }
}
