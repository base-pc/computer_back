<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_auth_test()

    {
        User::factory()->create();

        $body = [
            'email' => 'example@wp.pl',
            'password' => 'mojesuperhaslo'
        ];


        $this->post('api/auth/register');

        $this->assertCount(1, User::all());

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'multipart/form-data'
        ])->post('api/auth/login', $body );

        $response
            ->assertStatus(200);
    }
}
