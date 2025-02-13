<?php

namespace Database\Factories;

use App\Models\dietaryrestriction;
use Illuminate\Database\Eloquent\Factories\Factory;

class dietaryrestrictionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = dietaryrestriction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'residentid' => $this->faker->randomDigitNotNull,
        'foodrestrictions' => $this->faker->word,
        'foodpreferences' => $this->faker->word,
        'allergies' => $this->faker->word,
        'notes' => $this->faker->word,
        'lastupdatedby' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
