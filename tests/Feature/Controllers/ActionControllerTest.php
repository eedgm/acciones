<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Action;

use App\Models\Statu;
use App\Models\Prioridad;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActionControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_actions(): void
    {
        $actions = Action::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('actions.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.actions.index')
            ->assertViewHas('actions');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_action(): void
    {
        $response = $this->get(route('actions.create'));

        $response->assertOk()->assertViewIs('app.actions.create');
    }

    /**
     * @test
     */
    public function it_stores_the_action(): void
    {
        $data = Action::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('actions.store'), $data);

        $this->assertDatabaseHas('actions', $data);

        $action = Action::latest('id')->first();

        $response->assertRedirect(route('actions.edit', $action));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_action(): void
    {
        $action = Action::factory()->create();

        $response = $this->get(route('actions.show', $action));

        $response
            ->assertOk()
            ->assertViewIs('app.actions.show')
            ->assertViewHas('action');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_action(): void
    {
        $action = Action::factory()->create();

        $response = $this->get(route('actions.edit', $action));

        $response
            ->assertOk()
            ->assertViewIs('app.actions.edit')
            ->assertViewHas('action');
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

        $response = $this->put(route('actions.update', $action), $data);

        $data['id'] = $action->id;

        $this->assertDatabaseHas('actions', $data);

        $response->assertRedirect(route('actions.edit', $action));
    }

    /**
     * @test
     */
    public function it_deletes_the_action(): void
    {
        $action = Action::factory()->create();

        $response = $this->delete(route('actions.destroy', $action));

        $response->assertRedirect(route('actions.index'));

        $this->assertSoftDeleted($action);
    }
}
