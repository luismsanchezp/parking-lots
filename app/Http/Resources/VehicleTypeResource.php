<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VehicleTypeResource extends JsonResource
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
            'id' =>$this->id,
            'vehicle_type' => $this->vehicle_type,
            'tariff' => $this->tariff,
            'creation_date' => $this->creation_date,
            'parking_lot_id' => $this->parking_lot_id,
        ];
    }
}
