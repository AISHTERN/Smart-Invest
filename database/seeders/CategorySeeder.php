<?php

// database/seeders/CategorySeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Investment;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Technology', 'icon' => 'categories/technology.png'],
            ['name' => 'Healthcare', 'icon' => 'categories/healthcare.png'],
            ['name' => 'Education', 'icon' => 'categories/education.png'],
            ['name' => 'Finance', 'icon' => 'categories/finance.png'],
            ['name' => 'E-commerce', 'icon' => 'categories/ecommerce.png'],
            ['name' => 'Transportation', 'icon' => 'categories/transportation.png'],
            ['name' => 'Biotech', 'icon' => 'categories/biotech.png'],
            ['name' => 'Real Estate', 'icon' => 'categories/real_estate.png'],
            ['name' => 'Entertainment', 'icon' => 'categories/entertainment.png'],
            ['name' => 'Agriculture', 'icon' => 'categories/agriculture.png'],
            ['name' => 'Food & Beverage', 'icon' => 'categories/food_beverage.png'],
            ['name' => 'Energy', 'icon' => 'categories/energy.png'],
            ['name' => 'Robotics', 'icon' => 'categories/robotics.png'],
            ['name' => 'Logistics', 'icon' => 'categories/logistics.png'],
            ['name' => 'Gaming', 'icon' => 'categories/gaming.png'],
        ];

        foreach ($categories as $categoryData) {
            $category = Category::create($categoryData);

            // Generate 3 dummy investments per category
            for ($i = 1; $i <= 3; $i++) {
                Investment::create([
                    'title' => $categoryData['name'] . " Project #{$i}",
                    'description' => 'This is a sample description for ' . strtolower($categoryData['name']) . ' project #' . $i,
                    'image' => strtolower(str_replace(' ', '_', $categoryData['name'])) . "{$i}.jpg",
                    'badge' => ($i % 2 == 0) ? 'Trending' : 'Funded',
                    'market_price' => rand(1000, 10000),
                    'category_id' => $category->id
                ]);
            }
        }
    }
}