<?php

namespace Database\Factories;

use App\Models\Lesson;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class LessonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Lesson::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'limit' => rand(10, 45),
            'type' => Arr::random(['on-site', 'on-line']),
            'gym_id' => \App\Models\Gym::query()->inRandomOrder()->first()->id,
            'category_id' => \App\Models\Category::query()->inRandomOrder()->first()->id,
            'trainer_id' => \App\Models\Trainer::query()->inRandomOrder()->first()->id,
        ];
    }
}
