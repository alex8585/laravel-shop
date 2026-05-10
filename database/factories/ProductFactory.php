<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $products = [
            'iPhone 15 Pro',
            'Samsung Galaxy S24',
            'MacBook Air M3',
            'Gaming Mechanical Keyboard',
            'Wireless Gaming Mouse',
            'Sony WH-1000XM5',
            'Apple Watch Ultra',
            'iPad Pro 13',
            'Dell XPS 15',
            'PlayStation 5',
            'Xbox Series X',
            'Nintendo Switch OLED',
            'ASUS ROG Laptop',
            'Logitech MX Master 3S',
            'AirPods Pro 2',
            'GoPro Hero 12',
            'Canon EOS R6',
            'DJI Mini 4 Pro',
            'Samsung Odyssey G7',
            'LG OLED TV 55',
        ];

        $name = fake()->randomElement($products);

        return [
            'name' => $name,

            'slug' => Str::slug($name . '-' . fake()->unique()->numberBetween(1, 9999)),

            'description' => fake()->paragraphs(
                random_int(2, 5),
                true
            ),

            'price' => fake()->numberBetween(50, 5000),

            'stock' => fake()->numberBetween(0, 120),

            'is_active' => true,

            'category_id' => Category::inRandomOrder()->first()?->id,

            'image' => null,

            'gallery' => [],
        ];
    }
}

