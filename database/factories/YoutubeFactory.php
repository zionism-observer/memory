<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Youtube;

class YoutubeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Youtube::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'source_id' => $this->faker->word(),
            'youtube_id' => $this->faker->word(),
            'video' => $this->faker->word(),
            'title' => $this->faker->sentence(4),
            'extension' => $this->faker->word(),
            'uploader' => $this->faker->word(),
            'uploader_url' => $this->faker->word(),
            'upload_date' => $this->faker->dateTime(),
            'uploader_id' => $this->faker->word(),
            'channel' => $this->faker->word(),
            'channel_id' => $this->faker->word(),
            'channel_url' => $this->faker->word(),
            'channel_follower_count' => $this->faker->word(),
            'duration' => $this->faker->randomFloat(0, 0, 9999999999.),
            'view_count' => $this->faker->word(),
            'like_count' => $this->faker->word(),
            'comment_count' => $this->faker->word(),
            'age_limit' => $this->faker->word(),
            'is_live' => $this->faker->word(),
            'format' => $this->faker->word(),
            'format_id' => $this->faker->word(),
            'format_note' => $this->faker->word(),
            'width' => $this->faker->word(),
            'height' => $this->faker->word(),
            'resolution' => $this->faker->word(),
            'tbr' => $this->faker->randomFloat(0, 0, 9999999999.),
            'abr' => $this->faker->randomFloat(0, 0, 9999999999.),
            'acodec' => $this->faker->word(),
            'asr' => $this->faker->word(),
            'vbr' => $this->faker->word(),
            'fps' => $this->faker->randomFloat(0, 0, 9999999999.),
            'vcodec' => $this->faker->word(),
            'container' => $this->faker->word(),
            'filesize' => $this->faker->word(),
            'filesize_approx' => $this->faker->word(),
            'protocol' => $this->faker->word(),
            'epoch' => $this->faker->word(),
            'description' => $this->faker->text(),
            'stretched_ratio' => $this->faker->randomFloat(0, 0, 9999999999.),
            'thumbnail' => $this->faker->word(),
            'quality' => $this->faker->word(),
        ];
    }
}
