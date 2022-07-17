<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@admin.com',
                'password' => \Hash::make('admin'),
            ]);

        $this->call(CategorySeeder::class);
        $this->call(GymSeeder::class);
        $this->call(TrainerSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(LessonSeeder::class);
        $this->call(SchedulerSeeder::class);
    }
}
