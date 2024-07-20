<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Toy;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            "firstName" => "admin",
            "lastName" => "admin",
            "email" => "admin@gmail.com",
            "contact" => "123456789",
            "address" => "Bina Nusantara University Bandung",
            "birthday" => "2000-01-01",
            "password" => "admin123",
            "role" => "admin",
            "money" => "1000000"
        ]);

        User::create([
            "firstName" => "user",
            "lastName" => "user",
            "email" => "user@gmail.com",
            "contact" => "123456789",
            "address" => "Bina Nusantara University Bandung",
            "birthday" => "2000-01-01",
            "password" => "user123",
            "role" => "user",
            "money" => "1000000"
        ]);

        // ROLE -> tergantung email -> admin akan memiliki email admin@gmail.com

        // MONEY -> otomatis input 1 000 000

        // create categories
        Category::create([
            'name' => 'Boys'
        ]);
        Category::create([
            'name' => 'Girls'
        ]);
        Category::create([
            'name' => 'Unisex'
        ]);

        // create toys
        $category_id = Category::pluck('id');
        $category_id = $category_id->toArray();

        for ($i = 0; $i < 24; $i++) {
            $randomIndex = array_rand($category_id);
            Toy::create([
                'category_id' => $category_id[$randomIndex],
                'name' => fake()->word(),
                'description' => fake()->paragraph(3),
                'price' => fake()->numberBetween(100000, 500000),
                'stock' => fake()->numberBetween(0, 100)
            ]);
        }
    }
}
