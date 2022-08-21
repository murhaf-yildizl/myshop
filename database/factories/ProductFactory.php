<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'name'=>$this->faker->word(),
          'description'=>$this->faker->sentence(),
          'unit_id'=>$this->faker->numberBetween(1,108),
          'price'=>$this->faker->numberbetween(100,2000),
          'available'=>$this->faker->randomDigit(),
          'cat_id'=>$this->faker->numberbetween(1,25)
            //
        ];
    }
}
