<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Pakets;
use App\Models\Orders;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PaketsTest extends TestCase
{
    use RefreshDatabase;

    public function test_paket_can_be_created()
    {
        $paket = Pakets::create([
            'nama_paket' => 'Paket Internet 50Mbps',
            'kategori' => 'Internet',
            'harga' => 150000,
            'kecepatan' => '50 Mbps'
        ]);

        $this->assertInstanceOf(Pakets::class, $paket);
        $this->assertEquals('Paket Internet 50Mbps', $paket->nama_paket);
        $this->assertEquals('Internet', $paket->kategori);
        $this->assertEquals(150000, $paket->harga);
        $this->assertEquals('50 Mbps', $paket->kecepatan);
    }

    public function test_paket_fillable_attributes()
    {
        $paket = new Pakets();
        $fillable = $paket->getFillable();
        
        $expectedFillable = ['nama_paket', 'kategori', 'harga', 'kecepatan'];
        
        $this->assertEquals($expectedFillable, $fillable);
    }

    public function test_paket_has_many_orders_relationship()
    {
        $paket = Pakets::create([
            'nama_paket' => 'Paket Internet 50Mbps',
            'kategori' => 'Internet',
            'harga' => 150000,
            'kecepatan' => '50 Mbps'
        ]);

        $order1 = Orders::create([
            'paket_id' => $paket->id,
            'name' => 'John Doe',
            'address' => 'Jl. Test No. 1',
            'phone' => '08123456789',
            'qty' => 1,
            'gross_amount' => 150000,
            'transaction_status' => 'paid',
            'midtrans_order_id' => 'ORDER-TEST-1'
        ]);

        $order2 = Orders::create([
            'paket_id' => $paket->id,
            'name' => 'Jane Doe',
            'address' => 'Jl. Test No. 2',
            'phone' => '08123456790',
            'qty' => 2,
            'gross_amount' => 300000,
            'transaction_status' => 'pending',
            'midtrans_order_id' => 'ORDER-TEST-2'
        ]);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $paket->orders());
        $this->assertCount(2, $paket->orders);
        $this->assertTrue($paket->orders->contains($order1));
        $this->assertTrue($paket->orders->contains($order2));
    }

    public function test_paket_uses_has_factory_trait()
    {
        $paket = new Pakets();
        $this->assertTrue(method_exists($paket, 'factory'));
    }

    public function test_paket_can_be_updated()
    {
        $paket = Pakets::create([
            'nama_paket' => 'Paket Internet 50Mbps',
            'kategori' => 'Internet',
            'harga' => 150000,
            'kecepatan' => '50 Mbps'
        ]);

        $paket->update([
            'nama_paket' => 'Paket Internet 100Mbps',
            'harga' => 250000,
            'kecepatan' => '100 Mbps'
        ]);

        $this->assertEquals('Paket Internet 100Mbps', $paket->fresh()->nama_paket);
        $this->assertEquals(250000, $paket->fresh()->harga);
        $this->assertEquals('100 Mbps', $paket->fresh()->kecepatan);
    }

    public function test_paket_can_be_deleted()
    {
        $paket = Pakets::create([
            'nama_paket' => 'Paket Internet 50Mbps',
            'kategori' => 'Internet',
            'harga' => 150000,
            'kecepatan' => '50 Mbps'
        ]);

        $paketId = $paket->id;
        $paket->delete();

        $this->assertDatabaseMissing('pakets', ['id' => $paketId]);
    }

    public function test_paket_orders_are_deleted_when_paket_is_deleted()
    {
        $paket = Pakets::create([
            'nama_paket' => 'Paket Internet 50Mbps',
            'kategori' => 'Internet',
            'harga' => 150000,
            'kecepatan' => '50 Mbps'
        ]);

        $order = Orders::create([
            'paket_id' => $paket->id,
            'name' => 'John Doe',
            'address' => 'Jl. Test No. 1',
            'phone' => '08123456789',
            'qty' => 1,
            'gross_amount' => 150000,
            'transaction_status' => 'paid',
            'midtrans_order_id' => 'ORDER-TEST-123'
        ]);

        $paket->delete();

        $this->assertDatabaseMissing('orders', ['id' => $order->id]);
    }

    public function test_paket_has_correct_table_name()
    {
        $paket = new Pakets();
        $this->assertEquals('pakets', $paket->getTable());
    }

    public function test_paket_has_timestamps()
    {
        $paket = Pakets::create([
            'nama_paket' => 'Paket Internet 50Mbps',
            'kategori' => 'Internet',
            'harga' => 150000,
            'kecepatan' => '50 Mbps'
        ]);

        $this->assertNotNull($paket->created_at);
        $this->assertNotNull($paket->updated_at);
    }

    public function test_paket_can_have_multiple_orders()
    {
        $paket = Pakets::create([
            'nama_paket' => 'Paket Internet 50Mbps',
            'kategori' => 'Internet',
            'harga' => 150000,
            'kecepatan' => '50 Mbps'
        ]);

        // Create multiple orders for the same paket
        for ($i = 1; $i <= 5; $i++) {
            Orders::create([
                'paket_id' => $paket->id,
                'name' => "Customer {$i}",
                'address' => "Jl. Test No. {$i}",
                'phone' => "0812345678{$i}",
                'qty' => 1,
                'gross_amount' => 150000,
                'transaction_status' => 'paid',
                'midtrans_order_id' => "ORDER-TEST-{$i}"
            ]);
        }

        $this->assertCount(5, $paket->fresh()->orders);
    }

    public function test_paket_attributes_are_correctly_typed()
    {
        $paket = Pakets::create([
            'nama_paket' => 'Paket Internet 50Mbps',
            'kategori' => 'Internet',
            'harga' => 150000,
            'kecepatan' => '50 Mbps'
        ]);

        $this->assertIsString($paket->nama_paket);
        $this->assertIsString($paket->kategori);
        $this->assertIsInt($paket->harga);
        $this->assertIsString($paket->kecepatan);
    }
}
