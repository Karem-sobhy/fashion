<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create([
            'name' => 'Karem',
            'email' => 'admin@admin.com',
            'utype' => 'admin',
            'password' => Hash::make('123123'),
        ]);
        \App\Models\User::factory()->create([
            'name' => 'user',
            'email' => 'user@user.com',
            'password' => Hash::make('123123'),
        ]);
        // \App\Models\User::factory(10)->create();

        \App\Models\Category::factory()->create([
            'name' => 'Men',
            'slug' => Str::slug('men'),
        ]);
        \App\Models\Category::factory()->create([
            'name' => 'Women',
            'slug' => Str::slug('Women'),
        ]);
        \App\Models\Category::factory()->create([
            'name' => 'Kids',
            'slug' => Str::slug('Kids'),
        ]);
        \App\Models\Category::factory(3)->create();

        for ($i = 1; $i <= 10; $i++) {
            \App\Models\Product::factory()->create([
                'category_id' => 1,
                'image' => "men-$i.jpg"
            ]);
        }
        for ($i = 1; $i <= 10; $i++) {
            \App\Models\Product::factory()->create([
                'category_id' => 2,
                'image' => "women-$i.jpg"
            ]);
        }
        for ($i = 1; $i <= 10; $i++) {
            \App\Models\Product::factory()->create([
                'category_id' => 3,
                'image' => "kids-$i.jpg"
            ]);
        }
    }
}