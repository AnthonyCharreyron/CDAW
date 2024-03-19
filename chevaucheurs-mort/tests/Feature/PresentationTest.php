<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\PresentationController;
use Illuminate\Http\Request;

class PresentationTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_route()
    {
        $response = $this->get('/presentation');
        $response->assertStatus(200);
    }


}
