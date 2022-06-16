<?php

namespace App\Observers;

use App\Models\Expense\Expense;
use App\Models\Expense\ExpenseCategory;
use App\Models\Income\Income;
use App\Models\Workspace\Workspace;

class WorkspaceObserver
{
    public function created(Workspace $workspace)
    {
        $category = ExpenseCategory::create([
            'name'         => 'General',
            'default'      => true,
            'workspace_id' => $workspace->id,
        ]);

        Income::create([
            'title'                 => "Income Example for {$workspace->name}",
            'amount'                => 100,
            'description'           => 'Example of an income of $100',
            'date'                  => now(),
        ])->workspaces()->attach($workspace);

        Expense::create([
            'title'               => "Workspace {$workspace->name} Example Expense",
            'cost'                => 14.50,
            'description'         => 'Example of an expense of $14.50',
            'date'                => now(),
            'expense_category_id' => $category->id,
            'workspace_id'        => $workspace->id,
        ]);
    }
}
