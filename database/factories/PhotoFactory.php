<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Photo>
 */
class PhotoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $array = ['App\Models\Category', 'App\Models\Product'];
        $model = $this->faker->randomElement($array);
        return [
            'photoable_type' => $model,
            'photoable_id' => $this->faker->numberBetween(1, 10),
            'type'         => "photo",
            'src'          => $this->faker->imageUrl(),
        ];
    }
}
