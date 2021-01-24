<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RestoController extends Controller
{
    //
    function index(){
        return view('resto');
    }

    function list(){
        return view('list');
    }
}
