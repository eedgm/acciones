<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Statu;
use App\Models\Action;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StatuActionsTest extends TestCase
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
    public function it_gets_statu_actions(): void
    {
        $statu = Statu::factory()->create();
        $actions = Action::factory()
            ->count(2)
            ->create([
                'statu_id' => $statu->id,
            ]);

        $response = $this->getJson(route('api.status.actions.index', $statu));

        $response->assertOk()->assertSee($actions[0]->numero);
    }

    /**
     * @test
     */
    public function it_stores_the_statu_actions(): void
    {
        $statu = Statu::factory()->create();
        $data = Action::factory()
            ->make([
                'statu_id' => $statu->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.status.actions.store', $statu),
            $data
        );

        $this->assertDatabaseHas('actions', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $action = Action::latest('id')->first();

        $this->assertEquals($statu->id, $action->statu_id);
    }
}
