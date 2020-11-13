<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    public function test_can_create_user()
    {
        \App\User::create([
            'name' => "Aadil Agwan",
            'email' => 'agwan96@gmail.com',
            'password' => 'password',
        ]);

        $this->assertEquals(1, \App\User::all()->count());
    }
}
