<?php

namespace App\Actions\Application\Expenses\Category;

use App\Models\ExpenseCategory;

class DeleteCategory
{
    public static function run(ExpenseCategory $expenseCategory): void
    {
        if ($expenseCategory->default) {
            abort(403, __('crud.common.cannot_delete', ['entity' => __('a default Category')]));
        }

        $expenseCategory->delete();
    }
}
