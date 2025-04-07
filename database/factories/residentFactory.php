<?php

namespace Database\Factories;

use App\Models\resident;
use Illuminate\Database\Eloquent\Factories\Factory;

class residentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = resident::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'firstname' => $this->faker->word,
        'lastname' => $this->faker->word,
        'dateofbirth' => $this->faker->word,
        'gender' => $this->faker->word,
        'roomnumber' => $this->faker->randomDigitNotNull,
        'admissiondate' => $this->faker->word
        ];
    }
}
