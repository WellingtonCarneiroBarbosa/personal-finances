<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Workspace;
use App\Models\ExpenseCategory;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WorkspaceExpenseCategoriesTest extends TestCase
{
    use RefreshDatabase, WithFaker;

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
    public function it_gets_workspace_expense_categories()
    {
        $workspace = Workspace::factory()->create();
        $expenseCategories = ExpenseCategory::factory()
            ->count(2)
            ->create([
                'workspace_id' => $workspace->id,
            ]);

        $response = $this->getJson(
            route('api.workspaces.expense-categories.index', $workspace)
        );

        $response->assertOk()->assertSee($expenseCategories[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_workspace_expense_categories()
    {
        $workspace = Workspace::factory()->create();
        $data = ExpenseCategory::factory()
            ->make([
                'workspace_id' => $workspace->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.workspaces.expense-categories.store', $workspace),
            $data
        );

        $this->assertDatabaseHas('expense_categories', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $expenseCategory = ExpenseCategory::latest('id')->first();

        $this->assertEquals($workspace->id, $expenseCategory->workspace_id);
    }
}
