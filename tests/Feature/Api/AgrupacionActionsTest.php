<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Action;
use App\Models\Agrupacion;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AgrupacionActionsTest extends TestCase
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
    public function it_gets_agrupacion_actions(): void
    {
        $agrupacion = Agrupacion::factory()->create();
        $action = Action::factory()->create();

        $agrupacion->actions()->attach($action);

        $response = $this->getJson(
            route('api.agrupacions.actions.index', $agrupacion)
        );

        $response->assertOk()->assertSee($action->numero);
    }

    /**
     * @test
     */
    public function it_can_attach_actions_to_agrupacion(): void
    {
        $agrupacion = Agrupacion::factory()->create();
        $action = Action::factory()->create();

        $response = $this->postJson(
            route('api.agrupacions.actions.store', [$agrupacion, $action])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $agrupacion
                ->actions()
                ->where('actions.id', $action->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_actions_from_agrupacion(): void
    {
        $agrupacion = Agrupacion::factory()->create();
        $action = Action::factory()->create();

        $response = $this->deleteJson(
            route('api.agrupacions.actions.store', [$agrupacion, $action])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $agrupacion
                ->actions()
                ->where('actions.id', $action->id)
                ->exists()
        );
    }
}
