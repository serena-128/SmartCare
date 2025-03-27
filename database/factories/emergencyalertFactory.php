<?php

namespace Database\Factories;

use App\Models\emergencyalert;
use Illuminate\Database\Eloquent\Factories\Factory;

class emergencyalertFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = emergencyalert::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'residentid' => $this->faker->randomDigitNotNull,
        'triggeredbyid' => $this->faker->randomDigitNotNull,
        'alerttype' => $this->faker->word,
        'alerttimestamp' => $this->faker->date('Y-m-d H:i:s'),
        'status' => $this->faker->word,
        'resolvedbyid' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
