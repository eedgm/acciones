<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Action;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActionUsersTest extends TestCase
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
    public function it_gets_action_users(): void
    {
        $action = Action::factory()->create();
        $user = User::factory()->create();

        $action->users()->attach($user);

        $response = $this->getJson(route('api.actions.users.index', $action));

        $response->assertOk()->assertSee($user->name);
    }

    /**
     * @test
     */
    public function it_can_attach_users_to_action(): void
    {
        $action = Action::factory()->create();
        $user = User::factory()->create();

        $response = $this->postJson(
            route('api.actions.users.store', [$action, $user])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $action
                ->users()
                ->where('users.id', $user->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_users_from_action(): void
    {
        $action = Action::factory()->create();
        $user = User::factory()->create();

        $response = $this->deleteJson(
            route('api.actions.users.store', [$action, $user])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $action
                ->users()
                ->where('users.id', $user->id)
                ->exists()
        );
    }
}
