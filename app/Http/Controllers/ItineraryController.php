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

use App\Models\Itinerary;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ItineraryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /**

    /**
     * Retrieves a list of itineraries.
     *
     * @OA\Get(
     *     path="/api/itineraries/all",
     *     summary="Retrieve a list of itineraries",
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="List of itineraries retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="itineraries", type="array", @OA\Items(type="object"))
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthorized")
     *         )
     *     )
     * )
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
    /**
     * Store a newly created resource in storage.
     *
     * @OA\Post(
     *     path="/api/itineraries",
     *     summary="Create a new itinerary",
     *     tags={"Itineraries"},
     *     security={{"sanctum": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 required={"title", "category", "duration"},
     *                 @OA\Property(
     *                     property="title",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="category",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="duration",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="image",
     *                     type="string",
     *                     format="binary"
     *                 ),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Itinerary created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Itinerary created successfully"
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(
     *                     property="id",
     *                     type="integer",
     *                     format="int64",
     *                     example="1"
     *                 ),
     *                 @OA\Property(
     *                     property="title",
     *                     type="string",
     *                     example="Itinerary Title"
     *                 ),
     *                 @OA\Property(
     *                     property="category",
     *                     type="string",
     *                     example="Category"
     *                 ),
     *                 @OA\Property(
     *                     property="duration",
     *                     type="integer",
     *                     example="5"
     *                 ),
     *                 @OA\Property(
     *                     property="image_url",
     *                     type="string",
     *                     example="http://example.com/image.jpg"
     *                 ),
     *                 @OA\Property(
     *                     property="created_at",
     *                     type="string",
     *                     format="date-time",
     *                     example="2024-03-25 12:00:00"
     *                 ),
     *                 @OA\Property(
     *                     property="updated_at",
     *                     type="string",
     *                     format="date-time",
     *                     example="2024-03-25 12:00:00"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Unauthorized"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 example={
     *                     "title": {"The title field is required."},
     *                     "category": {"The category field is required."},
     *                     "duration": {"The duration field is required."},
     *                     "image": {"The image must be an image.", "The image may not be greater than 2048 kilobytes."}
     *                 }
     *             )
     *         )
     *     )
     * )
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
     * Update the specified resource in storage.
     */
    /**
     * Update the specified resource in storage.
     *
     * @OA\Put(
     *     path="/api/update/{itineraryId}",
     *     summary="Update an itinerary",
     *     tags={"Itineraries"},
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="itineraryId",
     *         in="path",
     *         required=true,
     *         description="ID of the itinerary to update",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 required={"title", "category", "duration"},
     *                 @OA\Property(
     *                     property="title",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="category",
     *                     type="string",
     *                     enum={"plage", "montagne", "rivière", "monument"}
     *                 ),
     *                 @OA\Property(
     *                     property="duration",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="image",
     *                     type="string",
     *                     format="binary"
     *                 ),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Itinerary updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Itinerary updated successfully"
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(
     *                     property="id",
     *                     type="integer",
     *                     format="int64",
     *                     example="1"
     *                 ),
     *                 @OA\Property(
     *                     property="title",
     *                     type="string",
     *                     example="Updated Itinerary Title"
     *                 ),
     *                 @OA\Property(
     *                     property="category",
     *                     type="string",
     *                     example="Updated Category"
     *                 ),
     *                 @OA\Property(
     *                     property="duration",
     *                     type="integer",
     *                     example="10"
     *                 ),
     *                 @OA\Property(
     *                     property="image_url",
     *                     type="string",
     *                     example="http://example.com/updated_image.jpg"
     *                 ),
     *                 @OA\Property(
     *                     property="created_at",
     *                     type="string",
     *                     format="date-time",
     *                     example="2024-03-25 12:00:00"
     *                 ),
     *                 @OA\Property(
     *                     property="updated_at",
     *                     type="string",
     *                     format="date-time",
     *                     example="2024-03-25 12:00:00"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Unauthorized"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Forbidden"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 example={
     *                     "title": {"The title field is required."},
     *                     "category": {"The category field is required.", "The selected category is invalid."},
     *                     "duration": {"The duration field is required."},
     *                     "image": {"The image must be an image.", "The image may not be greater than 2048 kilobytes."}
     *                 }
     *             )
     *         )
     *     )
     * )
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
    /**
     * Search itineraries by category.
     *
     * @OA\Get(
     *     path="/api/itineraries/searchcategory",
     *     summary="Search itineraries by category",
     *     tags={"Itineraries"},
     *     @OA\Parameter(
     *         name="query",
     *         in="query",
     *         required=true,
     *         description="Search query for category",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of itineraries matching the category search",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="itineraries",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="id",
     *                         type="integer",
     *                         format="int64",
     *                         example="1"
     *                     ),
     *                     @OA\Property(
     *                         property="title",
     *                         type="string",
     *                         example="Itinerary Title"
     *                     ),
     *                     @OA\Property(
     *                         property="category",
     *                         type="string",
     *                         example="Category"
     *                     ),
     *                     @OA\Property(
     *                         property="duration",
     *                         type="integer",
     *                         example="5"
     *                     ),
     *                     @OA\Property(
     *                         property="image_url",
     *                         type="string",
     *                         example="http://example.com/image.jpg"
     *                     ),
     *                     @OA\Property(
     *                         property="created_at",
     *                         type="string",
     *                         format="date-time",
     *                         example="2024-03-25 12:00:00"
     *                     ),
     *                     @OA\Property(
     *                         property="updated_at",
     *                         type="string",
     *                         format="date-time",
     *                         example="2024-03-25 12:00:00"
     *                     )
     *                 )
     *             )
     *         )
     *     )
     * )
     */

    public function searchByCategory(Request $request)
    {
        $query = $request->input('query');


        $itineraries = Itinerary::with('destinations')->where('category', 'like', '%' . $query . '%')->get();

        return response()->json(['itineraries' => $itineraries], 200);
    }
    /**
     * Search itineraries by duration.
     *
     * @OA\Get(
     *     path="/api/itineraries/searchduration",
     *     summary="Search itineraries by duration",
     *     tags={"Itineraries"},
     *     @OA\Parameter(
     *         name="query",
     *         in="query",
     *         required=true,
     *         description="Search query for duration",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of itineraries matching the duration search",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="itineraries",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="id",
     *                         type="integer",
     *                         format="int64",
     *                         example="1"
     *                     ),
     *                     @OA\Property(
     *                         property="title",
     *                         type="string",
     *                         example="Itinerary Title"
     *                     ),
     *                     @OA\Property(
     *                         property="category",
     *                         type="string",
     *                         example="Category"
     *                     ),
     *                     @OA\Property(
     *                         property="duration",
     *                         type="integer",
     *                         example="5"
     *                     ),
     *                     @OA\Property(
     *                         property="image_url",
     *                         type="string",
     *                         example="http://example.com/image.jpg"
     *                     ),
     *                     @OA\Property(
     *                         property="created_at",
     *                         type="string",
     *                         format="date-time",
     *                         example="2024-03-25 12:00:00"
     *                     ),
     *                     @OA\Property(
     *                         property="updated_at",
     *                         type="string",
     *                         format="date-time",
     *                         example="2024-03-25 12:00:00"
     *                     )
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function searchByDuration(Request $request)
    {
        $query = $request->input('query');

        $itineraries = Itinerary::with('destinations')->where('duration', 'like', '%' . $query . '%')->get();

        return response()->json(['itineraries' => $itineraries], 200);
    }
}
