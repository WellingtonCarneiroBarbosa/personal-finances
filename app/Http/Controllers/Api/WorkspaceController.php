<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\WorkspaceStoreRequest;
use App\Http\Requests\WorkspaceUpdateRequest;
use App\Http\Resources\WorkspaceCollection;
use App\Http\Resources\WorkspaceResource;
use App\Models\Workspace;
use Illuminate\Http\Request;

class WorkspaceController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Workspace::class);

        $search = $request->get('search', '');

        $workspaces = Workspace::search($search)
            ->latest()
            ->paginate();

        return new WorkspaceCollection($workspaces);
    }

    /**
     * @param \App\Http\Requests\WorkspaceStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(WorkspaceStoreRequest $request)
    {
        $this->authorize('create', Workspace::class);

        $validated = $request->validated();

        $workspace = Workspace::create($validated);

        return new WorkspaceResource($workspace);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Workspace $workspace
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Workspace $workspace)
    {
        $this->authorize('view', $workspace);

        return new WorkspaceResource($workspace);
    }

    /**
     * @param \App\Http\Requests\WorkspaceUpdateRequest $request
     * @param \App\Models\Workspace $workspace
     * @return \Illuminate\Http\Response
     */
    public function update(
        WorkspaceUpdateRequest $request,
        Workspace $workspace
    ) {
        $this->authorize('update', $workspace);

        $validated = $request->validated();

        $workspace->update($validated);

        return new WorkspaceResource($workspace);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Workspace $workspace
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Workspace $workspace)
    {
        $this->authorize('delete', $workspace);

        $workspace->delete();

        return response()->noContent();
    }
}
