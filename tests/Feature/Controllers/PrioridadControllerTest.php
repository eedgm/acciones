<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Prioridad;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PrioridadControllerTest extends TestCase
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
    public function it_displays_index_view_with_prioridads(): void
    {
        $prioridads = Prioridad::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('prioridads.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.prioridads.index')
            ->assertViewHas('prioridads');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_prioridad(): void
    {
        $response = $this->get(route('prioridads.create'));

        $response->assertOk()->assertViewIs('app.prioridads.create');
    }

    /**
     * @test
     */
    public function it_stores_the_prioridad(): void
    {
        $data = Prioridad::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('prioridads.store'), $data);

        $this->assertDatabaseHas('prioridads', $data);

        $prioridad = Prioridad::latest('id')->first();

        $response->assertRedirect(route('prioridads.edit', $prioridad));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_prioridad(): void
    {
        $prioridad = Prioridad::factory()->create();

        $response = $this->get(route('prioridads.show', $prioridad));

        $response
            ->assertOk()
            ->assertViewIs('app.prioridads.show')
            ->assertViewHas('prioridad');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_prioridad(): void
    {
        $prioridad = Prioridad::factory()->create();

        $response = $this->get(route('prioridads.edit', $prioridad));

        $response
            ->assertOk()
            ->assertViewIs('app.prioridads.edit')
            ->assertViewHas('prioridad');
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

        $response = $this->put(route('prioridads.update', $prioridad), $data);

        $data['id'] = $prioridad->id;

        $this->assertDatabaseHas('prioridads', $data);

        $response->assertRedirect(route('prioridads.edit', $prioridad));
    }

    /**
     * @test
     */
    public function it_deletes_the_prioridad(): void
    {
        $prioridad = Prioridad::factory()->create();

        $response = $this->delete(route('prioridads.destroy', $prioridad));

        $response->assertRedirect(route('prioridads.index'));

        $this->assertModelMissing($prioridad);
    }
}
