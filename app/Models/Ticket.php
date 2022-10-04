<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'parking_spot_id',
        'vehicle_id',
        'vehicle_type_id'
    ];

    protected $casts = [
        'parking_spot_id' => 'integer',
        'vehicle_id' => 'integer',
        'vehicle_type_id' => 'integer',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

    public function vehicle_type()
    {
        return $this->belongsTo(VehicleType::class, 'vehicle_type_id');
    }
    
    public function parking_spot()
    {
        return $this->belongsTo(ParkingSpot::class, 'parking_spot_id');
    }
}
