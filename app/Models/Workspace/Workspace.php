<?php

namespace App\Models\Workspace;

use App\Models\Concerns\Scopes\HasUserScope;
use App\Models\Concerns\Scopes\Searchable;
use App\Models\Expense\Expense;
use App\Models\Expense\ExpenseCategory;
use App\Models\Income\Income;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Workspace extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'user_id'];

    protected $searchableFields = ['*'];

    protected static function booted()
    {
        static::addGlobalScope(new HasUserScope());
    }

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

    public function incomes()
    {
        return $this->hasMany(Income::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'current_workspace_id');
    }

    public function currentWorkspaceUsers()
    {
        return $this->hasMany(User::class, 'current_workspace_id');
    }

    public function purge()
    {
        DB::transaction(function () {
            $this->expenses()->delete();
            $this->expenseCategories()->delete();
            $this->workspaceUsers()->delete();

            $this->currentWorkspaceUsers->each(function ($user) {
                $user->fill([
                    'current_workspace_id' => null,
                ])->update();

                $user->switchWorkspace($user->getOrCreateCurrentWorkspace($this));
            });

            $this->delete();
        });
    }
}
