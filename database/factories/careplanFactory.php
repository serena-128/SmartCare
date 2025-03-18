<?php

namespace Database\Factories;

use App\Models\careplan;
use Illuminate\Database\Eloquent\Factories\Factory;

class careplanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = careplan::class;

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
        'caregoals' => $this->faker->word,
        'caretreatment' => $this->faker->word,
        'notes' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
