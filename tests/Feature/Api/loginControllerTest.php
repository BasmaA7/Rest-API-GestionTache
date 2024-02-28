<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Http\Response;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_authenticate_user_and_generate_token()
    {
        $user = User::factory()->create();

        $loginData = [
            'email' => $user->email,
            'password' => 'password', // Assuming 'password' is the default password
        ];

        $response = $this->post('/api/login', $loginData);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(['token', 'message']);

        $this->assertNotNull($response['token']);
    }

    /** @test */
    public function it_returns_unauthorized_for_invalid_credentials()
    {
        $invalidLoginData = [
            'email' => 'nonexistent@example.com',
            'password' => 'wrongpassword',
        ];

        $response = $this->post('/api/login', $invalidLoginData);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED)
            ->assertJson(['message' => 'Identifiants invalides']);
    }
}
