<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DateTime;

use App\Models\VehicleType;
use App\Models\ParkingSpot;
use App\Models\ParkingLot;

use App\Http\Requests\api\v1\TicketStoreRequest;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Ticket::orderBy('entry_date', 'desc')->get();
        return response()->json(['data' => $tickets], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TicketStoreRequest $request)
    {
        $id = Auth::id();

        $parking_spot_id = $request->input('parking_spot_id');
        $vehicle_type_id = $request->input('vehicle_type_id');

        $parking_spot = ParkingSpot::findOrFail($parking_spot_id);
        $vehicle_type = VehicleType::findOrFail($vehicle_type_id);

        if ($parking_spot->parking_lot_id == $vehicle_type->parking_lot_id)
        {
            $parking_lot = ParkingLot::findOrFail($parking_spot->parking_lot_id);
            if ($parking_lot->user_id == $id)
            {
                $most_recent_t_remove_date = NULL;
                try{
                    $most_recent_ticket = Ticket::whereColumn('parking_spot_id', $parking_spot_id)->orderBy('entry_date', 'desc')->limit(1)->get();
                    $most_recent_t_remove_date = $most_recent_ticket->remove_date;
                } catch (Exception $e) {
                    $most_recent_t_remove_date = Carbon::now()->toDateTimeString();
                }

                if ($most_recent_t_remove_date != NULL){
                    $r_entry_date = Carbon::now()->toDateTimeString();
                    $ticket = Ticket::create([
                        'entry_date' => $r_entry_date,
                        'remove_date' => NULL,
                        'parking_spot_id' => $request->input('parking_spot_id'),
                        'vehicle_id' => $request->input('vehicle_id'),
                        'vehicle_type_id' => $request->input('vehicle_type_id')
                    ]);
                    return (new TicketResource($ticket))
                        ->response()
                        ->setStatusCode(200);
                } else {
                    return response()->json(['data' =>
                    'Selected Parking Spot is not available.'], 406);
                }
            } else {
                return response()->json(['data' =>
                'Selected Parking Lot does not belong to logged user.'], 403);
            }
        } else {
            return response()->json(['data' =>
            'Selected Vehicle Type does not belong to Parking Lot'], 403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        return response()->json(['data' => $ticket], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }

    public function pay_ticket(Ticket $ticket){
        if ($ticket->remove_date == NULL){
            $ticket->remove_date = Carbon::now()->toDateTimeString();
            $ticket->save();

            $t_entry_date= new DateTime($ticket->entry_date);
            $t_remove_date= new DateTime($ticket->remove_date);
            $hours = $t_remove_date->diff($t_remove_date);

            $tariff = App\Models\VehicleType::findOrFail($ticket->vehicle_type_id)->tariff;

            $total = ceil($hours)*$tariff;

            return response()->json(['data' => $ticket,
                    'time_parked' => $hours,
                    'total' => $total
                ]
                , 200);

            /*
            $vehicle = App\Models\Vehicle::findOrFail($ticket->vehicle_id);
            $vehicle_type_f = App\Models\VehicleType::findOrFail($ticket->vehicle_type_id);
            $t_entry_date= new DateTime($ticket->entry_date);
            $t_remove_date= new DateTime($ticket->remove_date);
            $hours = $t_remove_date->diff($t_remove_date);

            $total = ceil($hours)*$vehicle_type_f->tariff;



            */
        } else {
            return response()->json(['data' =>
            'Selected Ticket is already paid.'], 406);
        }
    }
}
