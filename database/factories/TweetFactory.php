<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Source;
use App\Models\Tweet;

class TweetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tweet::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'body' => $this->faker->text(),
            'source_id' => Source::factory(),
            'created_timestamp' => $this->faker->randomNumber(),
            'lang' => $this->faker->word(),
            'views' => $this->faker->randomNumber(),
            'client' => $this->faker->word(),
            'twitter_id' => $this->faker->word(),
            'likes' => $this->faker->randomNumber(),
            'retweets' => $this->faker->randomNumber(),
            'replies' => $this->faker->randomNumber(),
            'twitter_created_at' => $this->faker->word(),
        ];
    }
}
