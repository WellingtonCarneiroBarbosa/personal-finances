<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WorkspaceUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorkspaceUserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the workspaceUser can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the workspaceUser can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\WorkspaceUser  $model
     * @return mixed
     */
    public function view(User $user, WorkspaceUser $model)
    {
        return true;
    }

    /**
     * Determine whether the workspaceUser can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the workspaceUser can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\WorkspaceUser  $model
     * @return mixed
     */
    public function update(User $user, WorkspaceUser $model)
    {
        return true;
    }

    /**
     * Determine whether the workspaceUser can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\WorkspaceUser  $model
     * @return mixed
     */
    public function delete(User $user, WorkspaceUser $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\WorkspaceUser  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the workspaceUser can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\WorkspaceUser  $model
     * @return mixed
     */
    public function restore(User $user, WorkspaceUser $model)
    {
        return false;
    }

    /**
     * Determine whether the workspaceUser can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\WorkspaceUser  $model
     * @return mixed
     */
    public function forceDelete(User $user, WorkspaceUser $model)
    {
        return false;
    }
}
