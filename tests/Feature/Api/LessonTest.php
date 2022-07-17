<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Lesson;

use App\Models\Gym;
use App\Models\Trainer;
use App\Models\Category;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LessonTest extends TestCase
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
    public function it_gets_lessons_list()
    {
        Lesson::truncate();
        $lessons = Lesson::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.lessons.index'));

        $response->assertOk()->assertSee($lessons[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_lesson()
    {
        $data = Lesson::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.lessons.store'), $data);

        $this->assertDatabaseHas('lessons', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_lesson()
    {
        $lesson = Lesson::factory()->create();

        $gym = Gym::factory()->create();
        $category = Category::factory()->create();
        $trainer = Trainer::factory()->create();

        $data = [
            'limit' => $this->faker->randomNumber(0),
            'type' => 'on-site',
            'gym_id' => $gym->id,
            'category_id' => $category->id,
            'trainer_id' => $trainer->id,
        ];

        $response = $this->putJson(route('api.lessons.update', $lesson), $data);

        $data['id'] = $lesson->id;

        $this->assertDatabaseHas('lessons', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_lesson()
    {
        $lesson = Lesson::factory()->create();

        $response = $this->deleteJson(route('api.lessons.destroy', $lesson));

        $this->assertModelMissing($lesson);

        $response->assertNoContent();
    }
}
