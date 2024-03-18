<?php

namespace App\Services;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class EventService
{
    public function getEventsByPeriod(Carbon $startDate, Carbon $endDate): Collection
    {
        $events = Event::whereBetween('date', [$startDate, $endDate])
            ->get();
        return $events;
    }

    public function getStatusEventsByPeriod(Carbon $startDate, Carbon $endDate, string $activity): Collection
    {
        $events = Event::whereBetween('date', [$startDate, $endDate])
            ->where('activity', $activity)
            ->get();
        return $events;
    }
}
