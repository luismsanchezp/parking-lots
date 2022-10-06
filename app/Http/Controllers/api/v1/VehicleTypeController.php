<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\VehicleType;
use Illuminate\Http\Request;

use App\Http\Requests\api\v1\VehicleTypeStoreRequest;
use Carbon\Carbon;

class VehicleTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicleTypes = VehicleType::orderBy('parking_lot_id', 'asc')->get();
        return response()->json(['data' => $vehicleTypes], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VehicleTypeStoreRequest $request)
    {
        $vehicleType = VehicleType::create([
            'vehicle_type' => $request->input('vehicle_type'),
            'tariff' => $request->input('tariff'),
            'creation_date' => Carbon::now()->toDateTimeString(),
            'parking_lot_id' => $request->input('parking_lot_id'),
        ]);
	    return $vehicleType;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VehicleType  $vehicleType
     * @return \Illuminate\Http\Response
     */
    public function show(VehicleType $vehicleType)
    {
        return response()->json(['data' => $vehicleType], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VehicleType  $vehicleType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VehicleType $vehicleType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VehicleType  $vehicleType
     * @return \Illuminate\Http\Response
     */
    public function destroy(VehicleType $vehicleType)
    {
        //
    }
}
