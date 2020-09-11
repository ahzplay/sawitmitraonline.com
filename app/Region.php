<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{

    public function pks_province(){
        return $this->hasOne(Pks::class,'province');
    }

    public function pks_city(){
        return $this->hasOne(Pks::class,'city');
    }

    public function pks_district(){
        return $this->hasOne(Pks::class,'district');
    }

    public function pks_sub_district(){
        return $this->hasOne(Pks::class,'sub_district');
    }
}
