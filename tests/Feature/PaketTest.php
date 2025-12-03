<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Pakets;
use App\Models\User;
use App\Models\Orders;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PaketTest extends TestCase
{
      use RefreshDatabase;
      
    protected function setUp(): void
    {
        parent::setUp();
        
        // Create permissions
        Permission::create(['name' => 'view pakets']);
        Permission::create(['name' => 'create pakets']);
        Permission::create(['name' => 'edit pakets']);
        Permission::create(['name' => 'delete pakets']);
        Permission::create(['name' => 'user-access']);
        Permission::create(['name' => 'admin-access']);
        
        // Create roles
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo(['view pakets', 'create pakets', 'edit pakets', 'delete pakets', 'admin-access', 'user-access']);
        
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo(['user-access']);
    }

    public function test_guest_can_view_paket_list(): void
    {
        // Create test pakets
        Pakets::create([
            'nama_paket' => 'Paket Internet 50Mbps',
            'kategori' => 'Internet',
            'harga' => 150000,
            'kecepatan' => '50 Mbps'
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewIs('guests.dashboard');
        $response->assertViewHas('pakets');
    }

    public function test_admin_can_view_paket_list(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'phone' => '08123456789',
            'address' => 'Jl. Admin No. 1',
        ]);
        $admin->assignRole('admin');

        $this->actingAs($admin);

        $response = $this->get(route('pakets.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.pakets.list');
        $response->assertViewHas('pakets');
    }

    public function test_admin_can_create_paket(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'phone' => '08123456789',
            'address' => 'Jl. Admin No. 1',
        ]);
        $admin->assignRole('admin');

        $this->actingAs($admin);

        $response = $this->get(route('pakets.create'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.pakets.create');
    }

    public function test_store_paket_with_valid_data(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'phone' => '08123456789',
            'address' => 'Jl. Admin No. 1',
        ]);
        $admin->assignRole('admin');

        $this->actingAs($admin);

        $paketData = [
            'nama_paket' => 'Paket Internet 100Mbps',
            'kategori' => 'Internet',
            'harga' => 250000,
            'kecepatan' => '100 Mbps',
            'deskripsi' => 'Paket internet super cepat'
        ];

        $response = $this->post(route('pakets.store'), $paketData);

        $this->assertDatabaseHas('pakets', [
            'nama_paket' => 'Paket Internet 100Mbps',
            'kategori' => 'Internet',
            'harga' => 250000,
            'kecepatan' => '100 Mbps'
        ]);

        $response->assertRedirect(route('pakets.index'));
        $response->assertSessionHas('success', 'Paket berhasil ditambahkan!');
    }

    public function test_store_paket_requires_required_fields(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'phone' => '08123456789',
            'address' => 'Jl. Admin No. 1',
        ]);
        $admin->assignRole('admin');

        $this->actingAs($admin);

        $response = $this->post(route('pakets.store'), []);

        $response->assertSessionHasErrors(['nama_paket', 'kategori', 'harga', 'kecepatan']);
    }

    public function test_store_paket_validates_unique_nama_paket(): void
    {
        // Create existing paket
        Pakets::create([
            'nama_paket' => 'Paket Internet 50Mbps',
            'kategori' => 'Internet',
            'harga' => 150000,
            'kecepatan' => '50 Mbps'
        ]);

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'phone' => '08123456789',
            'address' => 'Jl. Admin No. 1',
        ]);
        $admin->assignRole('admin');

        $this->actingAs($admin);

        $paketData = [
            'nama_paket' => 'Paket Internet 50Mbps', // Same name
            'kategori' => 'Internet',
            'harga' => 200000,
            'kecepatan' => '100 Mbps'
        ];

        $response = $this->post(route('pakets.store'), $paketData);

        $response->assertSessionHasErrors(['nama_paket']);
    }

    public function test_store_paket_validates_harga_must_be_positive(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'phone' => '08123456789',
            'address' => 'Jl. Admin No. 1',
        ]);
        $admin->assignRole('admin');

        $this->actingAs($admin);

        $paketData = [
            'nama_paket' => 'Paket Internet 50Mbps',
            'kategori' => 'Internet',
            'harga' => -1000, // Negative price
            'kecepatan' => '50 Mbps'
        ];

        $response = $this->post(route('pakets.store'), $paketData);

        $response->assertSessionHasErrors(['harga']);
    }

    public function test_show_paket_detail(): void
    {
        $paket = Pakets::create([
            'nama_paket' => 'Paket Internet 50Mbps',
            'kategori' => 'Internet',
            'harga' => 150000,
            'kecepatan' => '50 Mbps'
        ]);

        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@test.com',
            'password' => bcrypt('password'),
            'phone' => '08123456789',
            'address' => 'Jl. Test No. 1',
        ]);
        $user->assignRole('user');

        $this->actingAs($user);

        $response = $this->get(route('pakets.show', $paket));

        $response->assertStatus(200);
        $response->assertViewIs('admin.pakets.pembayaran');
        $response->assertViewHas('paket', $paket);
    }

    public function test_edit_paket_form(): void
    {
        $paket = Pakets::create([
            'nama_paket' => 'Paket Internet 50Mbps',
            'kategori' => 'Internet',
            'harga' => 150000,
            'kecepatan' => '50 Mbps'
        ]);

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'phone' => '08123456789',
            'address' => 'Jl. Admin No. 1',
        ]);
        $admin->assignRole('admin');

        $this->actingAs($admin);

        $response = $this->get(route('pakets.edit', $paket));

        $response->assertStatus(200);
        $response->assertViewIs('admin.pakets.edit');
        $response->assertViewHas('paket', $paket);
    }

    public function test_update_paket_with_valid_data(): void
    {
        $paket = Pakets::create([
            'nama_paket' => 'Paket Internet 50Mbps',
            'kategori' => 'Internet',
            'harga' => 150000,
            'kecepatan' => '50 Mbps'
        ]);

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'phone' => '08123456789',
            'address' => 'Jl. Admin No. 1',
        ]);
        $admin->assignRole('admin');

        $this->actingAs($admin);

        $updateData = [
            'nama_paket' => 'Paket Internet 100Mbps',
            'kategori' => 'Internet',
            'harga' => 250000,
            'kecepatan' => '100 Mbps',
            'deskripsi' => 'Paket internet super cepat'
        ];

        $response = $this->put(route('pakets.update', $paket), $updateData);

        $this->assertDatabaseHas('pakets', [
            'id' => $paket->id,
            'nama_paket' => 'Paket Internet 100Mbps',
            'harga' => 250000,
            'kecepatan' => '100 Mbps'
        ]);

        $response->assertRedirect(route('pakets.index'));
        $response->assertSessionHas('success', 'Paket berhasil diperbarui!');
    }

    public function test_delete_paket(): void
    {
        $paket = Pakets::create([
            'nama_paket' => 'Paket Internet 50Mbps',
            'kategori' => 'Internet',
            'harga' => 150000,
            'kecepatan' => '50 Mbps'
        ]);

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'phone' => '08123456789',
            'address' => 'Jl. Admin No. 1',
        ]);
        $admin->assignRole('admin');

        $this->actingAs($admin);

        $response = $this->delete(route('pakets.destroy', $paket));

        $this->assertDatabaseMissing('pakets', ['id' => $paket->id]);
        $response->assertRedirect(route('pakets.index'));
        $response->assertSessionHas('success', 'Paket berhasil dihapus!');
    }

    public function test_paket_search_functionality(): void
    {
        // Create test pakets
        Pakets::create([
            'nama_paket' => 'Paket Internet 50Mbps',
            'kategori' => 'Internet',
            'harga' => 150000,
            'kecepatan' => '50 Mbps'
        ]);

        Pakets::create([
            'nama_paket' => 'Paket TV Kabel',
            'kategori' => 'TV',
            'harga' => 100000,
            'kecepatan' => 'HD'
        ]);

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'phone' => '08123456789',
            'address' => 'Jl. Admin No. 1',
        ]);
        $admin->assignRole('admin');

        $this->actingAs($admin);

        $response = $this->get(route('pakets.index', ['search' => 'Internet']));

        $response->assertStatus(200);
        $response->assertViewHas('pakets');
    }

    public function test_paket_sort_functionality(): void
    {
        // Create test pakets
        Pakets::create([
            'nama_paket' => 'Paket A',
            'kategori' => 'Internet',
            'harga' => 150000,
            'kecepatan' => '50 Mbps'
        ]);

        Pakets::create([
            'nama_paket' => 'Paket B',
            'kategori' => 'Internet',
            'harga' => 200000,
            'kecepatan' => '100 Mbps'
        ]);

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'phone' => '08123456789',
            'address' => 'Jl. Admin No. 1',
        ]);
        $admin->assignRole('admin');

        $this->actingAs($admin);

        $response = $this->get(route('pakets.index', ['sort' => 'name_asc']));

        $response->assertStatus(200);
        $response->assertViewHas('pakets');
    }

    public function test_paket_relationship_with_orders(): void
    {
        // --- PERBAIKAN DI SINI ---
        $user = User::factory()->create(); // <-- 1. BUAT USER
        $paket = Pakets::create([
            'nama_paket' => 'Paket Internet 50Mbps',
            'kategori' => 'Internet',
            'harga' => 150000,
            'kecepatan' => '50 Mbps'
        ]);

        $order = Orders::create([
            'paket_id' => $paket->id,
            'user_id' => $user->id, // <-- 2. TAMBAHKAN USER ID
            // 'name' => 'John Doe', // <-- 3. HAPUS/KOMENTARI BARIS INI
            // 'address' => 'Jl. Test No. 1', // <-- 3. HAPUS/KOMENTARI BARIS INI
            // 'phone' => '08123456789', // <-- 3. HAPUS/KOMENTARI BARIS INI
            'qty' => 1,
            'gross_amount' => 150000,
            'transaction_status' => 'paid',
            'midtrans_order_id' => 'ORDER-TEST-123'
        ]);
        // --- AKHIR PERBAIKAN ---

        $this->assertTrue($paket->orders->contains($order));
        $this->assertEquals($order->paket_id, $paket->id);
    }

    public function test_unauthorized_user_cannot_access_admin_functions(): void
    {
        $user = User::create([
            'name' => 'Regular User',
            'email' => 'user@test.com',
            'password' => bcrypt('password'),
            'phone' => '08123456790',
            'address' => 'Jl. User No. 1',
        ]);
        $user->assignRole('user');

        $this->actingAs($user);

        // Test create paket
        $response = $this->get(route('pakets.create'));
        $response->assertStatus(403);

        // Test store paket
        $response = $this->post(route('pakets.store'), []);
        $response->assertStatus(403);

        // Test edit paket
        $paket = Pakets::create([
            'nama_paket' => 'Test Paket',
            'kategori' => 'Internet',
            'harga' => 100000,
            'kecepatan' => '50 Mbps'
        ]);

        $response = $this->get(route('pakets.edit', $paket));
        $response->assertStatus(403);

        // Test update paket
        $response = $this->put(route('pakets.update', $paket), []);
        $response->assertStatus(403);

        // Test delete paket
        $response = $this->delete(route('pakets.destroy', $paket));
        $response->assertStatus(403);
    }

    // Additional tests for PaketTest class:

    public function test_admin_can_filter_pakets_by_category(): void 
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com', 
            'password' => bcrypt('password'),
            'phone' => '08123456789',
            'address' => 'Jl. Admin No. 1',
        ]);
        $admin->assignRole('admin');

        Pakets::create([
            'nama_paket' => 'Internet Basic',
            'kategori' => 'Internet',
            'harga' => 100000,
            'kecepatan' => '10 Mbps'
        ]);

        Pakets::create([
            'nama_paket' => 'TV Premium',
            'kategori' => 'TV',
            'harga' => 200000,
            'kecepatan' => 'HD'
        ]);

        $this->actingAs($admin);
        
        $response = $this->get(route('pakets.index', ['kategori' => 'Internet']));
        
        $response->assertStatus(200);
        $response->assertViewHas('pakets');
        $response->assertSee('Internet Basic');
        $response->assertDontSee('TV Premium');
    }

    public function test_admin_can_filter_pakets_by_price_range(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'phone' => '08123456789', 
            'address' => 'Jl. Admin No. 1',
        ]);
        $admin->assignRole('admin');

        Pakets::create([
            'nama_paket' => 'Budget Pack',
            'kategori' => 'Internet',
            'harga' => 50000,
            'kecepatan' => '5 Mbps'
        ]);

        Pakets::create([
            'nama_paket' => 'Premium Pack',
            'kategori' => 'Internet', 
            'harga' => 500000,
            'kecepatan' => '100 Mbps'
        ]);

        $this->actingAs($admin);
        
        $response = $this->get(route('pakets.index', [
            'min_price' => 100000,
            'max_price' => 600000
        ]));
        
        $response->assertStatus(200);
        $response->assertViewHas('pakets');
        $response->assertSee('Premium Pack');
        $response->assertDontSee('Budget Pack');
    }

    public function test_cannot_delete_paket_with_active_orders(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'phone' => '08123456789',
            'address' => 'Jl. Admin No. 1',
        ]);
        $admin->assignRole('admin');

        $paket = Pakets::create([
            'nama_paket' => 'Test Paket',
            'kategori' => 'Internet',
            'harga' => 100000,
            'kecepatan' => '10 Mbps'
        ]);

        // --- PERBAIKAN DI SINI ---
        $orderUser = User::factory()->create(); // <-- 1. BUAT USER (nama beda agar tidak konflik)
        Orders::create([
            'paket_id' => $paket->id,
            'user_id' => $orderUser->id, // <-- 2. TAMBAHKAN USER ID
            // 'name' => 'Test User', // <-- 3. HAPUS/KOMENTARI BARIS INI
            // 'address' => 'Test Address', // <-- 3. HAPUS/KOMENTARI BARIS INI
            // 'phone' => '08123456789', // <-- 3. HAPUS/KOMENTARI BARIS INI
            'qty' => 1,
            'gross_amount' => 100000,
            'transaction_status' => 'pending',
            'midtrans_order_id' => 'TEST-123'
        ]);
        // --- AKHIR PERBAIKAN ---

        $this->actingAs($admin);
        
        $response = $this->delete(route('pakets.destroy', $paket));
        
        $response->assertSessionHasErrors();
        $this->assertDatabaseHas('pakets', ['id' => $paket->id]);
    }

    public function test_paket_validates_kecepatan_format(): void 
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'phone' => '08123456789',
            'address' => 'Jl. Admin No. 1', 
        ]);
        $admin->assignRole('admin');

        $this->actingAs($admin);

        $response = $this->post(route('pakets.store'), [
            'nama_paket' => 'Test Paket',
            'kategori' => 'Internet',
            'harga' => 100000,
            'kecepatan' => 'Invalid' // Should be in format 'XX Mbps' for Internet category
        ]);

        $response->assertSessionHasErrors('kecepatan');
    }

    public function test_paket_bulk_delete(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'phone' => '08123456789',
            'address' => 'Jl. Admin No. 1',
        ]);
        $admin->assignRole('admin');

        $pakets = [];
        for($i = 1; $i <= 3; $i++) {
            $pakets[] = Pakets::create([
                'nama_paket' => "Test Paket $i",
                'kategori' => 'Internet',
                'harga' => 100000 * $i,
                'kecepatan' => "10 Mbps"
            ]);
        }

        $this->actingAs($admin);
        
        $paketIds = collect($pakets)->pluck('id')->toArray();
        
        $response = $this->delete(route('pakets.bulkDestroy'), [
            'ids' => $paketIds
        ]);
        
        $response->assertStatus(200);
        foreach($paketIds as $id) {
            $this->assertDatabaseMissing('pakets', ['id' => $id]);
        }
    }
}
