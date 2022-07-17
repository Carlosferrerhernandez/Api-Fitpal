<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = collect([
            'Body Combat',
            'Body Pump',
            'Spinning',
            'Yoga',
            'Xcore',
            'Zumba',
        ]);

        $categories->each(fn ($category) => Category::factory()->create([ 'name' => $category]));
    }
}
