<?php

namespace Tests\Feature\Api;

use App\Models\Expense\ExpenseCategory;
use App\Models\User;

use App\Models\Workspace\Workspace;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ExpenseCategoryTest extends TestCase
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
    public function it_gets_expense_categories_list()
    {
        $expenseCategories = ExpenseCategory::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.expense-categories.index'));

        $response->assertOk()->assertSee($expenseCategories[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_expense_category()
    {
        $data = ExpenseCategory::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.expense-categories.store'),
            $data
        );

        $this->assertDatabaseHas('expense_categories', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_expense_category()
    {
        $expenseCategory = ExpenseCategory::factory()->create();

        $workspace = Workspace::factory()->create();

        $data = [
            'title'        => $this->faker->sentence(10),
            'workspace_id' => $workspace->id,
        ];

        $response = $this->putJson(
            route('api.expense-categories.update', $expenseCategory),
            $data
        );

        $data['id'] = $expenseCategory->id;

        $this->assertDatabaseHas('expense_categories', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_expense_category()
    {
        $expenseCategory = ExpenseCategory::factory()->create();

        $response = $this->deleteJson(
            route('api.expense-categories.destroy', $expenseCategory)
        );

        $this->assertModelMissing($expenseCategory);

        $response->assertNoContent();
    }
}
