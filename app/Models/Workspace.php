<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Workspace extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'user_id'];

    protected $searchableFields = ['*'];

    public function expenseCategories()
    {
        return $this->hasMany(ExpenseCategory::class);
    }

    public function workspaceUsers()
    {
        return $this->hasMany(WorkspaceUser::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'current_workspace_id');
    }

    public function scopeUser(Builder $query, ?User $user = null): Builder
    {
        return $query->where('user_id', $user ?? auth()->user()?->id);
    }
}
