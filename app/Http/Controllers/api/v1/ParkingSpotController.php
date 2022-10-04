<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\ParkingSpot;
use Illuminate\Http\Request;

use App\Http\Requests\api\v1\ParkingSpotStoreRequest;

class ParkingSpotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parkingSpots = ParkingSpot::orderBy('parking_lot_id', 'asc')->get();
        return response()->json(['data' => $parkingSpots], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ParkingSpotStoreRequest $request)
    {
        $parkingSpot = ParkingSpot::create($request->all());
	    return $parkingSpot;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ParkingSpot  $parkingSpot
     * @return \Illuminate\Http\Response
     */
    public function show(ParkingSpot $parkingSpot)
    {
        return response()->json(['data' => $parkingSpot], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ParkingSpot  $parkingSpot
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ParkingSpot $parkingSpot)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ParkingSpot  $parkingSpot
     * @return \Illuminate\Http\Response
     */
    public function destroy(ParkingSpot $parkingSpot)
    {
        //
    }
}
