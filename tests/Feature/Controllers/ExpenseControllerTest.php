<?php

namespace Tests\Feature\Controllers;

use App\Models\Expense\Expense;
use App\Models\Expense\ExpenseCategory;

use App\Models\User;
use App\Models\Workspace\Workspace;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExpenseControllerTest extends TestCase
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
    public function it_displays_index_view_with_expenses()
    {
        $expenses = Expense::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('expenses.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.expenses.index')
            ->assertViewHas('expenses');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_expense()
    {
        $response = $this->get(route('expenses.create'));

        $response->assertOk()->assertViewIs('app.expenses.create');
    }

    /**
     * @test
     */
    public function it_stores_the_expense()
    {
        $data = Expense::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('expenses.store'), $data);

        $this->assertDatabaseHas('expenses', $data);

        $expense = Expense::latest('id')->first();

        $response->assertRedirect(route('expenses.edit', $expense));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_expense()
    {
        $expense = Expense::factory()->create();

        $response = $this->get(route('expenses.show', $expense));

        $response
            ->assertOk()
            ->assertViewIs('app.expenses.show')
            ->assertViewHas('expense');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_expense()
    {
        $expense = Expense::factory()->create();

        $response = $this->get(route('expenses.edit', $expense));

        $response
            ->assertOk()
            ->assertViewIs('app.expenses.edit')
            ->assertViewHas('expense');
    }

    /**
     * @test
     */
    public function it_updates_the_expense()
    {
        $expense = Expense::factory()->create();

        $expenseCategory = ExpenseCategory::factory()->create();
        $workspace       = Workspace::factory()->create();

        $data = [
            'title'               => $this->faker->sentence(10),
            'cost'                => $this->faker->randomNumber(2),
            'description'         => $this->faker->sentence(15),
            'expense_category_id' => $expenseCategory->id,
            'workspace_id'        => $workspace->id,
        ];

        $response = $this->put(route('expenses.update', $expense), $data);

        $data['id'] = $expense->id;

        $this->assertDatabaseHas('expenses', $data);

        $response->assertRedirect(route('expenses.edit', $expense));
    }

    /**
     * @test
     */
    public function it_deletes_the_expense()
    {
        $expense = Expense::factory()->create();

        $response = $this->delete(route('expenses.destroy', $expense));

        $response->assertRedirect(route('expenses.index'));

        $this->assertModelMissing($expense);
    }
}
