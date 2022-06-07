<?php

namespace App\Models\Concerns;

use App\Models\Workspace;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

trait HasWorkspaces
{
    public function ownedWorkspaces(): HasMany
    {
        return $this->hasMany(Workspace::class);
    }

    public function isCurrentWorkspace(Workspace $workspace): bool
    {
        return $this->currentWorkspace->id === $workspace->id;
    }

    public function currentWorkspace(): BelongsTo
    {
        if (is_null($this->current_workspace_id) && $this->id) {
            $this->switchWorkspace($this->personalWorkspace());
        }

        return $this->belongsTo(Workspace::class, 'current_workspace_id');
    }

    public function switchWorkspace(?Workspace $workspace): bool
    {
        if (! $this->belongsToWorkspace($workspace)) {
            return false;
        }

        $this->forceFill([
            'current_workspace_id' => $workspace->id,
        ])->save();

        $this->setRelation('currentWorkspace', $workspace);

        return true;
    }

    public function belongsToWorkspace(?Workspace $workspace): bool
    {
        if (is_null($workspace)) {
            return false;
        }

        return $this->ownsWorkspace($workspace) || $this->workspaces->contains(function ($w) use ($workspace) {
            return $w->id === $workspace->id;
        });
    }

    public function ownsWorkspace(?Workspace $workspace): bool
    {
        if (is_null($workspace)) {
            return false;
        }

        return $this->id == $workspace->{$this->getForeignKey()};
    }

    public function workspaces(): BelongsToMany
    {
        return $this->belongsToMany(Workspace::class, 'workspace_user');
    }

    public function personalWorkspace(): Workspace
    {
        return $this->ownedWorkspaces->where('personal_workspace', true)->firstOrFail();
    }

    public function allWorkspaces(): Collection
    {
        return $this->ownedWorkspaces->merge($this->workspaces)->sortBy('name');
    }
}
