<?php

namespace App\Http\Controllers\Workspaces;

use App\Actions\Application\Workspaces\WorkspaceDeleter;
use App\Actions\Concerns\RedirectsActions;
use App\Http\Controllers\Controller;
use App\Models\Workspace;
use Illuminate\Http\Request;

class WorkspacesController extends Controller
{
    use RedirectsActions;

    public function destroy(Request $request, Workspace $workspace)
    {
        $deleter = new WorkspaceDeleter($workspace);

        $deleter->validate($request->user());

        $deleter->delete();

        return $this->redirectPath($workspace);
    }
}
