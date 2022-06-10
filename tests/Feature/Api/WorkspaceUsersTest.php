<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Workspace;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class WorkspaceUsersTest extends TestCase
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
    public function it_gets_workspace_users()
    {
        $workspace = Workspace::factory()->create();
        $users     = User::factory()
            ->count(2)
            ->create([
                'current_workspace_id' => $workspace->id,
            ]);

        $response = $this->getJson(
            route('api.workspaces.users.index', $workspace)
        );

        $response->assertOk()->assertSee($users[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_workspace_users()
    {
        $workspace = Workspace::factory()->create();
        $data      = User::factory()
            ->make([
                'current_workspace_id' => $workspace->id,
            ])
            ->toArray();
        $data['password'] = \Str::random('8');

        $response = $this->postJson(
            route('api.workspaces.users.store', $workspace),
            $data
        );

        unset($data['password']);
        unset($data['email_verified_at']);
        unset($data['two_factor_confirmed_at']);
        unset($data['current_team_id']);
        unset($data['profile_photo_path']);
        unset($data['name']);
        unset($data['email']);
        unset($data['current_workspace_id']);

        $this->assertDatabaseHas('users', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $user = User::latest('id')->first();

        $this->assertEquals($workspace->id, $user->current_workspace_id);
    }
}
