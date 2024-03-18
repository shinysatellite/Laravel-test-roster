<?php

namespace App\Http\Controllers;

use App\Constants\ActivityConstant;
use App\Http\Requests\ExcelImportRequest;
use App\Http\Requests\SearchEventByDateRequest;
use App\Http\Resources\EventResource;
use App\Services\EventService;
use App\Services\ExcelImportService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventsController extends Controller
{

    public function __construct(private ExcelImportService $excelImportService, private EventService $eventService)
    {
    }

    /**
     * parse excel file and store data to sqlite
     *
     * @param ExcelImportRequest $request
     */
    public function parseEvents(ExcelImportRequest $request)
    {
        try {
            $file = $request->file('file');
            $this->excelImportService->import($file);

            return response()->json([
                'status' => 'success',
                'test' => 'succetestss',
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 0);
        }
    }

    /**
     * Get all events between dates
     *
     * @param SearchEventByDateRequest $request
     *
     * @return JsonResource
     */
    public function searchByDate(SearchEventByDateRequest $request): JsonResource
    {
        $startDate = Carbon::create($request->input('start_date'));
        $endDate = Carbon::create($request->input('end_date'));

        $events = $this->eventService->getEventsByPeriod($startDate, $endDate);

        return EventResource::collection($events);
    }

    /**
     * Get all flights for the next week
     *
     * @param Request $request
     *
     * @return JsonResource
     */
    public function searchNextWeekFlights(Request $request): JsonResource
    {
        $current = Carbon::create('2022-01-14');
        $oneWeekLater = $current->copy()->addWeeks(1);

        $events = $this->eventService->getEventsByPeriod($current, $oneWeekLater);

        return EventResource::collection($events);
    }


    /**
     * Search all Standby events for the next week
     *
     * @param Request $request
     *
     * @return JsonResource
     */
    public function searchNextWeekStandbyEvents(Request $request): JsonResource
    {
        $current = Carbon::create('2022-01-14');
        $oneWeekLater = $current->copy()->addWeeks(1);
        $activity = ActivityConstant::STAND_BY;

        $events = $this->eventService->getStatusEventsByPeriod($current, $oneWeekLater, $activity);

        return EventResource::collection($events);
    }
}
