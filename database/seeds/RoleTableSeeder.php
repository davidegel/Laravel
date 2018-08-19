<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    $role_employee = new Role();
    $role_employee->name = 'employee';
    $role_employee->description = 'A Employee User';
    $role_employee->save();
    
    $role_employee = new Role();
    $role_employee->name = 'manager';
    $role_employee->description = 'A Manager User';
    $role_employee->save();

    }
}
