<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Modules\Venue\Models\VenueDetails;
use Livewire\Livewire;
use Tests\TestCase;

class VenueSearchTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

     public function it_can_search_venue()
    {
        // If using RefreshDatabase trait, make sure to seed the database
        Livewire::test(VenueDetails::class)
            ->set('locationid', '26468');
           
    }
}
