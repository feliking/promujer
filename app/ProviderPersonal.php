<?php

namespace App;

use App\City;
use Illuminate\Database\Eloquent\Model;

class ProviderPersonal extends Model
{
    public function city(){
        return $this->belongsTo('App\City');
    }
}
