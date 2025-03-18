<?php

namespace Database\Factories;

use App\Models\medication_reminders;
use Illuminate\Database\Eloquent\Factories\Factory;

class medication_remindersFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = medication_reminders::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'resident_id' => $this->faker->randomDigitNotNull,
        'staffmember_id' => $this->faker->randomDigitNotNull,
        'medication_name' => $this->faker->word,
        'dosage' => $this->faker->word,
        'frequency' => $this->faker->word,
        'time_for_administration' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
