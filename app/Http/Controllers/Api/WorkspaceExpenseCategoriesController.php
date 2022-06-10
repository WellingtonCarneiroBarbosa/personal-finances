<?php

namespace App\Http\Controllers\Api;

use App\Models\Workspace;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExpenseCategoryResource;
use App\Http\Resources\ExpenseCategoryCollection;

class WorkspaceExpenseCategoriesController extends Controller
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

        $expenseCategories = $workspace
            ->expenseCategories()
            ->search($search)
            ->latest()
            ->paginate();

        return new ExpenseCategoryCollection($expenseCategories);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Workspace $workspace
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Workspace $workspace)
    {
        $this->authorize('create', ExpenseCategory::class);

        $validated = $request->validate([
            'title' => ['required', 'max:255', 'string'],
        ]);

        $expenseCategory = $workspace->expenseCategories()->create($validated);

        return new ExpenseCategoryResource($expenseCategory);
    }
}
