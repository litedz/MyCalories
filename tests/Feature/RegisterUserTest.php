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
        $email = fake()->email();
        $response = $this->post('/register', [
            'name' => 'mohmaed',
            'email' => $email,
            'password' => 'Pa$$w0rd!.fr123',
            'password_confirmation' => 'Pa$$w0rd!.fr123',
        ]);
        $response->assertRedirect('/dashboard');
    }
    public function test_login(): void
    {


        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $response->assertRedirect('/dashboard');
    }
    public function test_user_can_edit_food(): void
    {


        // $response = $this->post('/login', [
        //     'email' => 'ryann13@yahoo.com',
        //     'password' => 'Pa$$w0rd!.fr123',
        // ]);

        // $response->assertRedirect('/dashboard');
    }
}
