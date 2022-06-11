<?php

namespace App\Traits\Models;

use Illuminate\Database\Eloquent\Model;

trait HasWorkspace
{
    protected static function bootHasWorkspace()
    {
        static::creating(function (Model $model) {
            if (auth()->check()) {
                if (! $model->workspace_id) {
                    $model->workspace_id = auth()->user()->currentWorkspace()->id;
                }
            }
        });
    }
}
