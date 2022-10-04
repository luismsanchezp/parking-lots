<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingSpot extends Model
{
    use HasFactory;

    protected $fillable = [
        'row',
        'column',
        'parking_lot_id'
    ];

    protected $casts = [
        'row' => 'integer',
        'column' => 'integer',
        'parking_lot_id' => 'integer'
    ];

    public function parking_lot()
    {
        return $this->belongsTo(ParkingLot::class, 'parking_lot_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'parking_spot_id');
    }
}
