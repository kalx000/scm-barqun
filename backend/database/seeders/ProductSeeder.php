<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'nama_barang' => 'Besi',
                'harga' => 2000000000,
                'jumlah_stock_tersedia' => 2000000,
                'deskripsi' => 'Besi Lah'
            ],
            [
                'nama_barang' => 'Kayu',
                'harga' => 2000000000,
                'jumlah_stock_tersedia' => 2000000,
                'deskripsi' => 'Kayu Lah'
            ],
            [
                'nama_barang' => 'Baut',
                'harga' => 2000000000,
                'jumlah_stock_tersedia' => 2000000,
                'deskripsi' => 'Baut Lah'
            ],
            [
                'nama_barang' => 'Mur',
                'harga' => 2000000000,
                'jumlah_stock_tersedia' => 2000000,
                'deskripsi' => 'Mur Lah'
            ],
            [
                'nama_barang' => 'Ban Dalam',
                'harga' => 2000000000,
                'jumlah_stock_tersedia' => 2000000,
                'deskripsi' => 'Ban Dalam Lah'
            ],
            [
                'nama_barang' => 'kampas Rem',
                'harga' => 2000000000,
                'jumlah_stock_tersedia' => 2000000,
                'deskripsi' => 'kampas Rem Lah'
            ],
            [
                'nama_barang' => 'Meja',
                'harga' => 2000000000,
                'jumlah_stock_tersedia' => 2000000,
                'deskripsi' => 'Meja Lah'
            ],
            [
                'nama_barang' => 'Kursi',
                'harga' => 2000000000,
                'jumlah_stock_tersedia' => 2000000,
                'deskripsi' => 'Kursi Lah'
            ],
            [
                'nama_barang' => 'Kipas',
                'harga' => 2000000000,
                'jumlah_stock_tersedia' => 2000000,
                'deskripsi' => 'Kipas Lah'
            ],
            [
                'nama_barang' => 'Galon',
                'harga' => 2000000000,
                'jumlah_stock_tersedia' => 2000000,
                'deskripsi' => 'Galon Lah'
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
