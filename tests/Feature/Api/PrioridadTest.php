<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Prioridad;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PrioridadTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_prioridads_list(): void
    {
        $prioridads = Prioridad::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.prioridads.index'));

        $response->assertOk()->assertSee($prioridads[0]->nombre);
    }

    /**
     * @test
     */
    public function it_stores_the_prioridad(): void
    {
        $data = Prioridad::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.prioridads.store'), $data);

        $this->assertDatabaseHas('prioridads', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_prioridad(): void
    {
        $prioridad = Prioridad::factory()->create();

        $data = [
            'nombre' => $this->faker->name(),
            'color' => $this->faker->hexcolor(),
        ];

        $response = $this->putJson(
            route('api.prioridads.update', $prioridad),
            $data
        );

        $data['id'] = $prioridad->id;

        $this->assertDatabaseHas('prioridads', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_prioridad(): void
    {
        $prioridad = Prioridad::factory()->create();

        $response = $this->deleteJson(
            route('api.prioridads.destroy', $prioridad)
        );

        $this->assertModelMissing($prioridad);

        $response->assertNoContent();
    }
}
