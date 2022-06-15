<?php

namespace App\Models\Income;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'amount',
        'description',
        'date',
    ];

    protected $casts = [
        'date'   => 'date',
        'amount' => 'float',
    ];

    public function workspaces()
    {
        return $this->belongsToMany(Workspace::class);
    }
}
