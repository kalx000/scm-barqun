<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',

            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            'product-list',
            'product-create',
            'product-edit',
            'product-delete',

            'supplier-list',
            'supplier-create',
            'supplier-edit',
            'supplier-delete',

            'inventory-list',
            'inventory-create',
            'inventory-edit',
            'inventory-delete',

            'customer-list',
            'customer-create',
            'customer-edit',
            'customer-delete',

            'order-list',
            'order-create',
            'order-edit',
            'order-delete',

            'stockin-list',
            'stockin-create',
            'stockin-edit',
            'stockin-delete',

            'stockout-list',
            'stockout-create',
            'stockout-edit',
            'stockout-delete',

            'stockopname-list',
            'stockopname-create',
            'stockopname-edit',
            'stockopname-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
