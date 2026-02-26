<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaults = [
            'IT Support',
            'Human Resources',
            'Facilities',
            'Finance',
            'Software',
            'Network',
            'Maintenance',
        ];

        foreach ($defaults as $name) {
            Category::updateOrCreate([
                'name' => $name,
            ], [
                'is_active' => true,
            ]);
        }
    }
}
