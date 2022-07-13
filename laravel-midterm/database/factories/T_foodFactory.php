<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\T_food>
 */
class T_foodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'price' =>rand(10,100),
            'old_price' => rand(10,100),
            'image' => $this->faker->image('public/images',640,480, null, false),
            'description' => $this->faker->name(),
            'category_id' =>rand(1,10),
        ];
    }
}
