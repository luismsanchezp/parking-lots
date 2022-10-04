<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\ParkingLot;
use Illuminate\Http\Request;

use App\Http\Requests\api\v1\ParkingLotStoreRequest;

class ParkingLotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parkingLots = ParkingLot::orderBy('name', 'asc')->get();
        return response()->json(['data' => $parkingLots], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ParkingLotStoreRequest $request)
    {
        $parkingLot = ParkingLot::create($request->all());
	    return $parkingLot;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ParkingLot  $parkingLot
     * @return \Illuminate\Http\Response
     */
    public function show(ParkingLot $parkingLot)
    {
        return response()->json(['data' => $parkingLot], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ParkingLot  $parkingLot
     * @return \Illuminate\Http\Response
     */
    public function update(ParkingLotStoreRequest $request, ParkingLot $parkingLot)
    {
        $parkingLot->update($request->all());
        return response()->json(['data' => $parkingLot], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ParkingLot  $parkingLot
     * @return \Illuminate\Http\Response
     */
    public function destroy(ParkingLot $parkingLot)
    {
        //
    }
}
