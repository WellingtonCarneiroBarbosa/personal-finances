<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkspaceUser extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['user_id', 'workspace_id'];

    protected $searchableFields = ['*'];

    protected $table = 'workspace_users';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function workspace()
    {
        return $this->belongsTo(Workspace::class);
    }
}
