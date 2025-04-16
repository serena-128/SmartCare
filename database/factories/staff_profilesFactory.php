<?php

namespace Database\Factories;

use App\Models\staff_profiles;
use Illuminate\Database\Eloquent\Factories\Factory;

class staff_profilesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = staff_profiles::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->word,
        'firstname' => $this->faker->word,
        'lastname' => $this->faker->word,
        'email' => $this->faker->word,
        'phone' => $this->faker->word,
        'staff_role' => $this->faker->word,
        'profile_picture' => $this->faker->word,
        'bio' => $this->faker->text,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
