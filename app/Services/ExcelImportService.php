<?php

namespace App\Services;

use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;

class ExcelImportService
{
    public function import($file)
    {
        Excel::import(new UsersImport, $file);
    }
}
