<?php

namespace Tests;

use Database\Seeders\CategorySeeder;
use Database\Seeders\GymSeeder;
use Database\Seeders\LessonSeeder;
use Database\Seeders\SchedulerSeeder;
use Database\Seeders\TrainerSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();
        $this->prepareForTests();
    }

    private function prepareForTests()
    {
        Config::set('database.default', 'sqlite_testing');
        Config::set('app.env', 'testing');
        Artisan::call('migrate:fresh');
        $this->seed(CategorySeeder::class);
        $this->seed(GymSeeder::class);
        $this->seed(TrainerSeeder::class);
        $this->seed(LessonSeeder::class);
        $this->seed(SchedulerSeeder::class);
    }
}
