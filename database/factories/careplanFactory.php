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
        'roleid' => $this->faker->randomDigitNotNull,
        'medical_history' => $this->faker->text,
        'medications' => $this->faker->text,
        'dietary_preferences' => $this->faker->text,
        'treatments' => $this->faker->text,
        'preferences' => $this->faker->text,
        'caregoals' => $this->faker->text,
        'caretreatment' => $this->faker->text,
        'notes' => $this->faker->text,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
