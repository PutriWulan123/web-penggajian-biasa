<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Buat role admin
            $adminRole = Role::create(['name' => 'admin']);
    
            // Buat role pegawai
            $superadminRole = Role::create(['name' => 'superadmin']);
    
            // Buat user admin
            $admin = User::create([
                'name' => 'admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('12345678'),
            ]);
            $admin->roles()->attach($adminRole);
    
            // Buat user superadmin
            $superadmin = User::create([
                'name' => 'superadmin',
                'email' => 'superadmin@example.com',
                'password' => bcrypt('12345678'),
            ]);
            $superadmin->roles()->attach($superadminRole);

            // $permission = Permission::create(['name' => 'read role']);
            // $permission = Permission::create(['name' => 'create role']);
            // $permission = Permission::create(['name' => 'update role']);
            // $permission = Permission::create(['name' => 'delete role']);

            // $adminRole->assignRole('admin');
            // $superadminRole->assignRole('superadmin');
            $permissions = [
                'read role',
                'create role',
                'update role',
                'delete role'
            ];
    
            foreach ($permissions as $permissionName) {
                $permission = Permission::create(['name' => $permissionName]);
    
                // Memberikan semua izin kepada peran 'admin'
                $adminRole->givePermissionTo($permission);
            }
    
            // Memberikan beberapa izin kepada peran 'superadmin'
            $superadminRole->givePermissionTo('read role');
            $superadminRole->givePermissionTo('create role');
    }
}
