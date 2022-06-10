<?php

namespace App\Observers;

use App\Actions\Fortify\Application\Workspaces\CreateNewWorkspace;
use App\Models\User;

class UserObserver
{
    public function created(User $user)
    {
        $personalWorkspace = CreateNewWorkspace::run($user);

        $user->current_workspace_id = $personalWorkspace->id;

        $user->save();
    }
}
