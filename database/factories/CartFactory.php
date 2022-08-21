<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'items'=>$this->faker->word(),
          'total'=>$this->faker->numberBetween(1000,5000),
          'date'=>$this->faker->date()
            //
        ];
    }
}
