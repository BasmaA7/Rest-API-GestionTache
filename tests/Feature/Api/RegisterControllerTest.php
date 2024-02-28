<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_can_register_a_new_user()
    {
       
        $userData = [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => 'password123',
        ];
    
        // Assuming a user is not already authenticated
        $this->withoutMiddleware();
    
        $response = $this->post('/api/register', $userData);
    
        // Assert the status and structure of the response
        $response->assertStatus(201)
            ->assertJsonStructure([
                'user' => [
                    'id',
                    'name',
                    'email',
                    'created_at',
                    'updated_at',
                ],
                'token',
            ]);
    
        // Ensure the user's token has been created
        $this->assertNotNull($response['token']);
    }


}
