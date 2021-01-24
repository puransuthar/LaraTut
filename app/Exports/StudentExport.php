<?php

namespace App\Exports;

use App\SimpleAjaxCrud;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentExport implements FromCollection,WithHeadings
{
    public function headings():array
    {
        return [
            'ID',
            'First Name',
            'Last Name'
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect(SimpleAjaxCrud::getStudents());
        //return SimpleAjaxCrud::all();
    }
}
