<?php

namespace App\Actions\Application\Expenses;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\Workspace;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CreateNewExpense
{
    public static function run(array $input = [], ?Workspace $workspace = null): Expense
    {
        $expenseFields = [
            'title'        => $input['title'],
            'cost'         => $input['cost'],
            'description'  => $input['description'] ?? null,
            'date'         => $input['date'],
        ];

        if ($workspace) {
            $expenseFields['workspace_id'] = $workspace->id;
        }

        $expenseFields['expense_category_id'] = self::getExpenseCategoryOrCreateOne($input['expense_category_id'] ?? null)->id;

        return Expense::create($expenseFields);
    }

    protected static function getExpenseCategoryOrCreateOne(int|string|null $expenseCategoryId = null): ExpenseCategory
    {
        if ($expenseCategoryId) {
            try {
                $expenseCategory = ExpenseCategory::findOrFail($expenseCategoryId);
            } catch (ModelNotFoundException $ignored) {
                //
            }
        }

        if (! isset($expenseCategory)) {
            $expenseCategory = ExpenseCategory::where('default', true)->firstOrCreate([
                'title' => __('Default Category'),
            ]);
        }

        return $expenseCategory;
    }
}
