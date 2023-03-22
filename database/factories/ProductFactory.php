<?php

namespace Database\Factories;

use App\Models\Category;
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
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'price' => $this->faker->randomFloat(2, 0, 100),
            'sku' => $this->faker->randomFloat(2, 0, 100),
            'status'=> 'active',
            'category_id' => Category::all()->unique()->random()->id,
            'description' => $this->faker->sentence(15),
            'status'=> 'active',
        ];
    }
}
