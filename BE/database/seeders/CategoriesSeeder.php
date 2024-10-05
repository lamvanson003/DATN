<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Category;
use App\Models\Product;
use Faker\Factory as Faker;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $faker = Faker::create();
        for($i = 0; $i < 5; $i++) {
            Category::create([
                'name' => $faker->name,
                'images' => $faker->imageUrl(),
                'description' => $faker->text(),
                'slug' => $faker->slug(),
                'status' => 1,
            ]);
        }
    }
}
