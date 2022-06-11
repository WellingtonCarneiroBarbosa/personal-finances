<?php

namespace App\Actions\Application\Workspaces;

use App\Models\Workspace;

class DeleteWorkspace
{
    public static function run(Workspace $workspace)
    {
        if (auth()->check()) {
            if (! auth()->user()->ownsTheWorkspace($workspace)) {
                abort(403, __('crud.common.cannot_delete', ['entity' => __('a workspace you do not own')]));
            }
        }

        $workspace->purge();
    }
}
