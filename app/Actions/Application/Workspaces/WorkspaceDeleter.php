<?php

namespace App\Actions\Application\Workspaces;

use App\Models\User;
use App\Models\Workspace;
use Illuminate\Validation\ValidationException;

class WorkspaceDeleter
{
    public function __construct(public Workspace $workspace)
    {
        //
    }

    public function delete()
    {
        $this->workspace->purge();
    }

    public function validate(User $user)
    {
        // Gate::forUser($user)->authorize('delete', $workspace);

        if ($this->workspace->personal_workspace) {
            throw ValidationException::withMessages([
                'workspace' => __('You may not delete your personal workspace.'),
            ])->errorBag('deleteWorkspace');
        }
    }
}
