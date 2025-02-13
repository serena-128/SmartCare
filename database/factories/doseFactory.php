<?php

namespace Database\Factories;

use App\Models\dose;
use Illuminate\Database\Eloquent\Factories\Factory;

class doseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = dose::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'residentid' => $this->faker->randomDigitNotNull,
        'name' => $this->faker->word,
        'dosage' => $this->faker->word,
        'frequency' => $this->faker->word,
        'startdate' => $this->faker->word,
        'enddate' => $this->faker->word,
        'prescribedby' => $this->faker->randomDigitNotNull,
        'notes' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
