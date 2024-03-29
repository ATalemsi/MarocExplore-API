<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;

class RegisterControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_register_new_user()
    {
        $userData = [
            'name' => 'John Doe',
            'email' => 'john9@example.com',
            'password' => 'password',
            'c_password' => 'password',
        ];

        $response = $this->postJson('/api/register', $userData);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'token',
                    'name',
                ],
                'message',
            ]);

        $this->assertDatabaseHas('users', ['email' => 'john9@example.com']);
    }

    public function test_login_existing_user()
    {


        $loginData = [
            'email' => 'test40@example.com',
            'password' => 'password',
        ];

        $response = $this->postJson('/api/login', $loginData);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'token',
                    'name',
                ],
                'message',
            ]);
    }

    public function test_example(): void
    {
        $this->assertTrue(true);
    }
}
