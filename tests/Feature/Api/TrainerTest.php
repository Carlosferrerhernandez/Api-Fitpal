<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Trainer;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TrainerTest extends TestCase
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
    public function it_gets_trainers_list()
    {
        Trainer::truncate();
        $trainers = Trainer::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.trainers.index'));

        $response->assertOk()->assertSee($trainers[0]->first_name);
    }

    /**
     * @test
     */
    public function it_stores_the_trainer()
    {
        $data = Trainer::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.trainers.store'), $data);

        unset($data['full_name']);

        $this->assertDatabaseHas('trainers', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.trainers.update', $trainer),
            $data
        );

        $data['id'] = $trainer->id;

        $this->assertDatabaseHas('trainers', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_trainer()
    {
        $trainer = Trainer::factory()->create();

        $response = $this->deleteJson(route('api.trainers.destroy', $trainer));

        $this->assertModelMissing($trainer);

        $response->assertNoContent();
    }
}
