<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\SimpleAjaxCrud;
use App\Imports\StudentImport;
use App\Exports\StudentExport;

use Excel;

class ExportExcelController extends Controller
{
    public function index(){
        $data = SimpleAjaxCrud::orderby('id', 'ASC')->get();
        return view('export_excel', compact('data'));
    }
    public function excel(){
        return Excel::download(new StudentExport, 'students.xlsx');
    }
    public function csv(){
        return Excel::download(new StudentExport, 'students.csv');
    }
    public function import_excel(Request $request){
        Excel::import(new StudentImport, $request->file('file')->store('temp'));
        return back();
    }
}
