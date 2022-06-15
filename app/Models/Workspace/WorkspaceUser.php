<?php

namespace App\Models\Workspace;

use App\Models\Concerns\Scopes\Searchable;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkspaceUser extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['user_id', 'workspace_id'];

    protected $searchableFields = ['*'];

    protected $table = 'workspace_users';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function workspace()
    {
        return $this->belongsTo(Workspace::class);
    }

    public static function userAlreadyBelongsToWorkspace(User $user, Workspace $workspace)
    {
        return static::where('user_id', $user->id)
            ->where('workspace_id', $workspace->id)
            ->exists();
    }
}
