<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDestinationRequest;
use App\Http\Requests\UpdateDestinationRequest;
use App\Models\Destination;
use App\Models\Itinerary;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request , $itiniraireId)
    {
        if (!auth()->check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $itiniraire = Itinerary::findOrFail($itiniraireId);

        try {

        $userId = auth()->id();
        // Validate the incoming data
        $request->validate([
            'destinations' => 'required|array',
            'destinations.*.name' => 'required|string',
            'destinations.*.accommodation' => 'required|string',
            'destinations.*.places_to_visit' => 'required|array',
        ]);

        // Retrieve the destinations to add
        $destinationsData = $request->input('destinations');

        // Create and attach the destinations to the itinerary
        $destinations = [];
        foreach ($destinationsData as $destinationData) {
            $destinations[] = [
                'user_id' => $userId,
                'name' => $destinationData['name'],
                'accommodation' => $destinationData['accommodation'],
                'places_to_visit' => implode(',', $destinationData['places_to_visit'])
            ];
        }

        // Associate destinations with the itinerary
        $itiniraire->destinations()->createMany($destinations);

        return response()->json(['message' => 'Destinations added successfully'], 200);
        } catch (ValidationException $e) {
            // Return validation errors
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Destination $destination)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Destination $destination)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDestinationRequest $request, Destination $destination)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Destination $destination)
    {
        //
    }
}
