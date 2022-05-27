<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'first_name' => 'Test account',
            'last_name' => 'Test account last',
            'identity_no' => ' 202178 ',
            'faculty_id' => 1,
            'department_id' => 1,
            'email' => 'test@gmail.com',
            'password' => bcrypt('123456')
        ]);

        $role = Role::create([
            ['name' => 'admin'],
            ['name' => 'staff'],
            ['name' => 'student'],
        ]);

        $permissions = Permission::pluck('id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
