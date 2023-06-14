<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionsSeeder extends Seeder
{

    public function run(): void
    {
        $admin = Role::create(['name'=>'ADMIN']);
        $adminUser = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);
        $adminUser->syncRoles($admin);
        $agent = Role::create(['name'=>'AGENT']);
        Permission::create(['name' => 'view users']);
        $admin->givePermissionTo('view users');
        Permission::create(['name' => 'view user']);
        $admin->givePermissionTo('view user');
        Permission::create(['name' => 'create user']);
        $admin->givePermissionTo('create user');
        Permission::create(['name' => 'edit user']);
        $admin->givePermissionTo('edit user');
        Permission::create(['name' => 'delete user']);
        $admin->givePermissionTo('delete user');
        Permission::create(['name' => 'view roles']);
        $admin->givePermissionTo('view roles');
        Permission::create(['name' => 'view role']);
        $admin->givePermissionTo('view role');
        Permission::create(['name' => 'create role']);
        $admin->givePermissionTo('create role');
        Permission::create(['name' => 'edit role']);
        $admin->givePermissionTo('edit role');
        Permission::create(['name' => 'delete role']);
        $admin->givePermissionTo('delete role');
        Permission::create(['name' => 'view all submissions']);
        $admin->givePermissionTo('view all submissions');
        $view_submissions = Permission::create(['name' => 'view submissions']);
        $admin->givePermissionTo($view_submissions);
        $agent->givePermissionTo($view_submissions);
        $view_submission = Permission::create(['name' => 'view submission']);
        $admin->givePermissionTo($view_submission);
        $agent->givePermissionTo($view_submission);
        $start_form = Permission::create(['name' => 'start form']);
        $agent->givePermissionTo($start_form);
        Permission::create(['name' => 'view tasks']);
        $admin->givePermissionTo('view tasks');
        Permission::create(['name' => 'view task']);
        $admin->givePermissionTo('view task');
        Permission::create(['name' => 'create task']);
        $admin->givePermissionTo('create task');
        Permission::create(['name' => 'edit task']);
        $admin->givePermissionTo('edit task');
        Permission::create(['name' => 'delete task']);
        $admin->givePermissionTo('delete task');
        $view_companies = Permission::create(['name' => 'view companies']);
        $admin->givePermissionTo($view_companies);
        $agent->givePermissionTo($view_companies);
        $view_company = Permission::create(['name' => 'view company']);
        $admin->givePermissionTo($view_company);
        $agent->givePermissionTo($view_company);
        Permission::create(['name' => 'create company']);
        $admin->givePermissionTo('create company');
        Permission::create(['name' => 'edit company']);
        $admin->givePermissionTo('edit company');
        Permission::create(['name' => 'delete company']);
        $admin->givePermissionTo('delete company');
        Permission::create(['name' => 'edit company setting']);
        $admin->givePermissionTo('edit company setting');
        $view_company_segment = Permission::create(['name' => 'view company segments']);
        $admin->givePermissionTo($view_company_segment);
        $agent->givePermissionTo($view_company_segment);
        Permission::create(['name' => 'create company segments']);
        $admin->givePermissionTo('create company segments');
        Permission::create(['name' => 'edit company segments']);
        $admin->givePermissionTo('edit company segments');
        Permission::create(['name' => 'delete company segments']);
        $admin->givePermissionTo('delete company segments');
        $view_company_task = Permission::create(['name' => 'view company tasks']);
        $admin->givePermissionTo($view_company_task);
        $agent->givePermissionTo($view_company_task);
        Permission::create(['name' => 'create company tasks']);
        $admin->givePermissionTo('create company tasks');
        Permission::create(['name' => 'edit company tasks']);
        $admin->givePermissionTo('edit company tasks');
        Permission::create(['name' => 'delete company tasks']);
        $admin->givePermissionTo('delete company tasks');
        $view_company_questions = Permission::create(['name' => 'view company questions']);
        $admin->givePermissionTo($view_company_questions);
        $agent->givePermissionTo($view_company_questions);
        Permission::create(['name' => 'create company questions']);
        $admin->givePermissionTo('create company questions');
        Permission::create(['name' => 'edit company questions']);
        $admin->givePermissionTo('edit company questions');
        Permission::create(['name' => 'delete company questions']);
        $admin->givePermissionTo('delete company questions');
        $view_company_categories = Permission::create(['name' => 'view categories']);
        $admin->givePermissionTo($view_company_categories);
        $agent->givePermissionTo($view_company_categories);
        $view_company_category = Permission::create(['name' => 'view category']);
        $admin->givePermissionTo($view_company_category);
        $agent->givePermissionTo($view_company_category);
        Permission::create(['name' => 'create category']);
        $admin->givePermissionTo('create category');
        Permission::create(['name' => 'edit category']);
        $admin->givePermissionTo('edit category');
        Permission::create(['name' => 'delete category']);
        $admin->givePermissionTo('delete category');
        Permission::create(['name' => 'manage user roles']);
        $admin->givePermissionTo('manage user roles');
        Permission::create(['name' => 'manage role permissions']);
        $admin->givePermissionTo('manage role permissions');
        Permission::create(['name' => 'view billings']);
        $admin->givePermissionTo('view billings');
    }
}
