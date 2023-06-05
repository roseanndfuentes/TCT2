<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Category::create([
            'name' => 'Website Compliance Review',
            'created_by' => 1,
            'formula' => Category::PER_PERFORMED_TASK,
        ]);

        Category::create([
            'name' => 'Extended Application Support Fee',
            'created_by' => 1,
            'formula' => Category::PER_UNIT_IN_PERFORMED_TASK,
        ]);
    }
}
