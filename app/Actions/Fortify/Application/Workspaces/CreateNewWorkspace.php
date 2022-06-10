<?php

namespace App\Actions\Fortify\Application\Workspaces;

use App\Models\User;
use App\Models\Workspace;

class CreateNewWorkspace
{
    public static function run(User $user, array $input = []): Workspace
    {
        return Workspace::query()->create([
            'name'    => $input['name'] ?? __('Personal Workspace'),
            'user_id' => $user->id,
        ]);
    }
}
