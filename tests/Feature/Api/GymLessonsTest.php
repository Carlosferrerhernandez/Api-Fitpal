<?php

namespace Tests\Feature\Api;

use App\Models\Gym;
use App\Models\User;
use App\Models\Lesson;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GymLessonsTest extends TestCase
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
    public function it_gets_gym_lessons()
    {
        $gym = Gym::factory()->create();
        $lessons = Lesson::factory()
            ->count(2)
            ->create([
                'gym_id' => $gym->id,
            ]);

        $response = $this->getJson(route('api.gyms.lessons.index', $gym));

        $response->assertOk()->assertSee($lessons[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_gym_lessons()
    {
        $gym = Gym::factory()->create();
        $data = Lesson::factory()
            ->make([
                'gym_id' => $gym->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.gyms.lessons.store', $gym),
            $data
        );

        $this->assertDatabaseHas('lessons', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $lesson = Lesson::latest('id')->first();

        $this->assertEquals($gym->id, $lesson->gym_id);
    }
}
