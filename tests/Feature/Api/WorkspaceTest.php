<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Workspace\Workspace;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class WorkspaceTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_workspaces_list()
    {
        $workspaces = Workspace::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.workspaces.index'));

        $response->assertOk()->assertSee($workspaces[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_workspace()
    {
        $data = Workspace::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.workspaces.store'), $data);

        unset($data['user_id']);

        $this->assertDatabaseHas('workspaces', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.workspaces.update', $workspace),
            $data
        );

        unset($data['user_id']);

        $data['id'] = $workspace->id;

        $this->assertDatabaseHas('workspaces', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_workspace()
    {
        $workspace = Workspace::factory()->create();

        $response = $this->deleteJson(
            route('api.workspaces.destroy', $workspace)
        );

        $this->assertModelMissing($workspace);

        $response->assertNoContent();
    }
}
