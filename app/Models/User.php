<?php

namespace App\Models;

use App\Actions\Application\Workspaces\CreateNewWorkspace;
use App\Models\Concerns\Scopes\Searchable;
use App\Models\Workspace\Workspace;
use App\Models\Workspace\WorkspaceUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable;
    use HasFactory;
    use Searchable;
    use HasApiTokens;
    use HasProfilePhoto;
    use TwoFactorAuthenticatable;

    protected $fillable = ['name', 'email', 'password', 'current_workspace_id'];

    protected $searchableFields = ['*'];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes',
    ];

    protected $casts = [
        'email_verified_at'       => 'datetime',
        'two_factor_confirmed_at' => 'datetime',
    ];

    public function workspaceUsers()
    {
        return $this->hasMany(WorkspaceUser::class);
    }

    public function workspaces()
    {
        return $this->hasMany(Workspace::class);
    }

    public function currentWorkspace()
    {
        return $this->belongsTo(Workspace::class, 'current_workspace_id');
    }

    public function settings()
    {
        return $this->hasOne(UserSetting::class);
    }

    public function getOrCreateCurrentWorkspace(Workspace $ignoreWorkspace = null): Workspace
    {
        if ($this->current_workspace_id) {
            $currentWorkspace = $this->currentWorkspace;
        }

        if (! isset($currentWorkspace)) {
            $currentWorkspace = $this->workspaceUsers()
                ->when($ignoreWorkspace, function ($query, $ignoreWorkspace) {
                    return $query->where('workspace_id', '!=', $ignoreWorkspace->id);
                })
                ->first()?->workspace;
        }

        if (! $currentWorkspace ||
            $ignoreWorkspace &&
            $currentWorkspace->id === $ignoreWorkspace->id
        ) {
            $currentWorkspace = CreateNewWorkspace::run($this);
        }

        return $currentWorkspace;
    }

    public function isCurrentWorkspace(Workspace $workspace): bool
    {
        return $this->current_workspace_id === $workspace->id;
    }

    public function ownsOrBelongsToWorkspace(Workspace $workspace): bool
    {
        return $this->workspaces->contains($workspace) || WorkspaceUser::where('user_id', $this->id)->where('workspace_id', $workspace->id)->exists();
    }

    public function ownsTheWorkspace(Workspace $workspace): bool
    {
        return $this->workspaces->contains($workspace);
    }

    public function switchWorkspace(Workspace $workspace)
    {
        if (! $this->ownsOrBelongsToWorkspace($workspace)) {
            abort(403, "You don't have access to this workspace.");
        }

        $this->fill([
            'current_workspace_id' => $workspace->id,
        ])->update();
    }

    public function isSuperAdmin()
    {
        return $this->hasRole('super-admin');
    }
}
