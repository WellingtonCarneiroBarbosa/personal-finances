<?php

namespace App\Models\Concerns;

use App\Models\Workspace;

trait HasWorkspaces
{
    public function ownedWorkspaces(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Workspace::class, 'user_id');
    }
}
