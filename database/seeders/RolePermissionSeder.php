<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pemrissions = [
            'manage categories',
            'manage packages',
            'manage transactions',
            'manage package banks',
            'checkout package',
            'view orders',

        ];

        foreach($pemrissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
            ]);
        }
        $customerRole = Role::firstOrCreate([
            'name' => 'customer'
        ]);

        $customerPermissions = [
            'checkout package',
            'view orders',
        ];

        $customerRole->syncPermissions($customerPermissions);

        $superAdminRole = Role::firstOrCreate([
            'name' => 'super_admin'
        ]);

        $user = User::create([
            'name' => 'Ryuu Admin',
            'email' => 'ryuuadmin@gmail.com',
            'phonenumber' => '08123456789',
            'avatar' => 'iamges/default.png',
            'password' => bcrypt('12345678'),
        ]);
        $user->assignRole($superAdminRole);
    }
}
