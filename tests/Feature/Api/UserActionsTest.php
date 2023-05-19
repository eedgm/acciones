<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Action;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserActionsTest extends TestCase
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
    public function it_gets_user_actions(): void
    {
        $user = User::factory()->create();
        $action = Action::factory()->create();

        $user->actions()->attach($action);

        $response = $this->getJson(route('api.users.actions.index', $user));

        $response->assertOk()->assertSee($action->numero);
    }

    /**
     * @test
     */
    public function it_can_attach_actions_to_user(): void
    {
        $user = User::factory()->create();
        $action = Action::factory()->create();

        $response = $this->postJson(
            route('api.users.actions.store', [$user, $action])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $user
                ->actions()
                ->where('actions.id', $action->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_actions_from_user(): void
    {
        $user = User::factory()->create();
        $action = Action::factory()->create();

        $response = $this->deleteJson(
            route('api.users.actions.store', [$user, $action])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $user
                ->actions()
                ->where('actions.id', $action->id)
                ->exists()
        );
    }
}
