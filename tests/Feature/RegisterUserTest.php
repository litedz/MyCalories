<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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

        $response = $this->post('/register', [
            'name' => 'mohmaed',
            'email' => fake()->email(),
            'password' => 'Pa$$w0rd!.fr123',
            'password_confirmation' => 'Pa$$w0rd!.fr123',
        ]);
        $response->assertRedirect('/dashboard');
    }
    public function test_user__can_login(): void
    {

        $user=user::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $response->assertRedirect('/dashboard');
    }

}
