<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Action;
use App\Models\Prioridad;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PrioridadActionsTest extends TestCase
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
    public function it_gets_prioridad_actions(): void
    {
        $prioridad = Prioridad::factory()->create();
        $actions = Action::factory()
            ->count(2)
            ->create([
                'prioridad_id' => $prioridad->id,
            ]);

        $response = $this->getJson(
            route('api.prioridads.actions.index', $prioridad)
        );

        $response->assertOk()->assertSee($actions[0]->numero);
    }

    /**
     * @test
     */
    public function it_stores_the_prioridad_actions(): void
    {
        $prioridad = Prioridad::factory()->create();
        $data = Action::factory()
            ->make([
                'prioridad_id' => $prioridad->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.prioridads.actions.store', $prioridad),
            $data
        );

        $this->assertDatabaseHas('actions', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $action = Action::latest('id')->first();

        $this->assertEquals($prioridad->id, $action->prioridad_id);
    }
}
