<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customers = [
            [
                'nama_customer' => 'Rian',
                'email' => 'rian@gmail.com',
                'nomor_telepon' => '08123456789',
                'alamat' => 'Jln. Suryanata'
            ],
            [
                'nama_customer' => 'Galih',
                'email' => 'galih@gmail.com',
                'nomor_telepon' => '08123456789',
                'alamat' => 'Jln. Suryanata'
            ],
            [
                'nama_customer' => 'Amin',
                'email' => 'amin@gmail.com',
                'nomor_telepon' => '08123456789',
                'alamat' => 'Jln. Suryanata'
            ],
            [
                'nama_customer' => 'Ruin',
                'email' => 'ruin@gmail.com',
                'nomor_telepon' => '08123456789',
                'alamat' => 'Jln. Suryanata'
            ],
            [
                'nama_customer' => 'Agus',
                'email' => 'agus@gmail.com',
                'nomor_telepon' => '08123456789',
                'alamat' => 'Jln. Suryanata'
            ],
            [
                'nama_customer' => 'Bambang',
                'email' => 'bambang@gmail.com',
                'nomor_telepon' => '08123456789',
                'alamat' => 'Jln. Suryanata'
            ],
            [
                'nama_customer' => 'Albert',
                'email' => 'albert@gmail.com',
                'nomor_telepon' => '08123456789',
                'alamat' => 'Jln. Suryanata'
            ],
            [
                'nama_customer' => 'Joko',
                'email' => 'joko@gmail.com',
                'nomor_telepon' => '08123456789',
                'alamat' => 'Jln. Suryanata'
            ],
            [
                'nama_customer' => 'Roni',
                'email' => 'roni@gmail.com',
                'nomor_telepon' => '08123456789',
                'alamat' => 'Jln. Suryanata'
            ],
            [
                'nama_customer' => 'Imut',
                'email' => 'imut@gmail.com',
                'nomor_telepon' => '08123456789',
                'alamat' => 'Jln. Suryanata'
            ],
        ];

        foreach ($customers as $customer) {
            Customer::create($customer);
        }
    }
}
