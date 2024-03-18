<?php
namespace App\Imports;

use App\Models\Event;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class UsersImport implements ToModel, WithStartRow
{
    public function model(array $row)
    {
        return new Event([
            'date' => Carbon::create($row[0]),
            'dc' => $row[2],
            'ci' => $row[4],
            'co' => $row[6],
            'activity' => $row[7],
            'remark' => $row[8],
            'from' => $row[10],
            'to' => $row[14],
            'std' => $row[12],
            'sta' => $row[16],
            'ac' => $row[18],
            'blh' => $row[19]
        ]);
    }

    public function startRow(): int
    {
        return 2; // Skip the first row (headers)
    }
}
