<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    private $permissions = [
        'Role-list',
        'Role-create',
        'Role-edit',
        'Role-delete',

        'User-list',
        'User-create',
        'User-edit',
        'User-delete',

    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create permissions
        foreach ($this->permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create admin user
        $user = User::create([
            "name" => "Ahmed Fathy",
            "email" => "SuperAdmin@admin.com",
            "phone" => "01040983170",
            "password" => bcrypt('12345678'),
            "email_verified_at" => Carbon::now(),
            "phone_verified_at" => Carbon::now(),
            "image" => "feed-back-1.jpg",
        ]);

        // Create admin role
        $role = Role::firstOrCreate(['guard_name' => 'web', 'name' => 'Super Admin']);

        // Assign all permissions to the role
        $permissions = Permission::pluck('id')->toArray();
        $role->syncPermissions($permissions);

        // Assign the role to the user
        $user->assignRole($role);
    }
}
