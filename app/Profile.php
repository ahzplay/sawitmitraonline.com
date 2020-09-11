<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id', 'full_name', 'nick_name', 'phone_number', 'birth_place', 'birth_date', 'address', 'province', 'city', 'district', 'sub_district', 'description'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
