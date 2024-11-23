<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class property extends Model
{
    protected $guarded=[];

    public function propertyFeature(){
        return $this->hasOne(propertyfeature::class);
    }
    public function propertyAssets(){
        return $this->hasOne(propertyasset::class);
    }
}


