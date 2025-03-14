<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function takeReservations(Request $request, $id)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);
        
        $idHouse = $id;
        $startDate = $request->start_date;
        $endDate = $request->end_date;
    
        $reservations = Reservation::where('parcking_id', $idHouse)->get();

    
        foreach ($reservations as $reservation) {
            if (($startDate <= $reservation->end_date) && ($endDate >= $reservation->start_date)) {
                if($i>$parking->capacity){
                    return "parcking is full";
                }
                $i=$i+1;
                return redirect()->back();
            }
        }
    
        $reservation = Reservation::create([
            'parking_id' => $idHouse,
            'user_id' => $userId,
            'start_date' => $startDate,
            'end_date' => $endDate,
        ]);
    
        return redirect()->route;
    }
}
