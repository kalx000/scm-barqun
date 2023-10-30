<?php

namespace Database\Seeders;

use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $suppliers = [
            [
                'nama_supplier' => 'Rian',
                'email' => 'rian@gmail.com',
                'nomor_telepon' => '08123456789',
                'alamat' => 'Jln. Suryanata'
            ],
            [
                'nama_supplier' => 'Galih',
                'email' => 'galih@gmail.com',
                'nomor_telepon' => '08123456789',
                'alamat' => 'Jln. Suryanata'
            ],
            [
                'nama_supplier' => 'Amin',
                'email' => 'amin@gmail.com',
                'nomor_telepon' => '08123456789',
                'alamat' => 'Jln. Suryanata'
            ],
            [
                'nama_supplier' => 'Ruin',
                'email' => 'ruin@gmail.com',
                'nomor_telepon' => '08123456789',
                'alamat' => 'Jln. Suryanata'
            ],
            [
                'nama_supplier' => 'Agus',
                'email' => 'agus@gmail.com',
                'nomor_telepon' => '08123456789',
                'alamat' => 'Jln. Suryanata'
            ],
            [
                'nama_supplier' => 'Bambang',
                'email' => 'bambang@gmail.com',
                'nomor_telepon' => '08123456789',
                'alamat' => 'Jln. Suryanata'
            ],
            [
                'nama_supplier' => 'Albert',
                'email' => 'albert@gmail.com',
                'nomor_telepon' => '08123456789',
                'alamat' => 'Jln. Suryanata'
            ],
            [
                'nama_supplier' => 'Joko',
                'email' => 'joko@gmail.com',
                'nomor_telepon' => '08123456789',
                'alamat' => 'Jln. Suryanata'
            ],
            [
                'nama_supplier' => 'Roni',
                'email' => 'roni@gmail.com',
                'nomor_telepon' => '08123456789',
                'alamat' => 'Jln. Suryanata'
            ],
            [
                'nama_supplier' => 'Imut',
                'email' => 'imut@gmail.com',
                'nomor_telepon' => '08123456789',
                'alamat' => 'Jln. Suryanata'
            ],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}
