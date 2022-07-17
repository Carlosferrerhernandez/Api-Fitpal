<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Trainer;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TrainerControllerTest extends TestCase
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
    public function it_displays_index_view_with_trainers()
    {
        $trainers = Trainer::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('trainers.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.trainers.index')
            ->assertViewHas('trainers');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_trainer()
    {
        $response = $this->get(route('trainers.create'));

        $response->assertOk()->assertViewIs('app.trainers.create');
    }

    /**
     * @test
     */
    public function it_stores_the_trainer()
    {
        $data = Trainer::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('trainers.store'), $data);

        unset($data['full_name']);

        $this->assertDatabaseHas('trainers', $data);

        $trainer = Trainer::latest('id')->first();

        $response->assertRedirect(route('trainers.edit', $trainer));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_trainer()
    {
        $trainer = Trainer::factory()->create();

        $response = $this->get(route('trainers.show', $trainer));

        $response
            ->assertOk()
            ->assertViewIs('app.trainers.show')
            ->assertViewHas('trainer');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_trainer()
    {
        $trainer = Trainer::factory()->create();

        $response = $this->get(route('trainers.edit', $trainer));

        $response
            ->assertOk()
            ->assertViewIs('app.trainers.edit')
            ->assertViewHas('trainer');
    }

    /**
     * @test
     */
    public function it_updates_the_trainer()
    {
        $trainer = Trainer::factory()->create();

        $data = [
            'first_name' => $this->faker->name,
            'last_name' => $this->faker->lastName,
            'phone' => $this->faker->phoneNumber,
        ];

        $response = $this->put(route('trainers.update', $trainer), $data);

        $data['id'] = $trainer->id;

        $this->assertDatabaseHas('trainers', $data);

        $response->assertRedirect(route('trainers.edit', $trainer));
    }

    /**
     * @test
     */
    public function it_deletes_the_trainer()
    {
        $trainer = Trainer::factory()->create();

        $response = $this->delete(route('trainers.destroy', $trainer));

        $response->assertRedirect(route('trainers.index'));

        $this->assertModelMissing($trainer);
    }
}
