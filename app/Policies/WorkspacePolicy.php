<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Workspace;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorkspacePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Workspace  $workspace
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Workspace $workspace)
    {
        return $workspace->personal_workspace === false;
    }
}
