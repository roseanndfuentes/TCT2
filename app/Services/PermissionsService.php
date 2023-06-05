<?php

namespace App\Services;


class PermissionsService
{
      const DESCRIPTIONS = [
            'view users' => 'Allow this role to view users',
            'view user' => 'Allow this role to view user details',
            'create user' => 'Allow this role to create user',
            'edit user' => 'Allow this role to edit user details',
            'delete user' => 'Allow this role to delete user',
            'view roles' => 'Allow this role to view roles',
            'view role' => 'Allow this role to view role details',
            'create role' => 'Allow this role to create role',
            'edit role' => 'Allow this role to edit role details',
            'delete role' => 'Allow this role to delete role',
            'view submission' => 'Allow this role to view form submissions',
            'start form' => 'Allow this role to start a new form',
            'view tasks' => 'Allow this role to view tasks',
            'view task' => 'Allow this role to view task details',
            'create task' => 'Allow this role to create task',
            'edit task' => 'Allow this role to edit task details',
            'delete task' => 'Allow this role to delete task',
            'view companies' => 'Allow this role to view companies',
            'view company' => 'Allow this role to view company details',
            'create company' => 'Allow this role to create company',
            'edit company' => 'Allow this role to edit company details',
            'delete company' => 'Allow this role to delete company',
            'edit company setting' => 'Allow this role to edit company settings',
            'view company segments' => 'Allow this role to view company segments',
            'create company segments' => 'Allow this role to create company segments',
            'edit company segments' => 'Allow this role to edit company segments',
            'delete company segments' => 'Allow this role to delete company segments',
            'view company tasks' => 'Allow this role to view company tasks',
            'create company tasks' => 'Allow this role to create company tasks',
            'edit company tasks' => 'Allow this role to edit company tasks',
            'delete company tasks' => 'Allow this role to delete company tasks',
            'view company questions' => 'Allow this role to view company questions',
            'create company questions' => 'Allow this role to create company questions',
            'edit company questions' => 'Allow this role to edit company questions',
            'delete company questions' => 'Allow this role to delete company questions',
            'view categories' => 'Allow this role to view categories',
            'view category' => 'Allow this role to view category details',
            'create category' => 'Allow this role to create category',
            'edit category' => 'Allow this role to edit category details',
            'delete category' => 'Allow this role to delete category',
            'manage user roles' => 'Allow this role to manage user roles',
            'manage role permissions' => 'Allow this role to manage role permissions',
            'manage cms' => 'Allow this role to manage CMS',
            'view all submissions' => 'Allow this role to view all form submissions (including other users\' submissions)',
            'view submissions' => 'Allow this role to view form his/her own submissions',
            'view billings' => 'Allow this role to view billings',
      ];
}