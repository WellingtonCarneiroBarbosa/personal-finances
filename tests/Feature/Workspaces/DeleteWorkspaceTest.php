<?php

namespace Tests\Feature\Workspaces;

use App\Models\User;
use App\Models\Workspace;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteWorkspaceTest extends TestCase
{
    use RefreshDatabase;

    public function test_workspaces_can_be_deleted()
    {
        $this->actingAs($user = User::factory()->withPersonalWorkspace()->create());

        $user->ownedWorkspaces()->save($workspace = Workspace::factory()->make([
            'personal_workspace' => false,
        ]));

        $workspace->users()->attach(
            $otherUser = User::factory()->create()
        );

        $response = $this->delete(route('workspaces.destroy', $workspace));

        $this->assertNull($workspace->fresh());
        $this->assertCount(0, $otherUser->fresh()->workspaces);
    }

    public function test_personal_workspaces_cant_be_deleted()
    {
        $this->actingAs($user = User::factory()->withPersonalWorkspace()->create());

        $response = $this->delete(route('workspaces.destroy', $user->currentWorkspace->id));

        $this->assertNotNull($user->currentWorkspace->fresh());
    }
}
