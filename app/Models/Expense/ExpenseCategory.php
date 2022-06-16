<?php

namespace App\Models\Expense;

use App\Models\Concerns\Scopes\Searchable;
use App\Models\Workspace\Workspace;
use App\Traits\Models\HasWorkspace;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model
{
    use HasFactory;
    use Searchable;
    use HasWorkspace;

    protected $fillable = ['name', 'workspace_id', 'default'];

    protected $searchableFields = ['*'];

    protected $table = 'expense_categories';

    protected $casts = [
        'default' => 'boolean',
    ];

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function workspace()
    {
        return $this->belongsTo(Workspace::class);
    }
}
