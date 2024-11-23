<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class propertyasset extends Model
{
    protected $guarded=[];

    public function property(){
        return $this->belongsTo(property::class);
    }
}
