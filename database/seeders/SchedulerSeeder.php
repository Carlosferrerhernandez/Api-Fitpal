<?php

namespace Database\Seeders;

use App\Models\Lesson;
use App\Models\Scheduler;
use Illuminate\Database\Seeder;

class SchedulerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lessons = Lesson::query()->select('id')->get();

        $lessons->each(function ($lesson) {
            $schedulers = rand(6, 12);
            Scheduler::factory()
                ->count($schedulers)
                ->create([
                    'lesson_id' => $lesson->id
                ]);
        });
    }
}
