<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{

    /**
     * @param Request $request
     *
     * @return array
     */
    public function toArray($request): array
    {
        $data = [
            'id' => $this->id,
            'date' => $this->date,
            'activity' => $this->activity,
            'from' => $this->from,
            'to' => $this->to,
            'scheduled_time_departure' => $this->std,
            'scheduled_time_arrival' => $this->sta,
            'check_in' => $this->ci,
            'check_out' => $this->co,
        ];

        return $data;
    }
}
