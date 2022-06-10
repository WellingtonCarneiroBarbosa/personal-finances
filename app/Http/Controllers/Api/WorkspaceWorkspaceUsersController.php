<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\WorkspaceUserCollection;
use App\Http\Resources\WorkspaceUserResource;
use App\Models\Workspace;
use Illuminate\Http\Request;

class WorkspaceWorkspaceUsersController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Workspace $workspace
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Workspace $workspace)
    {
        $this->authorize('view', $workspace);

        $search = $request->get('search', '');

        $workspaceUsers = $workspace
            ->workspaceUsers()
            ->search($search)
            ->latest()
            ->paginate();

        return new WorkspaceUserCollection($workspaceUsers);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Workspace $workspace
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Workspace $workspace)
    {
        $this->authorize('create', WorkspaceUser::class);

        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $workspaceUser = $workspace->workspaceUsers()->create($validated);

        return new WorkspaceUserResource($workspaceUser);
    }
}
