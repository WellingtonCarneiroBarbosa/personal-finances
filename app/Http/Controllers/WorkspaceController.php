<?php

namespace App\Http\Controllers;

use App\Models\Workspace;
use Illuminate\Http\Request;
use App\Http\Requests\WorkspaceStoreRequest;
use App\Http\Requests\WorkspaceUpdateRequest;

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
            ->user()
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.workspaces.index', compact('workspaces', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Workspace::class);

        return view('app.workspaces.create');
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

        return redirect()
            ->route('workspaces.edit', $workspace)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Workspace $workspace
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Workspace $workspace)
    {
        $this->authorize('view', $workspace);

        return view('app.workspaces.show', compact('workspace'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Workspace $workspace
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Workspace $workspace)
    {
        $this->authorize('update', $workspace);

        return view('app.workspaces.edit', compact('workspace'));
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

        return redirect()
            ->route('workspaces.edit', $workspace)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('workspaces.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
