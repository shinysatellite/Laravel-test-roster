<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExcelImportRequest;
use App\Http\Requests\SearchEventByDateRequest;
use App\Models\Event;
use App\Services\ExcelImportService;
use Carbon\Carbon;

class EventsController extends Controller
{

    public function __construct(private ExcelImportService $excelImportService)
    {
    }

    /**
     * parse excel file and store data to sqlite
     *
     * @param ExcelImportRequest $request
     */
    public function parseEvent(ExcelImportRequest $request)
    {
        try {
            $file = $request->file('file');
            $this->excelImportService->import($file);

            return response()->json([
                'status' => 'success',
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 0);
        }
    }

    /**
     *
     * @param SearchEventByDateRequest $request
     *
     */
    public function searchByDate(SearchEventByDateRequest $request): array
    {
        $startDate = Carbon::create($request->input('start_date'));
        $endDate = Carbon::create($request->input('end_date'));

        $events = Event::whereBetween('date', [$startDate, $endDate])
            ->get();

        return response()->json([
            'status' => 'success',
            'events' => $events
        ]);
    }
}
