<?php

namespace App\Actions\Application\Workspaces;

use App\Models\User;
use App\Models\Workspace;
use App\Models\WorkspaceUser;

class CreateNewWorkspace
{
    public static function run(User $user, array $input = []): Workspace
    {
        $workspace = Workspace::query()->create([
            'name'    => $input['name'] ?? __('Personal Workspace'),
            'user_id' => $user->id,
        ]);

        WorkspaceUser::create([
            'user_id'      => $user->id,
            'workspace_id' => $workspace->id,
        ]);

        return $workspace;
    }
}
