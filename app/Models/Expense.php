<?php

namespace App\Models;

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
        'name',
        'cost',
        'description',
        'expense_category_id',
        'workspace_id',
    ];

    protected $searchableFields = ['*'];

    public function category()
    {
        return $this->belongsTo(ExpenseCategory::class, 'expense_category_id', 'id');
    }

    public function workspace()
    {
        return $this->belongsTo(Workspace::class);
    }
}
