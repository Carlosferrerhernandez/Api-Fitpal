<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Lesson;
use App\Models\Scheduler;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LessonSchedulersTest extends TestCase
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
    public function it_gets_lesson_schedulers()
    {
        $lesson = Lesson::factory()->create();
        $schedulers = Scheduler::factory()
            ->count(2)
            ->create([
                'lesson_id' => $lesson->id,
            ]);

        $response = $this->getJson(
            route('api.lessons.schedulers.index', $lesson)
        );

        $response->assertOk()->assertSee($schedulers[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_lesson_schedulers()
    {
        $lesson = Lesson::factory()->create();
        $data = Scheduler::factory()
            ->make([
                'lesson_id' => $lesson->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.lessons.schedulers.store', $lesson),
            $data
        );

        unset($data['lesson_id']);

        // $this->assertDatabaseHas('schedulers', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $scheduler = Scheduler::latest('id')->first();

        $this->assertEquals($lesson->id, $scheduler->lesson_id);
    }
}
