<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition(): array
    {
        return [
            'product_category_id' => $this->faker->numberBetween(1, 10),
            'name' => $this->faker->word(),    
            'description' => $this->faker->sentence(),
            'base_price' => $this->faker->randomFloat(2, 1, 100),
            'sale_price' => $this->faker->randomFloat(2, 1, 100),
            'is_new' => $this->faker->numberBetween(0, 1),
            'view' => $this->faker->numberBetween(0, 50),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
            
        ];
    }
}
