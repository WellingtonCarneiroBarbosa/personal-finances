<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Workspace;
use App\Models\WorkspaceUser;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class WorkspaceWorkspaceUsersTest extends TestCase
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
    public function it_gets_workspace_workspace_users()
    {
        $workspace      = Workspace::factory()->create();
        $workspaceUsers = WorkspaceUser::factory()
            ->count(2)
            ->create([
                'workspace_id' => $workspace->id,
            ]);

        $response = $this->getJson(
            route('api.workspaces.workspace-users.index', $workspace)
        );

        $response->assertOk()->assertSee($workspaceUsers[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_workspace_workspace_users()
    {
        $workspace = Workspace::factory()->create();
        $data      = WorkspaceUser::factory()
            ->make([
                'workspace_id' => $workspace->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.workspaces.workspace-users.store', $workspace),
            $data
        );

        unset($data['user_id']);
        unset($data['workspace_id']);

        $this->assertDatabaseHas('workspace_users', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $workspaceUser = WorkspaceUser::latest('id')->first();

        $this->assertEquals($workspace->id, $workspaceUser->workspace_id);
    }
}
