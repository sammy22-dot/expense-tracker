<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create default categories
        $categories = [
            ['name' => 'Food & Dining', 'description' => 'Groceries, restaurants, and food delivery', 'color' => '#FF6B6B'],
            ['name' => 'Transportation', 'description' => 'Fuel, parking, public transport, taxi', 'color' => '#4ECDC4'],
            ['name' => 'Entertainment', 'description' => 'Movies, games, hobbies, events', 'color' => '#95E1D3'],
            ['name' => 'Utilities', 'description' => 'Electricity, water, internet, phone bills', 'color' => '#FFA07A'],
            ['name' => 'Shopping', 'description' => 'Clothing, groceries, household items', 'color' => '#FFD700'],
            ['name' => 'Health & Medical', 'description' => 'Doctor visits, medicines, gym membership', 'color' => '#87CEEB'],
            ['name' => 'Education', 'description' => 'Courses, books, training materials', 'color' => '#DDA0DD'],
            ['name' => 'Other', 'description' => 'Miscellaneous expenses', 'color' => '#C0C0C0'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}

