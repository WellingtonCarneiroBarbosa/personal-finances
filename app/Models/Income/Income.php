<?php

namespace App\Models\Income;

use App\Models\Concerns\Scopes\Searchable;
use App\Models\Workspace\Workspace;
use App\Traits\Models\HasManyWorkspaces;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;
    use HasManyWorkspaces;
    use Searchable;

    protected $fillable = [
        'title',
        'amount',
        'description',
        'date',
    ];

    protected $casts = [
        'date'   => 'datetime:y-m-d',
        'amount' => 'float',
    ];

    public function workspaces()
    {
        return $this->belongsToMany(Workspace::class, 'incomes_workspaces', 'income_id', 'workspace_id');
    }

    public function recurring()
    {
        return $this->hasOne(RecurringIncome::class);
    }
}
