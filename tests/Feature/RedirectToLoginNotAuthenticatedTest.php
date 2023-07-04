<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RedirectToLoginNotAuthenticatedTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_redirect_to_login_not_authenticated()
    {
        $response = $this->get('/');

        $response->assertRedirectToRoute('login');
    }
}
