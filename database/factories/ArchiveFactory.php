<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Archive;
use App\Models\ArchiveService;
use App\Models\Source;

class ArchiveFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Archive::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'source_id' => Source::factory(),
            'archive_service_id' => ArchiveService::factory(),
            'url' => $this->faker->url(),
        ];
    }
}
