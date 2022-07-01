<?php

namespace App\Actions\Application\Incomes;

use App\Models\Income\Income;

class DeleteIncome
{
    public static function run(Income $income): void
    {
        $income->delete();

        $income->workspaces()->detach();
    }
}
