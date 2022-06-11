<?php

namespace App\Observers;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\Workspace;

class WorkspaceObserver
{
    public function created(Workspace $workspace)
    {
        $category = ExpenseCategory::create([
            'name'         => 'General',
            'default'      => true,
            'workspace_id' => $workspace->id,
        ]);

        Expense::create([
            'title'               => "Workspace {$workspace->name} Example Expense",
            'cost'                => 14.50,
            'description'         => 'Example of an expense of $14.50',
            'expense_category_id' => $category->id,
            'workspace_id'        => $workspace->id,
        ]);
    }
}
