<?php

namespace Database\Factories;

use App\Models\role;
use Illuminate\Database\Eloquent\Factories\Factory;

class roleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = role::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'firstname' => $this->faker->word,
        'lastname' => $this->faker->word,
        'roletype' => $this->faker->word,
        'contactnumber' => $this->faker->word,
        'email' => $this->faker->word,
        'employmentstartdate' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
