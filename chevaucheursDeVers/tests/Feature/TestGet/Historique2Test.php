<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class Historique2Test extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_route()
    {
        $response = $this->get('/historique/2');

        $response->assertStatus(200);
    }
}
