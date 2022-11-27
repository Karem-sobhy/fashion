<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $product_name = $this->faker->unique()->words($nb = 4, $asText = true);
        $slug = Str::slug($product_name);
        return [
            'name' => $product_name,
            'slug' => $slug,
            'desc' => $this->faker->text(500),
            'price' => $this->faker->numberBetween(30, 300),
            'stock_status' => 'instock',
            'quantity' =>  $this->faker->numberBetween(100, 200),
            'featured' =>  $this->faker->boolean(),
        ];
    }
}