<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'user_id'=>$this->faker->numberBetween(1,21),
          'cart_id'=>$this->faker->unique()->numberBetween(1,100),
            //
        ];
    }
}
