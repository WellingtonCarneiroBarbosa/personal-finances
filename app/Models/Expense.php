<?php

namespace App\Models;

use App\Models\Scopes\HasWorkspaceScope;
use App\Models\Scopes\Searchable;
use App\Traits\Models\HasWorkspace;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    use Searchable;
    use HasWorkspace;

    protected $fillable = [
        'title',
        'cost',
        'description',
        'expense_category_id',
        'workspace_id',
    ];

    protected $searchableFields = ['*'];

    protected static function booted()
    {
        static::addGlobalScope(new HasWorkspaceScope());
    }

    public function expenseCategory()
    {
        return $this->belongsTo(ExpenseCategory::class);
    }

    public function workspace()
    {
        return $this->belongsTo(Workspace::class);
    }
}
