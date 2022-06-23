<?php

namespace Database\Factories;

use App\Models\Channel;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Video>
 */
class VideoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [

            'channel_id' => Channel::factory(),

            'views' => $this->faker->numberBetween(1, 1000),

            'thumbnail' => $this->faker->imageUrl(),

            'percentage' => 100,

            'title' => $this->faker->sentence(4),

            'description' => $this->faker->sentence(10),

            'path' => $this->faker->word()
        ];
    }
}
