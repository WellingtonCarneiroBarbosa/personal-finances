<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class WorkspaceUsersController extends Controller
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

        $users = $workspace
            ->users()
            ->search($search)
            ->latest()
            ->paginate();

        return new UserCollection($users);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Workspace $workspace
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Workspace $workspace)
    {
        $this->authorize('create', User::class);

        $validated = $request->validate([
            'name'     => ['required', 'max:255', 'string'],
            'email'    => ['required', 'unique:users,email', 'email'],
            'password' => ['required'],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = $workspace->users()->create($validated);

        return new UserResource($user);
    }
}
