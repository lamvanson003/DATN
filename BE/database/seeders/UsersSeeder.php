<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Faker\Factory as Faker;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        
        for($i = 0; $i < 5; $i++) {
            User::create([
                'fullname' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'username' => $faker->userName,
                'gender' => $faker->optional()->randomElement(['men', 'women']), // Gender có thể null

                'password' => Hash::make('123'), // Mật khẩu mặc định là 123
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'token' => Str::random(60),
                'status' => 1, // Mặc định status là 1
                'roles' => 2,   // Mặc định role là 2
            ]);
        }
    }
}
