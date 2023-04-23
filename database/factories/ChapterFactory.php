<?php

namespace Database\Factories;

use App\Models\Learning;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Chapter>
 */
class chapterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(2),
            'description' => $this->faker->text,
            'file' => $this->faker->url,
            'url' => $this->faker->url,
            'learning_id' => Learning::all()->random()->id


        ];
    }
}
