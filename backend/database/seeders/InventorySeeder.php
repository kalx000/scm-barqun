<?php

namespace Database\Seeders;

use App\Models\Inventory;
use Illuminate\Database\Seeder;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $inventories = [
            [
                'nama_gudang' => 'PT. Olympus',
                'lokasi_gudang' => 'Jln. Kadrioening',
                'kapasitas_stock' => 5000000000
            ],
            [
                'nama_gudang' => 'PT. Asgard',
                'lokasi_gudang' => 'Jln. Kadrioening',
                'kapasitas_stock' => 5000000000
            ],
            [
                'nama_gudang' => 'PT. Muspelheim',
                'lokasi_gudang' => 'Jln. Kadrioening',
                'kapasitas_stock' => 5000000000
            ],
            [
                'nama_gudang' => 'PT. Svartalfheim',
                'lokasi_gudang' => 'Jln. Kadrioening',
                'kapasitas_stock' => 5000000000
            ],
            [
                'nama_gudang' => 'PT. Midgard',
                'lokasi_gudang' => 'Jln. Kadrioening',
                'kapasitas_stock' => 5000000000
            ],
            [
                'nama_gudang' => 'PT. Alfheim',
                'lokasi_gudang' => 'Jln. Kadrioening',
                'kapasitas_stock' => 5000000000
            ],
            [
                'nama_gudang' => 'PT. Niflheim',
                'lokasi_gudang' => 'Jln. Kadrioening',
                'kapasitas_stock' => 5000000000
            ],
            [
                'nama_gudang' => 'PT. Jotunheim',
                'lokasi_gudang' => 'Jln. Kadrioening',
                'kapasitas_stock' => 5000000000
            ],
            [
                'nama_gudang' => 'PT. Helheim',
                'lokasi_gudang' => 'Jln. Kadrioening',
                'kapasitas_stock' => 5000000000
            ],
            [
                'nama_gudang' => 'PT. Vanaheim',
                'lokasi_gudang' => 'Jln. Kadrioening',
                'kapasitas_stock' => 5000000000
            ],
        ];

        foreach ($inventories as $inventory) {
            Inventory::create($inventory);
        }
    }
}
