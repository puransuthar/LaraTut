<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    protected $table = 'company';

    function myUser(){
        return $this->hasMany('App\User','c_name','c_name');
    }
}
