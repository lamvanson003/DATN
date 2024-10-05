<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brands;
use Faker\Factory as Faker;
class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        
        for ($i = 0; $i < 5; $i++) {
            Product::create([
                'brand_id' => $faker->numberBetween(1, 25), 
                'category_id' => $faker->numberBetween(4, 9), 
                'name' => $faker->word,
                'images' => $faker->imageUrl(), 
                'image_lists' => json_encode([ 
                    $faker->imageUrl(),
                    $faker->imageUrl(),
                    $faker->imageUrl()
                ]),
                'status' => 1,
                'slug' => $faker->slug(),
                'short_desc' => $faker->sentence, 
                'description' => $faker->paragraph, 
            ]);
        }
    }
}
