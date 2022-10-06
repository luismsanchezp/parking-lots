<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ParkingLotResource extends JsonResource
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
            'name' => $this->name,
            'rows' => $this->rows,
            'columns' => $this->columns,
            'parking_spots' => ParkingSpotResource::collection($this->parking_spots),
            'vehicle_types' => VehicleTypeResource::collection($this->vehicle_types),
            'user_id' => $this->user_id,
        ];
    }
}
