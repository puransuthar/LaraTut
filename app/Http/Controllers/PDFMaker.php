<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class PDFMaker extends Controller
{
    //
    public function makePdf(){
        $pdf = App::make('dompdf.wrapper');
        $data = '<h1>Hello</h1><h2 style="color:red;">This is sub heading</h2>';
        $pdf->loadHTML($data);
        return $pdf->stream();
    } 
}
