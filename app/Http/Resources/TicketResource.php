<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Ticket;
use DateTime;

class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'license_plate' => (new VehicleResource($this->tickets))->only('license_plate'),
            'vehicle_type' => (new VehicleTypeResource($this->tickets))->only('vehicle_type'),
            'entry_date' => $this->entry_date,
            'remove_date' => $this->when(Ticket::payed(), 'remove_date'),
            'time_parked' => $this->time_parked,
            'tariff' => (new VehicleTypeResource($this->tickets))->only('tariff'),
            'total' => $this->when(Ticket::payed(), 'total'),
        ];
    }
}
