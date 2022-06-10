<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Expense extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'title',
        'cost',
        'description',
        'expense_category_id',
        'workspace_id',
    ];

    protected $searchableFields = ['*'];

    public function expenseCategory()
    {
        return $this->belongsTo(ExpenseCategory::class);
    }

    public function workspace()
    {
        return $this->belongsTo(Workspace::class);
    }
}