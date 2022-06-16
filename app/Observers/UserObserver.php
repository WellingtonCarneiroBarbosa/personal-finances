<?php

namespace App\Observers;

use App\Actions\Application\Workspaces\CreateNewWorkspace;
use App\Models\User;

class UserObserver
{
    public function created(User $user)
    {
        $personalWorkspace = CreateNewWorkspace::run($user);

        $user->settings()->create([
            'timezone' => config('app.timezone'),
            'locale'   => config('app.locale'),
        ]);

        $user->fill([
            'current_workspace_id' => $personalWorkspace->id,
        ])->update();
    }
}
