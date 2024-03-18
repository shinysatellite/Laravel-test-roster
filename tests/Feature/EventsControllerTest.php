<?php

namespace Tests\Feature;

use App\Constants\ActivityConstant;
use Carbon\Carbon;
use Tests\TestCase;

class EventsControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_search_by_date()
    {
        // Assuming you have events in the database
        $startDate = '2022/1/11';
        $endDate = '2022/1/12';

        $uri = "/event/searchByDate?start_date={$startDate}&end_date={$endDate}";

        $response = $this->getJson($uri);


        $response->assertStatus(200);

        $events = $response->json()["data"];

        foreach ($events as $event) {
            $eventDate = Carbon::create($event['date']);
            $this->assertTrue($eventDate->between(Carbon::create($startDate), Carbon::create($endDate)));
        }
    }

    public function test_search_next_week_flights()
    {
        // Assuming you have events in the database
        $current = Carbon::create('2022-01-14');
        $oneWeekLater = $current->copy()->addWeeks(1);

        $uri = "/event/searchNextWeekFlights";

        $response = $this->getJson($uri);

        $response->assertStatus(200);

        $events = $response->json()["data"];

        foreach ($events as $event) {
            $eventDate = Carbon::create($event['date']);
            $this->assertTrue($eventDate->between($current, $oneWeekLater));
        }
    }

    public function test_search_next_week_standby_events()
    {
        // Assuming you have events in the database
        $current = Carbon::create('2022-01-14');
        $oneWeekLater = $current->copy()->addWeeks(1);
        $activity = ActivityConstant::STAND_BY;

        $uri = "/event/searchNextWeekStandbyEvents";
        $response = $this->getJson($uri);
        $response->assertStatus(200);

        $events = $response->json()["data"];

        foreach ($events as $event) {
            $eventDate = Carbon::create($event['date']);
            $this->assertTrue($eventDate->between($current, $oneWeekLater));
            $this->assertTrue(($event['activity'] === $activity));
        }
    }

    public function test_search_all_flights_with_start_location()
    {
        // Assuming you have events in the database
        $location = 'KRP';

        $uri = "/event/searchAllFlightsWithStartLocation?location={$location}";
        $response = $this->getJson($uri);
        $response->assertStatus(200);

        $events = $response->json()["data"];

        foreach ($events as $event) {
            $eventDate = Carbon::create($event['date']);
            $this->assertTrue(($event['from'] === $location));
        }
    }
}
