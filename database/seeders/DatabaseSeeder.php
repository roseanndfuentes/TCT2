<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
