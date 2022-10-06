<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\ParkingSpot;
use Illuminate\Http\Request;

use App\Http\Requests\api\v1\ParkingSpotStoreRequest;
use App\Http\Resources\ParkingSpotResource;

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
        return response()->json(['data' => ParkingSpotResource::collection($parkingSpots)], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ParkingSpotStoreRequest $request)
    {
        $parkingSpot = new ParkingSpot();
        $parkingSpot->row = $request->row;
        $parkingSpot->column = $request->column;
        $parkingSpot->parking_lot_id = $request->parking_lot_id;
        $parkingSpot->save();
        return (new ParkingSpotResource($parkingSpot))
            ->response()
            ->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ParkingSpot  $parkingSpot
     * @return \Illuminate\Http\Response
     */
    public function show(ParkingSpot $parkingSpot)
    {
        return (new ParkingSpotResource($parkingSpot))
            ->response()
            ->setStatusCode(200);
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
