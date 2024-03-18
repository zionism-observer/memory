<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Source;
use App\Models\WebPage;

class WebpageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WebPage::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'source_id' => Source::factory(),
            'body' => $this->faker->text(),
            'headers' => '{}',
            'status' => $this->faker->randomNumber(),
        ];
    }
}
