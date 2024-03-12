<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExcelImportRequest;
use App\Services\ExcelImportService;

class EventsController extends Controller
{
    //
    public function parseEvent(ExcelImportRequest $request, ExcelImportService $excelImportService)
    {
        $file = $request->file('file');
        $excelImportService->import($file);

        return redirect()->back()->with('success', 'Excel file imported successfully.');
    }
}
