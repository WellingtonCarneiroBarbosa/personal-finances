<?php

namespace App\Actions\Application\Incomes;

use App\Models\Income\Income;
use App\Models\Income\RecurringIncome;
use App\Models\Workspace\Workspace;
use DB;

class CreateNewIncome
{
    public static function run(array $input = [], ?Workspace $workspace = null, bool $hasRecurring = false): Income
    {
        return DB::transaction(function () use ($input, $workspace, $hasRecurring) {
            $income = Income::create([
                'title'       => $input['title'],
                'amount'      => $input['amount'],
                'description' => $input['description'] ?? null,
                'date'        => $input['date'],
            ]);

            if ($hasRecurring) {
                $income->recurring()->save(
                    RecurringIncome::make([
                        'recurring_type'      => $input['recurring_type'],
                        'recurring_starts_at' => $input['recurring_starts_at'],
                        'recurring_ends_at'   => $input['recurring_ends_at'] ?? null,
                    ])
                );
            }

            if ($workspace) {
                $income->workspaces()->attach($workspace->pluck('id')->toArray());
            }

            return $income;
        });
    }
}
