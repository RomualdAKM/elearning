<?php

namespace Database\Factories;

use App\Models\level;
use App\Models\category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "name" => $this->faker->name,
            "file" => $this->faker->url,
            "description" => $this->faker->text,
            "image" => $this->faker->imageUrl,
            "level_id" => level::all()->random()->id,
            "category_id" => category::all()->random()->id
        ];
    }
}
