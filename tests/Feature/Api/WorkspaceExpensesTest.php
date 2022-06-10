<?php

namespace Tests\Feature\Api;

use App\Models\Expense;
use App\Models\User;
use App\Models\Workspace;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class WorkspaceExpensesTest extends TestCase
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
    public function it_gets_workspace_expenses()
    {
        $workspace = Workspace::factory()->create();
        $expenses  = Expense::factory()
            ->count(2)
            ->create([
                'workspace_id' => $workspace->id,
            ]);

        $response = $this->getJson(
            route('api.workspaces.expenses.index', $workspace)
        );

        $response->assertOk()->assertSee($expenses[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_workspace_expenses()
    {
        $workspace = Workspace::factory()->create();
        $data      = Expense::factory()
            ->make([
                'workspace_id' => $workspace->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.workspaces.expenses.store', $workspace),
            $data
        );

        $this->assertDatabaseHas('expenses', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $expense = Expense::latest('id')->first();

        $this->assertEquals($workspace->id, $expense->workspace_id);
    }
}
