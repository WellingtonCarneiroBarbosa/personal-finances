<?php

namespace App\Observers;

use App\Actions\Application\Workspaces\CreateNewWorkspace;
use App\Models\User;
use App\Models\WorkspaceUser;

class UserObserver
{
    public function created(User $user)
    {
        $personalWorkspace = CreateNewWorkspace::run($user);

        $user->fill([
            'current_workspace_id' => $personalWorkspace->id,
        ])->update();

        WorkspaceUser::create([
            'user_id'      => $user->id,
            'workspace_id' => $personalWorkspace->id,
        ]);
    }
}
