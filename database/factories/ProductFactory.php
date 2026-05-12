<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $baseName = fake()->randomElement([
            'iPhone 15 Pro',
            'Samsung Odyssey G7',
            'ASUS ROG Laptop',
            'GoPro Hero 12',
            'Canon EOS R6',
            'Nintendo Switch OLED',
            'MacBook Pro M3',
            'AirPods Pro',
            'iPad Pro 13',
            'Sony WH-1000XM5',
        ]);

        // Картинки из storage/app/public/products
        $images = [
            'products/iphone.jpg',
            'products/laptop.jpg',
            'products/camera.jpg',
            'products/headphones.jpg',
            'products/tablet.jpg',
        ];

        $name = $baseName . ' ' . uniqid();

        return [

            'name' => $name,

            'slug' => Str::slug($name),

            'description' => fake()->paragraphs(4, true),

            'price' => fake()->numberBetween(500, 5000),

            'stock' => fake()->numberBetween(0, 100),

            // СЛУЧАЙНАЯ КАРТИНКА
            'image' => fake()->randomElement($images),

            // Если gallery json поле
            'gallery' => [
                fake()->randomElement($images),
                fake()->randomElement($images),
                fake()->randomElement($images),
            ],

            'category_id' => Category::inRandomOrder()->first()?->id,

            'is_active' => true,
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Product $product) {

            $tags = Tag::inRandomOrder()
                ->take(rand(1, 4))
                ->pluck('id');

            $product->tags()->attach($tags);
        });
    }
}
