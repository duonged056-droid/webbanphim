<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\SanPham;

class ComprehensiveRoutesTest extends TestCase
{
    public function test_guest_routes()
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $sp = SanPham::first();
        if ($sp) {
            $response = $this->get('/san-pham/' . $sp->MaSP);
            $response->assertStatus(200);
        }

        $response = $this->get('/lien-he');
        $response->assertStatus(200);

        $response = $this->get('/login');
        $response->assertStatus(200);

        $response = $this->get('/register');
        $response->assertStatus(200);

        // Guest redirect to login
        $this->get('/gio-hang')->assertRedirect('/login');
        $this->get('/build')->assertRedirect('/login');
        $this->get('/thanh-toan')->assertRedirect('/login');
        $this->get('/don-hang')->assertRedirect('/login');
        $this->get('/admin')->assertRedirect('/login');
    }

    public function test_authenticated_user_routes()
    {
        $user = User::where('role', 'customer')->first() ?? User::factory()->make(['role' => 'customer']);

        $response = $this->actingAs($user)->get('/gio-hang');
        $response->assertStatus(200);

        $response = $this->actingAs($user)->get('/build');
        $response->assertStatus(200);

        $response = $this->actingAs($user)->withSession([
            'cart' => [
                1 => ['name' => 'Test', 'quantity' => 1, 'price' => 100000, 'image' => null]
            ]
        ])->get('/thanh-toan');
        $response->assertStatus(200);

        $response = $this->actingAs($user)->get('/don-hang');
        $response->assertStatus(200);

        // User cannot access admin
        $response = $this->actingAs($user)->get('/admin');
        $this->assertTrue(in_array($response->getStatusCode(), [302, 403]));
    }

    public function test_admin_routes()
    {
        $admin = User::where('role', 'admin')->first();
        if (!$admin) {
            $this->markTestSkipped('No admin found');
        }

        $response = $this->actingAs($admin)->get('/admin');
        $response->assertStatus(200);

        $response = $this->actingAs($admin)->get('/admin/sanpham');
        $response->assertStatus(200);

        $response = $this->actingAs($admin)->get('/admin/sanpham/create');
        $response->assertStatus(200);

        $sp = SanPham::first();
        if ($sp) {
            $response = $this->actingAs($admin)->get('/admin/sanpham/' . $sp->MaSP . '/edit');
            $response->assertStatus(200);
        }

        $response = $this->actingAs($admin)->get('/admin/don-hang');
        $response->assertStatus(200);
    }
}
