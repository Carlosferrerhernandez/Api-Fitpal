<?php

namespace Tests\Feature\Api;

use App\Models\Gym;
use App\Models\User;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GymTest extends TestCase
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
    public function it_gets_gyms_list()
    {
        $gyms = Gym::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.gyms.index'));

        $response->assertOk()->assertSee($gyms[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_gym()
    {
        $data = Gym::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.gyms.store'), $data);

        $this->assertDatabaseHas('gyms', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(route('api.gyms.update', $gym), $data);

        $data['id'] = $gym->id;

        $this->assertDatabaseHas('gyms', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_gym()
    {
        $gym = Gym::factory()->create();

        $response = $this->deleteJson(route('api.gyms.destroy', $gym));

        $this->assertModelMissing($gym);

        $response->assertNoContent();
    }
}
