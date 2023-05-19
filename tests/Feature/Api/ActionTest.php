<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Action;

use App\Models\Statu;
use App\Models\Prioridad;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActionTest extends TestCase
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
    public function it_gets_actions_list(): void
    {
        $actions = Action::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.actions.index'));

        $response->assertOk()->assertSee($actions[0]->numero);
    }

    /**
     * @test
     */
    public function it_stores_the_action(): void
    {
        $data = Action::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.actions.store'), $data);

        $this->assertDatabaseHas('actions', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_action(): void
    {
        $action = Action::factory()->create();

        $statu = Statu::factory()->create();
        $prioridad = Prioridad::factory()->create();

        $data = [
            'numero' => $this->faker->text(255),
            'accion' => $this->faker->text(255),
            'descripcion' => $this->faker->text(),
            'fecha' => $this->faker->date(),
            'statu_id' => $statu->id,
            'prioridad_id' => $prioridad->id,
        ];

        $response = $this->putJson(route('api.actions.update', $action), $data);

        $data['id'] = $action->id;

        $this->assertDatabaseHas('actions', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_action(): void
    {
        $action = Action::factory()->create();

        $response = $this->deleteJson(route('api.actions.destroy', $action));

        $this->assertSoftDeleted($action);

        $response->assertNoContent();
    }
}
