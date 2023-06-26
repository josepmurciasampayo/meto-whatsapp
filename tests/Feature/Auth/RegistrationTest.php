<?php

namespace Tests\Feature\Auth;

use App\Enums\General\YesNo;
use App\Enums\User\Consent;
use App\Enums\User\Role;
use App\Enums\User\Status;
use App\Mail\UniSignup;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

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

    public function test_new_student_users_can_register()
    {
        $email = $this->faker->email();
        
        $response = $this->post('/register', [
            'first' => $this->faker->firstName(),
            'middle' => $this->faker->lastName(),
            'last' => $this->faker->lastName(),
            'email' => $email,
            'email_confirmation' => $email,
            'phone' => [
                'code' => '+61',
                'number' => $this->faker->phoneNumber()
            ],
            'phone_owner' => 1,
            'whatsapp_used' => ($this->faker->boolean()) ? YesNo::YES() : YesNo::NO(),
            'whatsapp_consent' => ($this->faker->boolean()) ? Consent::CONSENT() : Consent::NOCONSENT(),
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => Role::STUDENT(),
            'status' => Status::ACTIVE(),
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_signup_uni_screen_can_be_rendered()
    {
        $response = $this->get('/signup-uni');

        $response->assertStatus(200);
    }

    public function test_new_uni_users_can_be_invited()
    {
        Mail::fake();

        $response = $this->post('/signup-uni', [
            'name' => $this->faker->name(),
            'institution' => $this->faker->company(),
            'email' => $this->faker->email(),
            'title' => $this->faker->jobTitle(),
            'how' => $this->faker->text(200)
        ]);

        Mail::assertSent(UniSignup::class);
    }   
}
