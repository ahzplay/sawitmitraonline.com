<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pks extends Model
{
    public function region_province(){
        return $this->belongsTo(Region::class,'region_id');
    }

    public function region_city(){
        return $this->belongsTo(Region::class,'region_id');
    }

    public function region_district(){
        return $this->belongsTo(Region::class,'region_id');
    }

    public function region_sub_district(){
        return $this->belongsTo(Region::class,'region_id');
    }
}
