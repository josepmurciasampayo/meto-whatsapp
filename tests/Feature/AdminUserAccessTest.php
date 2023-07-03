<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminUserAccessTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_users_can_not_access_admin_without_admin_role()
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();

        $response = $this->get('/admin/students');

        $response->assertForbidden();
    }

    public function test_users_can_access_admin_with_admin_role()
    {
        $user = User::factory()->withAdminRole()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();

        $response = $this->get('/admin/students');

        $response->assertStatus(200);
    }
}
