<?php

namespace App\Models\Income;

use App\Models\Workspace\Workspace;
use App\Traits\Models\HasManyWorkspaces;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;
    use HasManyWorkspaces;

    protected $fillable = [
        'title',
        'amount',
        'description',
        'date',
    ];

    protected $casts = [
        'date'   => 'date',
        'amount' => 'float',
    ];

    public function workspaces()
    {
        return $this->belongsToMany(Workspace::class, 'incomes_workspaces', 'income_id', 'workspace_id');
    }
}
