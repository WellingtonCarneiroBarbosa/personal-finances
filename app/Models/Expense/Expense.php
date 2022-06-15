<?php

namespace App\Models\Expense;

use App\Models\Concerns\Scopes\Searchable;
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
        'date',
        'expense_category_id',
        'workspace_id',
    ];

    protected $casts = [
        'date' => 'datetime:y-m-d',
        'cost' => 'float',
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
