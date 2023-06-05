<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class PermissionsSeeder extends Seeder
{

    public function run(): void
    {
        $agent = Role::create(['name'=>'AGENT']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'view user']);
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'edit user']);
        Permission::create(['name' => 'delete user']);

        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'view role']);
        Permission::create(['name' => 'create role']);
        Permission::create(['name' => 'edit role']);
        Permission::create(['name' => 'delete role']);

        Permission::create(['name' => 'view all submissions']);
        $view_submissions = Permission::create(['name' => 'view submissions']);
        $view_submission = Permission::create(['name' => 'view submission']);
        $agent->givePermissionTo($view_submission);
        $start_form = Permission::create(['name' => 'start form']);
        $agent->givePermissionTo($start_form);

        Permission::create(['name' => 'view tasks']);
        Permission::create(['name' => 'view task']);
        Permission::create(['name' => 'create task']);
        Permission::create(['name' => 'edit task']);
        Permission::create(['name' => 'delete task']);

        $view_companies = Permission::create(['name' => 'view companies']);
        $agent->givePermissionTo($view_companies);
        
        $view_company = Permission::create(['name' => 'view company']);
        $agent->givePermissionTo($view_company);
        
        Permission::create(['name' => 'create company']);
        Permission::create(['name' => 'edit company']);
        Permission::create(['name' => 'delete company']);
        Permission::create(['name' => 'edit company setting']);

        $view_company_segment = Permission::create(['name' => 'view company segments']);
        $agent->givePermissionTo($view_company_segment);

        Permission::create(['name' => 'create company segments']);
        Permission::create(['name' => 'edit company segments']);
        Permission::create(['name' => 'delete company segments']);
        $view_company_task = Permission::create(['name' => 'view company tasks']);
        $agent->givePermissionTo($view_company_task);

        Permission::create(['name' => 'create company tasks']);
        Permission::create(['name' => 'edit company tasks']);
        Permission::create(['name' => 'delete company tasks']);

        $view_company_questions = Permission::create(['name' => 'view company questions']);
        $agent->givePermissionTo($view_company_questions);

        Permission::create(['name' => 'create company questions']);
        Permission::create(['name' => 'edit company questions']);
        Permission::create(['name' => 'delete company questions']);


        $view_company_categories = Permission::create(['name' => 'view categories']);
        $agent->givePermissionTo($view_company_categories);

        $view_company_category = Permission::create(['name' => 'view category']);
        $agent->givePermissionTo($view_company_category);
        
        Permission::create(['name' => 'create category']);
        Permission::create(['name' => 'edit category']);
        Permission::create(['name' => 'delete category']);

        Permission::create(['name' => 'manage user roles']);
        Permission::create(['name' => 'manage role permissions']);

        Permission::create(['name' => 'manage cms']);

        Permission::create(['name' => 'view billings']);
        
    }
}
