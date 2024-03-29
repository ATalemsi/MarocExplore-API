<?php

namespace Tests\Unit;
use App\Models\Itinerary;
use Illuminate\Support\Facades;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ItineraryControllerTest extends TestCase
{

    public function test_it_can_get_all_itineraries()
    {

        $expectedItineraries = Itinerary::all()->toArray();


        $response = $this->get('/api/itineraries/all');


        $response->assertStatus(200);


        $response->assertJson(['itineraries' => $expectedItineraries]);
    }
    public function test_example(): void
    {
        $this->assertTrue(true);
    }
}
