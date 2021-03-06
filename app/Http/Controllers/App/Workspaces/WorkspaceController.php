<?php

namespace App\Http\Controllers\App\Workspaces;

use App\Actions\Application\Workspaces\CreateNewWorkspace;
use App\Actions\Application\Workspaces\DeleteWorkspace;
use App\Http\Controllers\Controller;
use App\Http\Requests\WorkspaceStoreRequest;
use App\Http\Requests\WorkspaceUpdateRequest;
use App\Models\Workspace\Workspace;
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

        $workspace = CreateNewWorkspace::run(auth()->user(), $validated);

        auth()->user()->switchWorkspace($workspace);

        return redirect()
            ->route('workspaces.edit', $workspace)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Workspace\Workspace $workspace
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Workspace $workspace)
    {
        $this->authorize('view', $workspace);

        return view('app.workspaces.show', compact('workspace'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Workspace\Workspace $workspace
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Workspace $workspace)
    {
        $this->authorize('update', $workspace);

        return view('app.workspaces.edit', compact('workspace'));
    }

    /**
     * @param \App\Http\Requests\WorkspaceUpdateRequest $request
     * @param \App\Models\Workspace\Workspace $workspace
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

    public function updateCurrent(Workspace $workspace)
    {
        auth()->user()->switchWorkspace($workspace);

        return redirect()->back()->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Workspace\Workspace $workspace
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Workspace $workspace)
    {
        $this->authorize('delete', $workspace);

        DeleteWorkspace::run($workspace);

        return redirect()
            ->route('workspaces.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
