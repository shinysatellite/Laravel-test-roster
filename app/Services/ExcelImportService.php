<?php

namespace App\Services;

use Maatwebsite\Excel\Facades\Excel;

class ExcelImportService
{
    public function import($file)
    {
        $data = Excel::toCollection(null, $file);

        // Assuming the first sheet is the one you want to import
        $rows = $data->first();

        foreach ($rows as $row) {
            dd($row);
            // Event::create([
            //     'column1' => $row[0], // Assuming column1 is the first column
            //     'column2' => $row[1], // Assuming column2 is the second column
            //     // Add more columns as needed
            // ]);
        }
    }
}
