<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Agrupacion;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AgrupacionTest extends TestCase
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
    public function it_gets_agrupacions_list(): void
    {
        $agrupacions = Agrupacion::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.agrupacions.index'));

        $response->assertOk()->assertSee($agrupacions[0]->nombre);
    }

    /**
     * @test
     */
    public function it_stores_the_agrupacion(): void
    {
        $data = Agrupacion::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.agrupacions.store'), $data);

        $this->assertDatabaseHas('agrupacions', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_agrupacion(): void
    {
        $agrupacion = Agrupacion::factory()->create();

        $data = [
            'nombre' => $this->faker->text(),
        ];

        $response = $this->putJson(
            route('api.agrupacions.update', $agrupacion),
            $data
        );

        $data['id'] = $agrupacion->id;

        $this->assertDatabaseHas('agrupacions', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_agrupacion(): void
    {
        $agrupacion = Agrupacion::factory()->create();

        $response = $this->deleteJson(
            route('api.agrupacions.destroy', $agrupacion)
        );

        $this->assertSoftDeleted($agrupacion);

        $response->assertNoContent();
    }
}
