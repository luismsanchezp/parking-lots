<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ParkingLotResource;
use App\Models\ParkingLot;
use App\Models\ParkingSpot;
use Illuminate\Http\Request;

use App\Http\Requests\api\v1\ParkingLotStoreRequest;
use Illuminate\Support\Facades\Auth;

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
        return response()->json(['data' => ParkingLotResource::collection($parkingLots)], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ParkingLotStoreRequest $request)
    {
        $id = Auth::user()->id;
        $parkingLot = new ParkingLot();
        $parkingLot->name = $request->input('name');
        $parkingLot->rows = $request->input('rows');
        $parkingLot->columns = $request->input('columns');
        $parkingLot->user_id = $id;
        $parkingLot->save();
        return (new ParkingLotResource($parkingLot))
            ->response()
            ->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ParkingLot  $parkingLot
     * @return \Illuminate\Http\Response
     */
    public function show(ParkingLot $parkingLot)
    {
        return (new ParkingLotResource($parkingLot))
            ->response()
            ->setStatusCode(200);
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
        return (new ParkingLotResource($parkingLot))
            ->response()
            ->setStatusCode(200);
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
    /*
    public function createAllSpots(ParkingLot $parkingLot)
    {
        return response()->json(['data' => $parkingLot->id], 200);
        for($r = 0; $r < $parkingLot->rows; $r++){
            for($c = 0; $c < $parkingLot->columns; $c++){
                $parkingSpot = new ParkingSpot();
                $parkingSpot->rows = $r;
                $parkingSpot->columns = $c;
                $parkingSpot->parking_lot_id = $parkingLot->id;
                $parkingSpot->save();
            }
        }
    }
    */
}
