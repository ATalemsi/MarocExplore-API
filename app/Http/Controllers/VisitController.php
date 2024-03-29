<?php

/**
 * @OA\Info(
 *     title="User API",
 *     version="1.0.0",
 *     description="API for managing users",
 *     @OA\Contact(
 *         email="mohamadtalemsi@gmail.com"
 *     ),
 *     @OA\License(
 *         name="abdellah talemsi",
 *         url="https://opensource.org/licenses/MIT"
 *     )
 * )
 */

namespace App\Http\Controllers;

use App\Models\Visit;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    //

    /**
     * Store an itinerary in user visits.
     *
     * @OA\Post(
     *     path="/api/visits",
     *     summary="Store an itinerary in user visits",
     *     tags={"Visits"},
     *     security={{"sanctum": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Itinerary details",
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 required={"itinerary_id"},
     *                 @OA\Property(
     *                     property="itinerary_id",
     *                     type="integer",
     *                     description="ID of the itinerary to be added to visits"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Itinerary added to visits successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="errors", type="object")
     *         )
     *     )
     * )
     */
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
