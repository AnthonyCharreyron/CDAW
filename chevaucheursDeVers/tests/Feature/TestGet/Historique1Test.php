<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class Historique1Test extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_route()
    {
        $response = $this->get('/historique/1');

        $response->assertStatus(200);
    }
}
