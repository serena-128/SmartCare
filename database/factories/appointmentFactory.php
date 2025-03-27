<?php

namespace Database\Factories;

use App\Models\appointment;
use Illuminate\Database\Eloquent\Factories\Factory;

class appointmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = appointment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'residentid' => $this->faker->randomDigitNotNull,
        'staffmemberid' => $this->faker->randomDigitNotNull,
        'date' => $this->faker->word,
        'time' => $this->faker->word,
        'reason' => $this->faker->word,
        'location' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
