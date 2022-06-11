<?php

namespace App\Traits\Models;

use App\Models\Scopes\HasWorkspaceScope;
use Illuminate\Database\Eloquent\Model;

trait HasWorkspace
{
    protected static function bootHasWorkspace()
    {
        static::creating(function (Model $model) {
            if (auth()->check()) {
                if (! $model->workspace_id) {
                    $model->workspace_id = auth()->user()->getOrCreateCurrentWorkspace()->id;
                }
            }
        });

        static::addGlobalScope(new HasWorkspaceScope());
    }
}
