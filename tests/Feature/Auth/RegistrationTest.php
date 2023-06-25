<?php

namespace Tests\Feature\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_signup_screen_can_be_rendered()
    {
        $response = $this->get('/signup');

        $response->assertStatus(200);
    }

    public function test_signup_student_screen_can_be_rendered()
    {
        $response = $this->get('/signup-student');

        $response->assertStatus(200);
    }

    public function test_signup_uni_screen_can_be_rendered()
    {
        $response = $this->get('/signup-uni');

        $response->assertStatus(200);
    }

    public function test_new_student_users_can_register()
    {
        /*$response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);*/
    }

    public function test_new_uni_users_can_be_invited()
    {
        //
    }   
}
