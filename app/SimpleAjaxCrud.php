<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class SimpleAjaxCrud extends Model
{
    protected $fillable = [
        'first_name', 'last_name', 'image'
    ];
    public static function getStudents(){
        $records = DB::table('simple_ajax_cruds')->select('id','first_name','last_name')->orderBy('id','asc')->get()->toArray();
        return $records;
    }
}
