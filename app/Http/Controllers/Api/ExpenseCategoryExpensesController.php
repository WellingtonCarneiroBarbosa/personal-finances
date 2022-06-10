<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\ExpenseCategory;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExpenseResource;
use App\Http\Resources\ExpenseCollection;

class ExpenseCategoryExpensesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ExpenseCategory $expenseCategory
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ExpenseCategory $expenseCategory)
    {
        $this->authorize('view', $expenseCategory);

        $search = $request->get('search', '');

        $expenses = $expenseCategory
            ->expenses()
            ->search($search)
            ->latest()
            ->paginate();

        return new ExpenseCollection($expenses);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ExpenseCategory $expenseCategory
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ExpenseCategory $expenseCategory)
    {
        $this->authorize('create', Expense::class);

        $validated = $request->validate([
            'title' => ['required', 'max:255', 'string'],
            'cost' => ['required', 'regex:/^\d{1,13}(\.\d{1,4})?$/'],
            'description' => ['nullable', 'max:255', 'string'],
            'workspace_id' => ['required', 'exists:workspaces,id'],
        ]);

        $expense = $expenseCategory->expenses()->create($validated);

        return new ExpenseResource($expense);
    }
}
