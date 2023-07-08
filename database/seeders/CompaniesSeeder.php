<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::role('Admin')->first();

        Company::create([
            'name' => 'Payreto',
            'created_by' => $admin->id,
        ]);

        Company::create([
            'name' => 'iBAN-X',
            'created_by' => $admin->id,
        ]);

        Company::create([
            'name' => 'Noire',
            'created_by' => $admin->id,
        ]);

        Company::create([
            'name' => 'Truevo',
            'created_by' => $admin->id,
        ]);

        Company::create([
            'name' => 'T-P Processing',
            'created_by' => $admin->id,
        ]);

        Company::create([
            'name' => 'FIDO MS',
            'created_by' => $admin->id,
        ]);

        Company::create([
            'name' => 'FIDO Money',
            'created_by' => $admin->id,
        ]);

    }
}
