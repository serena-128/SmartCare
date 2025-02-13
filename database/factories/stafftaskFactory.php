<?php

namespace Database\Factories;

use App\Models\stafftask;
use Illuminate\Database\Eloquent\Factories\Factory;

class stafftaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = stafftask::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'staffmemberid' => $this->faker->randomDigitNotNull,
        'taskid' => $this->faker->randomDigitNotNull,
        'roleintask' => $this->faker->word,
        'startdate' => $this->faker->word,
        'enddate' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
