<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create(['role' => 'admin']);
    }

    public function test_users_index_requires_auth()
    {
        $response = $this->get('/users');
        $response->assertRedirect('/login');
    }

    public function test_users_index_requires_admin()
    {
        $petugas = User::factory()->create(['role' => 'petugas']);
        $response = $this->actingAs($petugas)->get('/users');
        $response->assertStatus(403);
    }

    public function test_users_index_shows_list()
    {
        User::factory()->count(3)->create(['role' => 'petugas']);
        
        $response = $this->actingAs($this->admin)->get('/users');
        $response->assertStatus(200);
        $response->assertViewHas('users');
    }

    public function test_create_user_page_loads()
    {
        $response = $this->actingAs($this->admin)->get('/users/create');
        $response->assertStatus(200);
    }

    public function test_store_user()
    {
        $response = $this->actingAs($this->admin)->post('/users', [
            'name' => 'New User',
            'email' => 'newuser@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'petugas',
        ]);

        $response->assertRedirect('/users');
        $this->assertDatabaseHas('users', [
            'email' => 'newuser@example.com',
            'role' => 'petugas',
        ]);
    }

    public function test_edit_user_page_loads()
    {
        $user = User::factory()->create(['role' => 'petugas']);
        
        $response = $this->actingAs($this->admin)->get("/users/{$user->id}/edit");
        $response->assertStatus(200);
        $response->assertViewHas('user', $user);
    }

    public function test_update_user()
    {
        $user = User::factory()->create(['role' => 'petugas', 'name' => 'Old Name']);
        
        $response = $this->actingAs($this->admin)->put("/users/{$user->id}", [
            'name' => 'Updated Name',
            'email' => $user->email,
            'password' => '',
            'password_confirmation' => '',
            'role' => 'admin',
        ]);

        $response->assertRedirect('/users');
        $user->refresh();
        $this->assertEquals('Updated Name', $user->name);
        $this->assertEquals('admin', $user->role);
    }

    public function test_delete_user()
    {
        $user = User::factory()->create(['role' => 'petugas']);
        
        $response = $this->actingAs($this->admin)->delete("/users/{$user->id}");

        $response->assertRedirect('/users');
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    public function test_store_user_validation()
    {
        $response = $this->actingAs($this->admin)->post('/users', [
            'name' => '',
            'email' => 'invalid-email',
            'password' => 'short',
            'role' => 'invalid',
        ]);

        $response->assertSessionHasErrors(['name', 'email', 'password', 'role']);
    }
}
