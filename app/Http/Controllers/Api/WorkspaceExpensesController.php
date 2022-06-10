<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ExpenseCollection;
use App\Http\Resources\ExpenseResource;
use App\Models\Workspace;
use Illuminate\Http\Request;

class WorkspaceExpensesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Workspace $workspace
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Workspace $workspace)
    {
        $this->authorize('view', $workspace);

        $search = $request->get('search', '');

        $expenses = $workspace
            ->expenses()
            ->search($search)
            ->latest()
            ->paginate();

        return new ExpenseCollection($expenses);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Workspace $workspace
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Workspace $workspace)
    {
        $this->authorize('create', Expense::class);

        $validated = $request->validate([
            'title'               => ['required', 'max:255', 'string'],
            'cost'                => ['required', 'regex:/^\d{1,13}(\.\d{1,4})?$/'],
            'description'         => ['nullable', 'max:255', 'string'],
            'expense_category_id' => [
                'required',
                'exists:expense_categories,id',
            ],
        ]);

        $expense = $workspace->expenses()->create($validated);

        return new ExpenseResource($expense);
    }
}
