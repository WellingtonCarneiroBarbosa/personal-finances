<?php

namespace App\Models;

use App\Models\Scopes\HasWorkspaceScope;
use App\Models\Scopes\Searchable;
use App\Traits\Models\HasWorkspace;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model
{
    use HasFactory;
    use Searchable;
    use HasWorkspace;

    protected $fillable = ['title', 'workspace_id'];

    protected $searchableFields = ['*'];

    protected $table = 'expense_categories';

    protected static function booted()
    {
        static::addGlobalScope(new HasWorkspaceScope());
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function workspace()
    {
        return $this->belongsTo(Workspace::class);
    }
}
