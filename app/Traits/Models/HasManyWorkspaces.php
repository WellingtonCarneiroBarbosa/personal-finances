<?php

namespace App\Traits\Models;

use App\Models\Concerns\Scopes\HasManyWorkspacesScope;
use Illuminate\Database\Eloquent\Model;

trait HasManyWorkspaces
{
    protected static function bootHasManyWorkspaces()
    {
        static::created(function (Model $model) {
            if (auth()->check()) {
                $currentDefaultWorkspace = auth()->user()->getOrCreateCurrentWorkspace();

                $model->workspaces()->attach($currentDefaultWorkspace->pluck('id')->toArray());
            }
        });

        static::addGlobalScope(new HasManyWorkspacesScope());
    }
}
