<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_registers_a_user_correctly()
    {
        $response = $this->post(route('register'), [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => '1234567',
            'password_confirmation' => '1234567',
        ]);

        $this->assertDatabaseHas('users', ['email' => 'john@example.com']);
        $response->assertStatus(302); // Redirects after successful registration
    }

    /** @test */
    public function it_does_not_allow_duplicate_emails()
    {
        User::factory()->create(['email' => 'john@example.com']);

        $response = $this->post(route('register'), [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => '123457',
            'password_confirmation' => '1234567',
        ]);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function it_redirects_to_dashboard_after_login()
    {
        $user = User::factory()->create(['password' => bcrypt('password')]);

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function it_prevents_access_without_authentication()
    {
        $response = $this->get(route('dashboard'));
        $response->assertRedirect('/login');
    }
}
