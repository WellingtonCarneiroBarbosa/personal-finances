<?php

namespace App\Actions\Application\Workspaces;

use App\Models\Workspace;
use App\Models\WorkspaceUser;

class DeleteWorkspace
{
    public static function run(Workspace $workspace)
    {
        if (auth()->check()) {
            if (! auth()->user()->ownsTheWorkspace($workspace)) {
                abort(403, __('crud.common.cannot_delete', ['entity' => __('a workspace you do not own')]));
            }
        }

        $user   = auth()->user() ?? $workspace->user;

        if (WorkspaceUser::where('user_id', $user->id)->where('workspace_id', '!=', $workspace->id)->doesntExist()) {
            abort(403, __('The user should be assigned to at least one workspace'));
        }

        $workspace->purge();
    }
}
