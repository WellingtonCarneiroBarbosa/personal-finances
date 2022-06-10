<?php

namespace Tests\Feature\Api;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ExpenseCategoryExpensesTest extends TestCase
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
    public function it_gets_expense_category_expenses()
    {
        $expenseCategory = ExpenseCategory::factory()->create();
        $expenses        = Expense::factory()
            ->count(2)
            ->create([
                'expense_category_id' => $expenseCategory->id,
            ]);

        $response = $this->getJson(
            route('api.expense-categories.expenses.index', $expenseCategory)
        );

        $response->assertOk()->assertSee($expenses[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_expense_category_expenses()
    {
        $expenseCategory = ExpenseCategory::factory()->create();
        $data            = Expense::factory()
            ->make([
                'expense_category_id' => $expenseCategory->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.expense-categories.expenses.store', $expenseCategory),
            $data
        );

        $this->assertDatabaseHas('expenses', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $expense = Expense::latest('id')->first();

        $this->assertEquals(
            $expenseCategory->id,
            $expense->expense_category_id
        );
    }
}
