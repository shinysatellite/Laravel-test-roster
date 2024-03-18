<?php

namespace App\Services;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class EventService
{
    public function getEventsByPeriod(Carbon $startDate, Carbon $endDate): Collection
    {
        return Event::whereBetween('date', [$startDate, $endDate])
            ->get();
    }

    public function getStatusEventsByPeriod(Carbon $startDate, Carbon $endDate, string $activity): Collection
    {
        return Event::whereBetween('date', [$startDate, $endDate])
            ->where('activity', $activity)
            ->get();
    }

    public function getAllFlightsWithStartLocation(string $location): Collection
    {
        return Event::where('from', $location)->get();
    }
}
