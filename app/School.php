<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    //
    protected $fillable = [

        'name',
        'address',
        'phone',
        'email',
        'contact_person_name',
        'contact_person_email',
        'contact_person_phone',
        'subscription',



    ];

    public function user(){
        return $this->hasMany(User::class);
    }
}
