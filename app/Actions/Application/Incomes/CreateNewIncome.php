<?php

namespace App\Actions\Application\Incomes;

use App\Models\Income\Income;
use App\Models\Workspace\Workspace;

class CreateNewIncome
{
    public static function run(array $input = [], ?Workspace $workspace = null): Income
    {
        $income = Income::create([
            'title'       => $input['title'],
            'amount'      => $input['amount'],
            'description' => $input['description'] ?? null,
            'date'        => $input['date'],
        ]);

        if ($workspace) {
            $income->workspaces()->attach($workspace->pluck('id')->toArray());
        }

        return $income;
    }
}
