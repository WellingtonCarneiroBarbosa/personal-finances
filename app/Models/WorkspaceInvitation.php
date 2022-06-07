<?php

namespace App\Models;

use Laravel\Jetstream\TeamInvitation as JetstreamTeamInvitation;

class WorkspaceInvitation extends JetstreamTeamInvitation
{
    /**
     * Get the team that the invitation belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Workspace()
    {
        return $this->belongsTo(Workspace::class);
    }
}
