<?php

namespace Database\Factories;

use App\Models\diagnosis;
use Illuminate\Database\Eloquent\Factories\Factory;

class diagnosisFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = diagnosis::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'residentid' => $this->faker->randomDigitNotNull,
        'diagnosis' => $this->faker->word,
        'vitalsigns' => $this->faker->word,
        'treatment' => $this->faker->word,
        'testresults' => $this->faker->word,
        'notes' => $this->faker->word,
        'lastupdatedby' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
