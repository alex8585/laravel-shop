<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductImportSeeder extends Seeder
{
    public function run(): void
    {
        // Сколько товаров создать
        $productsCount = 100;

        for ($i = 0; $i < $productsCount; $i++) {

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

            $name = $baseName . ' ' . uniqid();

            /*
            |--------------------------------------------------------------------------
            | MAIN IMAGE
            |--------------------------------------------------------------------------
            */

            $mainImageName = 'products/' . Str::uuid() . '.jpg';

            $mainImage = Http::timeout(30)
                ->get('https://picsum.photos/800/800')
                ->body();

            Storage::disk('public')->put($mainImageName, $mainImage);

            /*
            |--------------------------------------------------------------------------
            | GALLERY
            |--------------------------------------------------------------------------
            */

            $gallery = [];

            // 2 картинки в gallery
            for ($g = 0; $g < 2; $g++) {

                $galleryImageName = 'products/' . Str::uuid() . '.jpg';

                $galleryImage = Http::timeout(30)
                    ->get('https://picsum.photos/800/800')
                    ->body();

                Storage::disk('public')->put(
                    $galleryImageName,
                    $galleryImage
                );

                $gallery[] = $galleryImageName;
            }

            /*
            |--------------------------------------------------------------------------
            | PRODUCT
            |--------------------------------------------------------------------------
            */

            $product = Product::create([

                'name' => $name,

                'slug' => Str::slug($name),

                'description' => fake()->paragraphs(4, true),

                'price' => fake()->numberBetween(500, 5000),

                'stock' => fake()->numberBetween(0, 100),

                'image' => $mainImageName,

                'gallery' => $gallery,

                'category_id' => Category::inRandomOrder()->first()?->id,

                'is_active' => true,
            ]);

            /*
            |--------------------------------------------------------------------------
            | TAGS
            |--------------------------------------------------------------------------
            */

            $tags = Tag::inRandomOrder()
                ->take(rand(1, 4))
                ->pluck('id');

            $product->tags()->attach($tags);

            $this->command->info(
                'Created product: ' . $product->name
            );
        }
    }
}
