<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    public function provider_company(){
        return $this->belongsTo('App\ProviderCompany');
    }
    public function city(){
        return belongsTo('App\City');
    }
}
