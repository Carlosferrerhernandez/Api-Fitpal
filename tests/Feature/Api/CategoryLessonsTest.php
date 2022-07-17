<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Lesson;
use App\Models\Category;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryLessonsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_category_lessons()
    {
        $category = Category::factory()->create();
        $lessons = Lesson::factory()
            ->count(2)
            ->create([
                'category_id' => $category->id,
            ]);

        $response = $this->getJson(
            route('api.categories.lessons.index', $category)
        );

        $response->assertOk()->assertSee($lessons[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_category_lessons()
    {
        $category = Category::factory()->create();
        $data = Lesson::factory()
            ->make([
                'category_id' => $category->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.categories.lessons.store', $category),
            $data
        );

        $this->assertDatabaseHas('lessons', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $lesson = Lesson::latest('id')->first();

        $this->assertEquals($category->id, $lesson->category_id);
    }
}
