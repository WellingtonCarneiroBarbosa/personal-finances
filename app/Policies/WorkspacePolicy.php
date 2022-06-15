<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Workspace\Workspace;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorkspacePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the workspace can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the workspace can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Workspace\Workspace  $model
     * @return mixed
     */
    public function view(User $user, Workspace $model)
    {
        return true;
    }

    /**
     * Determine whether the workspace can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the workspace can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Workspace\Workspace  $model
     * @return mixed
     */
    public function update(User $user, Workspace $model)
    {
        return true;
    }

    /**
     * Determine whether the workspace can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Workspace\Workspace  $model
     * @return mixed
     */
    public function delete(User $user, Workspace $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Workspace\Workspace  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the workspace can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Workspace\Workspace  $model
     * @return mixed
     */
    public function restore(User $user, Workspace $model)
    {
        return false;
    }

    /**
     * Determine whether the workspace can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Workspace\Workspace  $model
     * @return mixed
     */
    public function forceDelete(User $user, Workspace $model)
    {
        return false;
    }
}
