<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /**
     * Test that all luxury service pages load successfully.
     */
    public function test_luxury_service_pages_render_successfully(): void
    {
        $this->get('/services')->assertStatus(200);
        $this->get('/about')->assertStatus(200);
        $this->get('/fleet')->assertStatus(200);
        $this->get('/contact')->assertStatus(200);
        $this->get('/trips')->assertStatus(200);
    }

    /**
     * Test vehicle search parameters and dynamic validation.
     */
    public function test_search_results_page_validates_input(): void
    {
        $response = $this->get('/search-results?service_type=airport&pickup=DEN+Airport&dropoff=The+Brown+Palace+Hotel&date=2026-10-24&time=14:30&passengers=2&luggage=2');
        $response->assertStatus(200);
        $response->assertSee('Mercedes-Benz S-Class');
        $response->assertSee('Cadillac Escalade ESV');
    }

}
