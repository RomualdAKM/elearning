<?php

namespace Database\Factories;

use App\Models\Chapter;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quiz>
 */
class quizFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $options = [
            $this->faker->sentence(2),
            $this->faker->sentence(2),
            $this->faker->sentence(2),
        ];

        $responseIndex = $this->faker->numberBetween(0, 2);

        return [
            'question' => $this->faker->sentence(3),
            'option1' => $options[0],
            'option2' => $options[1],
            'option3' => $options[2],
            'response' => $options[$responseIndex],
            'chapter_id' => Chapter::all()->random()->id
        ];
    }
}
