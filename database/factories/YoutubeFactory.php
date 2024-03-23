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
            'video' => $this->faker->word(),
            'title' => $this->faker->sentence(4),
            'resolution' => $this->faker->word(),
            'aspect_ratio' => $this->faker->word(),
            'filesize_approx' => $this->faker->word(),
            'like_count' => $this->faker->word(),
            'channel' => $this->faker->word(),
            'channel_follower_count' => $this->faker->word(),
            'channel_is_verified' => $this->faker->word(),
            'uploader' => $this->faker->word(),
            'uploader_id' => $this->faker->word(),
            'uploader_url' => $this->faker->word(),
            'upload_date' => $this->faker->dateTime(),
            'availability' => $this->faker->word(),
            'duration_string' => $this->faker->word(),
            'is_live' => $this->faker->word(),
            'epoch' => $this->faker->word(),
            'asr' => $this->faker->word(),
            'format_id' => $this->faker->word(),
            'format_note' => $this->faker->word(),
            'source_preference' => $this->faker->word(),
            'audio_channels' => $this->faker->word(),
            'height' => $this->faker->word(),
            'width' => $this->faker->word(),
            'quality' => $this->faker->word(),
            'has_drm' => $this->faker->word(),
            'language' => $this->faker->word(),
            'extension' => $this->faker->word(),
            'vcodec' => $this->faker->word(),
            'acodec' => $this->faker->word(),
            'dynamic_range' => $this->faker->word(),
        ];
    }
}
