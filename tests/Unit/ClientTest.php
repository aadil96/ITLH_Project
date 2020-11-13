<?php

namespace Tests\Unit;

use App\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientTest extends TestCase
{
    use RefreshDatabase;
    public function test_can_create_client()
    {
        Client::create([
            'company_name' => 'Acetrot',
            'email' => 'acetrot.com',
            'password' => 'password',
        ]);

        $this->assertEquals(1, Client::all()->count());
    }
}
