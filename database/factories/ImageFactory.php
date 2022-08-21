<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'url'=>$this->faker->url,
          'product_id'=>$this->faker->numberBetween(1,50),
          'title'=>$this->faker->word(),
            //
        ];
    }
}
