<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExcelImportRequest;
use App\Services\ExcelImportService;

class EventsController extends Controller
{

    public function __construct(private ExcelImportService $excelImportService)
    {
    }
    public function parseEvent(ExcelImportRequest $request)
    {
        $file = $request->file('file');
        $this->excelImportService->import($file);

        return response()->json([
            'status' => 'success',
        ]);
    }
}
