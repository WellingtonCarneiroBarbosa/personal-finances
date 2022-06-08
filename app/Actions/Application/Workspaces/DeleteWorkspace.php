<?php

namespace App\Actions\Application\Workspaces;

use App\Actions\Concerns\RedirectsActions;
use App\Models\Workspace;
use App\Policies\WorkspacePolicy;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteWorkspace
{
    use AsAction;
    use RedirectsActions;

    public function handle(Workspace $workspace): void
    {
        if (! app(WorkspacePolicy::class)->delete($workspace)) {
            throw ValidationException::withMessages([
                'workspace' => __('validation.workspaces.delete_personal'),
            ])->errorBag('deleteWorkspace');
        }

        $workspace->purge();
    }

    public function asController(Request $request, Workspace $workspace): mixed
    {
        $this->handle($workspace);

        if ($request->expectsJson()) {
            return response()->json(null, 204);
        }

        return $this->redirectPath($this->workspace);
    }
}
