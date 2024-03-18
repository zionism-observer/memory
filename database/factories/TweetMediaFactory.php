<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Source;
use App\Models\Tweet;
use App\Models\TweetMedia;

class TweetMediaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TweetMedia::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'source_id' => Source::factory(),
            'tweet_id' => Tweet::factory(),
            'type' => $this->faker->word(),
            'url' => $this->faker->url(),
            'thumbnail_url' => $this->faker->word(),
            'duration' => $this->faker->randomFloat(0, 0, 9999999999.),
            'format' => $this->faker->word(),
            'width' => $this->faker->randomNumber(),
            'height' => $this->faker->randomNumber(),
            'alt_text' => $this->faker->word(),
        ];
    }
}
