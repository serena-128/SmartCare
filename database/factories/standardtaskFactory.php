<?php

namespace Database\Factories;

use App\Models\standardtask;
use Illuminate\Database\Eloquent\Factories\Factory;

class standardtaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = standardtask::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'assignedto' => $this->faker->randomDigitNotNull,
        'description' => $this->faker->word,
        'duedate' => $this->faker->word,
        'prioritylevel' => $this->faker->word,
        'completedby' => $this->faker->randomDigitNotNull,
        'completiondatetime' => $this->faker->date('Y-m-d H:i:s'),
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
