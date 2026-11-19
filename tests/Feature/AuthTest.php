<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_page_loads()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function test_login_with_valid_credentials()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($user);
        $response->assertRedirect('/dashboard');
    }

    public function test_login_with_invalid_credentials()
    {
        $response = $this->post('/login', [
            'email' => 'invalid@example.com',
            'password' => 'wrong',
        ]);

        $this->assertGuest();
        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
    }

    public function test_logout()
    {
        $user = User::factory()->create(['role' => 'admin']);
        
        $response = $this->actingAs($user)->post('/logout');

        $this->assertGuest();
        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_redirected_from_login()
    {
        $user = User::factory()->create(['role' => 'admin']);
        
        $response = $this->actingAs($user)->get('/login');
        
        $response->assertRedirect('/dashboard');
    }
}
