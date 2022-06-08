<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Workspace extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'personal_workspace' => 'boolean',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'workspace_user')
                    ->as('membership');
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function purge(): void
    {
        $this->owner()->where('current_workspace_id', $this->id)
                ->update(['current_workspace_id' => null]);


        $this->users()->where('current_workspace_id', $this->id)
                ->update(['current_workspace_id' => null]);

        $this->users()->detach();

        $this->delete();
    }
}
