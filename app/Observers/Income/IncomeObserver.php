<?php

namespace App\Observers\Income;

use App\Models\Income\Income;

class IncomeObserver
{
    /**
     * Handle the Income "created" event.
     *
     * @param  \App\Models\Income\Income  $income
     * @return void
     */
    public function created(Income $income)
    {
        //
    }

    /**
     * Handle the Income "updated" event.
     *
     * @param  \App\Models\Income\Income  $income
     * @return void
     */
    public function updated(Income $income)
    {
        //
    }

    /**
     * Handle the Income "deleting" event.
     *
     * @param  \App\Models\Income\Income  $income
     * @return void
     */
    public function deleting(Income $income)
    {
        $income->workspaces()->detach();
    }

    /**
     * Handle the Income "deleted" event.
     *
     * @param  \App\Models\Income\Income  $income
     * @return void
     */
    public function deleted(Income $income)
    {
        //
    }

    /**
     * Handle the Income "restored" event.
     *
     * @param  \App\Models\Income\Income  $income
     * @return void
     */
    public function restored(Income $income)
    {
        //
    }

    /**
     * Handle the Income "force deleted" event.
     *
     * @param  \App\Models\Income\Income  $income
     * @return void
     */
    public function forceDeleted(Income $income)
    {
        //
    }
}
