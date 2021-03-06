<?php

namespace Tests\Feature\Api;

use App\Models\Expense\Expense;
use App\Models\Expense\ExpenseCategory;

use App\Models\User;
use App\Models\Workspace\Workspace;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ExpenseTest extends TestCase
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
    public function it_gets_expenses_list()
    {
        $expenses = Expense::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.expenses.index'));

        $response->assertOk()->assertSee($expenses[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_expense()
    {
        $data = Expense::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.expenses.store'), $data);

        $this->assertDatabaseHas('expenses', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.expenses.update', $expense),
            $data
        );

        $data['id'] = $expense->id;

        $this->assertDatabaseHas('expenses', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_expense()
    {
        $expense = Expense::factory()->create();

        $response = $this->deleteJson(route('api.expenses.destroy', $expense));

        $this->assertModelMissing($expense);

        $response->assertNoContent();
    }
}
