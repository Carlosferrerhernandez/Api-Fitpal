<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Lesson;
use App\Models\Trainer;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TrainerLessonsTest extends TestCase
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
    public function it_gets_trainer_lessons()
    {
        $trainer = Trainer::factory()->create();
        $lessons = Lesson::factory()
            ->count(2)
            ->create([
                'trainer_id' => $trainer->id,
            ]);

        $response = $this->getJson(
            route('api.trainers.lessons.index', $trainer)
        );

        $response->assertOk()->assertSee($lessons[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_trainer_lessons()
    {
        $trainer = Trainer::factory()->create();
        $data = Lesson::factory()
            ->make([
                'trainer_id' => $trainer->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.trainers.lessons.store', $trainer),
            $data
        );

        $this->assertDatabaseHas('lessons', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $lesson = Lesson::latest('id')->first();

        $this->assertEquals($trainer->id, $lesson->trainer_id);
    }
}
