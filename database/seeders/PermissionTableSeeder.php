<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role',
            'permission',
            'user-view',
            'user-create',
            'user-update',
            'faculty-delete',
            'faculty-view',
            'faculty-create',
            'faculty-update',
            'department-delete',
            'department-view',
            'department-create',
            'department-update',
            'card-document-type-view',
            'card-document-type-create',
            'card-document-type-update',
            'card-document-type-delete',
            'card-type-delete',
            'card-type-view',
            'card-type-create',
            'card-type-update',
            'card-type-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
