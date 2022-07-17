<?php

namespace Database\Seeders;

use App\Models\Gym;
use Illuminate\Database\Seeder;

class GymSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gyms = collect([
            'Sanson',
            'Hércules',
            'Great Force',
        ]);

        $gyms->each(fn ($gym) => Gym::factory()->create(['name' => $gym]));
    }
}
