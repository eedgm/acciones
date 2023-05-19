<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Agrupacion;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AgrupacionControllerTest extends TestCase
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
    public function it_displays_index_view_with_agrupacions(): void
    {
        $agrupacions = Agrupacion::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('agrupacions.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.agrupacions.index')
            ->assertViewHas('agrupacions');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_agrupacion(): void
    {
        $response = $this->get(route('agrupacions.create'));

        $response->assertOk()->assertViewIs('app.agrupacions.create');
    }

    /**
     * @test
     */
    public function it_stores_the_agrupacion(): void
    {
        $data = Agrupacion::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('agrupacions.store'), $data);

        $this->assertDatabaseHas('agrupacions', $data);

        $agrupacion = Agrupacion::latest('id')->first();

        $response->assertRedirect(route('agrupacions.edit', $agrupacion));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_agrupacion(): void
    {
        $agrupacion = Agrupacion::factory()->create();

        $response = $this->get(route('agrupacions.show', $agrupacion));

        $response
            ->assertOk()
            ->assertViewIs('app.agrupacions.show')
            ->assertViewHas('agrupacion');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_agrupacion(): void
    {
        $agrupacion = Agrupacion::factory()->create();

        $response = $this->get(route('agrupacions.edit', $agrupacion));

        $response
            ->assertOk()
            ->assertViewIs('app.agrupacions.edit')
            ->assertViewHas('agrupacion');
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

        $response = $this->put(route('agrupacions.update', $agrupacion), $data);

        $data['id'] = $agrupacion->id;

        $this->assertDatabaseHas('agrupacions', $data);

        $response->assertRedirect(route('agrupacions.edit', $agrupacion));
    }

    /**
     * @test
     */
    public function it_deletes_the_agrupacion(): void
    {
        $agrupacion = Agrupacion::factory()->create();

        $response = $this->delete(route('agrupacions.destroy', $agrupacion));

        $response->assertRedirect(route('agrupacions.index'));

        $this->assertSoftDeleted($agrupacion);
    }
}
