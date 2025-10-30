<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }

    public function test_new_users_can_register()
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password', // Pastikan ini cocok
        ]);
        
        $response->dumpSession();

        $user = User::where('email', 'test@example.com')->first();

        // Pastikan user tersimpan
        $this->assertNotNull($user);

        // Pastikan login berhasil
        $this->assertAuthenticatedAs($user);

        // Pastikan redirect ke dashboard
        $response->assertRedirect(route('dashboard'));
    }
}
