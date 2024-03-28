<?php

use App\Http\Controllers\DestinationController;
use App\Http\Controllers\ItineraryController;
use App\Http\Controllers\VisitController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::controller(RegisterController::class)->group(function()
{
    Route::post('register', 'register');
    Route::post('login', 'login');

});

/** -----------Users --------------------- */
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users', [RegisterController::class, 'index'])->name('index');
});
Route::middleware('auth:sanctum')->post('/itineraries', [ItineraryController::class ,'store']);
Route::middleware('auth:sanctum')->post('itineraries/{itineraries}/destinations', [DestinationController::class ,'store']);
Route::middleware('auth:sanctum')->put('/update/{itineraries}', [ItineraryController::class,'update']);
Route::middleware('auth:sanctum')->post('/visits', [VisitController::class, 'store']);
Route::middleware('auth:sanctum')->get('/itineraries/all', [ItineraryController::class, 'index']);
Route::middleware('auth:sanctum')->get('/itineraries/searchcategory', [ItineraryController::class, 'searchByCategory']);
Route::middleware('auth:sanctum')->get('/itineraries/searchduration', [ItineraryController::class, 'searchByDuration']);







