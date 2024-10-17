<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;
use Faker\Factory as Faker;
class BrandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker= Faker::create();
        for($i=1;$i<=50;$i++){
            Brand::create([
                'name'=>$faker->word,
                'images' => $faker->imageUrl(),
                'slug' => $faker->slug(),
                'status' => 1,
            ]);
        }
    }
}
