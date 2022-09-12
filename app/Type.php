<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends Model
{
    //
    use SoftDeletes;
    protected $fillable = [
        'name',
    ];

    public function schools(){
        return $this->belongsToMany(School::class);
    }

    public function grade(){
        return $this->hasMany(Grade::class);
    }


}
