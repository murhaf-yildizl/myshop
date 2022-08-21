<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'user_id'=>$this->faker->numberBetween(32,42),
          'product_id'=>$this->faker->numberBetween(1,120),
          'stars'=>$this->faker->numberBetween(1,5),
          'text'=>$this->faker->word()
            //
        ];
    }
}
