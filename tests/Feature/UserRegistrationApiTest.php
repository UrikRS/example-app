<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserRegistrationApiTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function testUserRegistration(){
        $userData = [
            'name' => $this->faker->name,
            'phone' => $this->faker->e164PhoneNumber,
            'email' => $this->faker->safeEmail,
        ];

        $response = $this->json('POST', '/api/users', $userData);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'phone',
                'email',
            ],
        ]);

        // You can also assert more specific details about the user created, e.g., in the database
        $this->assertDatabaseHas('users', [
            'email' => $userData['email'],
        ]);
    }

}

