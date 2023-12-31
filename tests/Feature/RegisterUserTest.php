<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class RegisterUserTest extends TestCase
{
    public $email;

    public $password;

    /**
     * A basic feature test example.
     */
    public function test_create_user(): void
    {

        $this->email = fake()->email();
        $response = $this->post('/register', [
            'name' => 'mohmaed',
            'email' => $this->email,
            'password' => 'Pa$$w0rd!.fr123',
            'password_confirmation' => 'Pa$$w0rd!.fr123',
        ]);
        $response->assertRedirect('/dashboard');
    }

    public function test_user__can_login(): void
    {

        $user = user::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $response->assertRedirect('/dashboard');
    }
}
