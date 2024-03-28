<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItineraryRequest;
use App\Http\Requests\UpdateItineraryRequest;
use App\Models\Itinerary;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ItineraryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $itineraries = Itinerary::with('destinations')->get();
        return response()->json(['itineraries' => $itineraries], 200);
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
    public function store(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        try {
        $request->validate([
            'title' => 'required|string',
            'category' => 'required|string',
            'duration' => 'required|integer',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $itinerary = new Itinerary();
        $itinerary->title = $request->title;
        $itinerary->category = $request->category;
        $itinerary->duration = $request->duration;

        if ($request->hasFile('image')) {
            $itinerary->storeImage($request->file('image'));
        }

        if (auth()->check()) {
            $itinerary->user_id = auth()->id();
        }

        $itinerary->save();

        return response()->json(['message' => 'Itinerary created successfully', 'data' => $itinerary], 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Itinerary $itinerary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Itinerary $itinerary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $itiniraireId)
    {

        if (!auth()->check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        /*if($itiniraire = Itinerary::findOrFail($itiniraireId)){
            return response()->json(['message' => 'Itinerary Data', 'request' => $request->all()], 200);
        }
        */



        $itiniraire = Itinerary::findOrFail($itiniraireId);


        if ($itiniraire->user_id !== auth()->user()->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        try {

        $request->validate([
            'title' => 'required|string',
            'category' => 'required|in:plage,montagne,rivière,monument',
            'duration' => 'required|integer',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

            $itiniraire->title = $request->title;
            $itiniraire->category = $request->category;
            $itiniraire->duration = $request->duration;


            if ($request->hasFile('image')) {

                $itiniraire->storeImage($request->file('image'));
            }

            $itiniraire->save();

        return response()->json(['message' => 'Itinerary updated successfully', 'data' => $itiniraire], 200);
        } catch (ValidationException $e) {

            return response()->json(['errors' => $e->errors()], 422);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function searchByCategory(Request $request)
    {
        $query = $request->input('query');


        $itineraries = Itinerary::with('destinations')->where('category', 'like', '%' . $query . '%')->get();

        return response()->json(['itineraries' => $itineraries], 200);
    }



    public function searchByDuration(Request $request)
    {
        $query = $request->input('query');

        $itineraries = Itinerary::with('destinations')->where('duration', 'like', '%' . $query . '%')->get();

        return response()->json(['itineraries' => $itineraries], 200);
    }
}
