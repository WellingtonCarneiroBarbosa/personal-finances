<?php

namespace App\Models\Income;

use App\Models\Workspace\Workspace;
use App\Traits\Models\HasWorkspace;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecurringIncome extends Model
{
    use HasFactory;
    use HasWorkspace;

    public const TYPES = [
        'yearly'   => 'yearly',
        'monthly'  => 'monthly',
        'biweekly' => 'biweekly',
        'weekly'   => 'weekly',
        'daily'    => 'daily',
    ];

    public const READABLE_TYPES = [
        'yearly'   => 'Yearly',
        'monthly'  => 'Monthly',
        'biweekly' => 'Biweekly',
        'weekly'   => 'Weekly',
        'daily'    => 'Daily',
    ];

    public function income()
    {
        return $this->belongsTo(Income::class);
    }

    public function workspace()
    {
        return $this->belongsTo(Workspace::class);
    }
}
