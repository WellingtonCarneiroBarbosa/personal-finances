<?php

namespace App\Models\Income;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeWorkspace extends Model
{
    use HasFactory;

    protected $fillable = [
        'income_id',
        'workspace_id',
    ];
}
