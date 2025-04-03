<?php

namespace Database\Factories;

use App\Models\schedule;
use Illuminate\Database\Eloquent\Factories\Factory;

class scheduleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = schedule::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'roleid' => $this->faker->randomDigitNotNull,
        'staffmemberid' => $this->faker->randomDigitNotNull,
        'shiftdate' => $this->faker->word,
        'starttime' => $this->faker->word,
        'endtime' => $this->faker->word,
        'shifttype' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s'),
        'requested_shift_id' => $this->faker->randomDigitNotNull,
        'shift_status' => $this->faker->word,
        'request_reason' => $this->faker->text,
        'approved_by' => $this->faker->randomDigitNotNull
        ];
    }
}
