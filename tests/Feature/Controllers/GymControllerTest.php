<?php

namespace Tests\Feature\Controllers;

use App\Models\Gym;
use App\Models\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GymControllerTest extends TestCase
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
    public function it_displays_index_view_with_gyms()
    {
        $gyms = Gym::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('gyms.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.gyms.index')
            ->assertViewHas('gyms');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_gym()
    {
        $response = $this->get(route('gyms.create'));

        $response->assertOk()->assertViewIs('app.gyms.create');
    }

    /**
     * @test
     */
    public function it_stores_the_gym()
    {
        $data = Gym::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('gyms.store'), $data);

        $this->assertDatabaseHas('gyms', $data);

        $gym = Gym::latest('id')->first();

        $response->assertRedirect(route('gyms.edit', $gym));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_gym()
    {
        $gym = Gym::factory()->create();

        $response = $this->get(route('gyms.show', $gym));

        $response
            ->assertOk()
            ->assertViewIs('app.gyms.show')
            ->assertViewHas('gym');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_gym()
    {
        $gym = Gym::factory()->create();

        $response = $this->get(route('gyms.edit', $gym));

        $response
            ->assertOk()
            ->assertViewIs('app.gyms.edit')
            ->assertViewHas('gym');
    }

    /**
     * @test
     */
    public function it_updates_the_gym()
    {
        $gym = Gym::factory()->create();

        $data = [
            'name' => $this->faker->name,
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
        ];

        $response = $this->put(route('gyms.update', $gym), $data);

        $data['id'] = $gym->id;

        $this->assertDatabaseHas('gyms', $data);

        $response->assertRedirect(route('gyms.edit', $gym));
    }

    /**
     * @test
     */
    public function it_deletes_the_gym()
    {
        $gym = Gym::factory()->create();

        $response = $this->delete(route('gyms.destroy', $gym));

        $response->assertRedirect(route('gyms.index'));

        $this->assertModelMissing($gym);
    }
}
