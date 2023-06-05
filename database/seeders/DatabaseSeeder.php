<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\PermissionsSeeder;
use Database\Seeders\UserAndRoleSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $this->call([
            PermissionsSeeder::class,
            UserAndRoleSeeder::class,
            CompaniesSeeder::class,
            CategorySeeder::class,
            PayretoSeeder::class,
            NewPermissionSeeder::class,
        ]);
    }
}
