<?php

namespace Database\Factories;

use App\Models\Scheduler;
use Illuminate\Database\Eloquent\Factories\Factory;

class SchedulerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Scheduler::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $additionalDays = rand(0,60);
        $time = rand(6,18);
        $startAt = now()
            ->addDays($additionalDays)
            ->startOfDay()
            ->addHours($time);
        $endAt = $startAt->clone()->addHours(rand(1,2));

        return [
            'start_at' => $startAt,
            'end_at' => $endAt,
            'lesson_id' => \App\Models\Lesson::query()->inRandomOrder()->first()->id
        ];
    }
}
