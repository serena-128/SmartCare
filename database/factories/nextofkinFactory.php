<?php

namespace Database\Factories;

use App\Models\nextofkin;
use Illuminate\Database\Eloquent\Factories\Factory;

class nextofkinFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = nextofkin::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'residentid' => $this->faker->randomDigitNotNull,
        'firstname' => $this->faker->word,
        'lastname' => $this->faker->word,
        'relationshiptoresident' => $this->faker->word,
        'contactnumber' => $this->faker->word,
        'email' => $this->faker->word,
        'address' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
