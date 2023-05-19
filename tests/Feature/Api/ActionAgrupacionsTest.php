<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Action;
use App\Models\Agrupacion;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActionAgrupacionsTest extends TestCase
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
    public function it_gets_action_agrupacions(): void
    {
        $action = Action::factory()->create();
        $agrupacion = Agrupacion::factory()->create();

        $action->agrupacions()->attach($agrupacion);

        $response = $this->getJson(
            route('api.actions.agrupacions.index', $action)
        );

        $response->assertOk()->assertSee($agrupacion->nombre);
    }

    /**
     * @test
     */
    public function it_can_attach_agrupacions_to_action(): void
    {
        $action = Action::factory()->create();
        $agrupacion = Agrupacion::factory()->create();

        $response = $this->postJson(
            route('api.actions.agrupacions.store', [$action, $agrupacion])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $action
                ->agrupacions()
                ->where('agrupacions.id', $agrupacion->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_agrupacions_from_action(): void
    {
        $action = Action::factory()->create();
        $agrupacion = Agrupacion::factory()->create();

        $response = $this->deleteJson(
            route('api.actions.agrupacions.store', [$action, $agrupacion])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $action
                ->agrupacions()
                ->where('agrupacions.id', $agrupacion->id)
                ->exists()
        );
    }
}
