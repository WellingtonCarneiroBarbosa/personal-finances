<?php

namespace App\Models;

use App\Models\Scopes\HasWorkspace;
use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExpenseCategory extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['title', 'workspace_id'];

    protected $searchableFields = ['*'];

    protected $table = 'expense_categories';

    protected static function booted()
    {
        static::addGlobalScope(new HasWorkspace);
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
