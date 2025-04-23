<?php

namespace Database\Factories;

use App\Models\feedback;
use Illuminate\Database\Eloquent\Factories\Factory;

class feedbackFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = feedback::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'staff_id' => $this->faker->randomDigitNotNull,
        'category' => $this->faker->word,
        'subject' => $this->faker->word,
        'message' => $this->faker->text,
        'rating' => $this->faker->word,
        'attachment' => $this->faker->word,
        'is_anonymous' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
