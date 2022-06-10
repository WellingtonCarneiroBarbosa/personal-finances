<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Workspace;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WorkspaceControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_workspaces()
    {
        $workspaces = Workspace::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('workspaces.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.workspaces.index')
            ->assertViewHas('workspaces');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_workspace()
    {
        $response = $this->get(route('workspaces.create'));

        $response->assertOk()->assertViewIs('app.workspaces.create');
    }

    /**
     * @test
     */
    public function it_stores_the_workspace()
    {
        $data = Workspace::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('workspaces.store'), $data);

        unset($data['user_id']);

        $this->assertDatabaseHas('workspaces', $data);

        $workspace = Workspace::latest('id')->first();

        $response->assertRedirect(route('workspaces.edit', $workspace));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_workspace()
    {
        $workspace = Workspace::factory()->create();

        $response = $this->get(route('workspaces.show', $workspace));

        $response
            ->assertOk()
            ->assertViewIs('app.workspaces.show')
            ->assertViewHas('workspace');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_workspace()
    {
        $workspace = Workspace::factory()->create();

        $response = $this->get(route('workspaces.edit', $workspace));

        $response
            ->assertOk()
            ->assertViewIs('app.workspaces.edit')
            ->assertViewHas('workspace');
    }

    /**
     * @test
     */
    public function it_updates_the_workspace()
    {
        $workspace = Workspace::factory()->create();

        $user = User::factory()->create();

        $data = [
            'name'    => $this->faker->name,
            'user_id' => $user->id,
        ];

        $response = $this->put(route('workspaces.update', $workspace), $data);

        unset($data['user_id']);

        $data['id'] = $workspace->id;

        $this->assertDatabaseHas('workspaces', $data);

        $response->assertRedirect(route('workspaces.edit', $workspace));
    }

    /**
     * @test
     */
    public function it_deletes_the_workspace()
    {
        $workspace = Workspace::factory()->create();

        $response = $this->delete(route('workspaces.destroy', $workspace));

        $response->assertRedirect(route('workspaces.index'));

        $this->assertModelMissing($workspace);
    }
}
