<?php

namespace Tests\Feature\Api;

use App\Models\Expense\ExpenseCategory;
use App\Models\User;
use App\Models\Workspace\Workspace;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class WorkspaceExpenseCategoriesTest extends TestCase
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
    public function it_gets_workspace_expense_categories()
    {
        $workspace         = Workspace::factory()->create();
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
        $data      = ExpenseCategory::factory()
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
