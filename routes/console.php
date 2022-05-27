<?php

use App\Models\Department;
use App\Models\Faculty;
use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('configure', function () {

    Artisan::call('migrate:fresh');
    $this->comment('Migration Completed!');

    Faculty::insert([
        [
            'name' => 'Admin'
        ],
        [
            'name' => 'Science'
        ]
        ]);
    $this->comment('Faculty Created!');

    Department::insert([
        [
            'name' => 'Admin',
            'faculty_id' => Faculty::where('name','Admin')->first()->id
        ],
        [
            'name' => 'Mathematics',
            'faculty_id' => Faculty::where('name','Science')->first()->id
        ]
    ]);
    $this->comment('Department Created!');

    $admin = User::create([
        'first_name' => 'Main-Admin',
        'last_name' => 'Administrator',
        'other_name' => 'Account',
        'identity_no' => '123',
        'faculty_id' => Faculty::where('name','Admin')->first()->id,
        'department_id' => Department::where('name','Admin')->first()->id,
        'email' => 'admin@idcard.com',
        'password' => bcrypt('password')
    ]);
    $this->comment("Admin User Created! - Email: {$admin->email} // Password: password");

    $student = User::create([
        'first_name' => 'Main-Student',
        'last_name' => 'Student',
        'other_name' => 'Account',
        'identity_no' => '1234',
        'faculty_id' => Faculty::where('name','Science')->first()->id,
        'department_id' => Department::where('name','Mathematics')->first()->id,
        'email' => 'student@idcard.com',
        'password' => bcrypt('password')
    ]);
    $this->comment("Student User Created! - Email: {$student->email} // Password: password");

    $staff = User::create([
        'first_name' => 'Main-Staff',
        'last_name' => 'Staff',
        'other_name' => 'Account',
        'identity_no' => '12345',
        'faculty_id' => Faculty::where('name','Science')->first()->id,
        'department_id' => Department::where('name','Mathematics')->first()->id,
        'email' => 'staff@idcard.com',
        'password' => bcrypt('password')
    ]);
    $this->comment("Staff User Created! - Email: {$staff->email} // Password: password");

    $roles = [
        'administrator',
        'student',
        'staff'
    ];

    foreach ($roles as $role) {
        Role::create(['name' => $role]);
    }
    $this->comment('Roles Created!');

    $admin->assignRole('administrator');
    $staff->assignRole('staff');
    $student->assignRole('student');
    $this->comment('Roles Assigned!');

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
        'card-type-view',
        'card-type-create',
        'card-type-update',
        'card-type-delete',
    ];

    foreach ($permissions as $permission) {
        Permission::create(['name' => $permission]);
    }
    $this->comment('Permissions Created!');

    $role = Role::findByName('administrator');
    $role->givePermissionTo($permissions);
    $this->comment('Permissions Granted to role!');
});
