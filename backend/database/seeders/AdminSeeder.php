<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Amin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456')
        ]);

        $role = Role::create(['name' => 'Admin']);
        $permission = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permission);

        $user->assignRole([$role->id]);

        // $permissions = Permission::all();
        // $role = Role::find(1);
        // $role->syncPermissions($permissions);

        // $user->assignRole($role);
    }
}
