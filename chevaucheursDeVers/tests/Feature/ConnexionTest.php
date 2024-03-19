<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConnexionTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_route()
    {
        $response = $this->get('/connexion');

        $response->assertStatus(200);
    }
}
