<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContactSupportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'title'=>$this->faker->word(),
          'content'=>$this->faker->sentence(),
          'user_id'=>$this->faker->numberBetween(1,21),
          'support_id'=>$this->faker->numberBetween(1,4),
          'order_id'=>$this->faker->unique()->numberBetween(1,20),
          'status'=>$this->faker->randomElement(['pending...','waiting','refused','solved'])

            //
        ];
    }
}
