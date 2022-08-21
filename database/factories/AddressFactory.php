<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'country' => $this->faker->country(),
          'state' => $this->faker->state(),
          'city' => $this->faker->city(),
          'street_name' => $this->faker->streetName(),
          'belding_no'=>$this->faker->secondaryAddress(),
          'post_code' => $this->faker->postCode(),


            //
        ];
    }
}
