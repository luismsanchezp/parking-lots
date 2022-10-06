<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class VehicleType extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_type',
        'tariff',
        'creation_date',
        'parking_lot_id',
    ];

    protected $casts = [
        'tariff' => 'double',
        'parking_lot_id' => 'integer'
    ];

    public function parking_lot()
    {
        return $this->belongsTo(ParkingLot::class, 'parking_lot_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'vehicle_type_id');
    }
}
