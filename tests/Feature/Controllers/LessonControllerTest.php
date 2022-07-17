<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Lesson;

use App\Models\Gym;
use App\Models\Trainer;
use App\Models\Category;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LessonControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_lessons()
    {
        $lessons = Lesson::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('lessons.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.lessons.index')
            ->assertViewHas('lessons');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_lesson()
    {
        $response = $this->get(route('lessons.create'));

        $response->assertOk()->assertViewIs('app.lessons.create');
    }

    /**
     * @test
     */
    public function it_stores_the_lesson()
    {
        $data = Lesson::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('lessons.store'), $data);

        $this->assertDatabaseHas('lessons', $data);

        $lesson = Lesson::latest('id')->first();

        $response->assertRedirect(route('lessons.edit', $lesson));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_lesson()
    {
        $lesson = Lesson::factory()->create();

        $response = $this->get(route('lessons.show', $lesson));

        $response
            ->assertOk()
            ->assertViewIs('app.lessons.show')
            ->assertViewHas('lesson');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_lesson()
    {
        $lesson = Lesson::factory()->create();

        $response = $this->get(route('lessons.edit', $lesson));

        $response
            ->assertOk()
            ->assertViewIs('app.lessons.edit')
            ->assertViewHas('lesson');
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

        $response = $this->put(route('lessons.update', $lesson), $data);

        $data['id'] = $lesson->id;

        $this->assertDatabaseHas('lessons', $data);

        $response->assertRedirect(route('lessons.edit', $lesson));
    }

    /**
     * @test
     */
    public function it_deletes_the_lesson()
    {
        $lesson = Lesson::factory()->create();

        $response = $this->delete(route('lessons.destroy', $lesson));

        $response->assertRedirect(route('lessons.index'));

        $this->assertModelMissing($lesson);
    }
}
