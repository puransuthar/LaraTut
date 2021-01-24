<?php

namespace App\Imports;

use App\SimpleAjaxCrud;
use Maatwebsite\Excel\Concerns\ToModel;

class StudentImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new SimpleAjaxCrud([
            //
        ]);
    }
}
