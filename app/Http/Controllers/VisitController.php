<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    //
    public function store(Request $request)
    {

        $user = auth()->user();


        $request->validate([
            'itinerary_id' => 'required|exists:itineraries,id',
        ]);


        $visit = new Visit();
        $visit->user_id = $user->id;
        $visit->itinerary_id = $request->input('itinerary_id');
        $visit->save();

        return response()->json(['message' => 'Itinerary added to visits successfully'], 201);
    }
}
