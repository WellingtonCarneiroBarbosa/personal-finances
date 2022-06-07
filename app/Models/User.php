<?php

namespace App\Models;

use App\Models\Concerns\HasWorkspaces;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasWorkspaces;
    use Notifiable;
    use TwoFactorAuthenticatable;

    protected $guarded = ['id'];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    public function setNameAttribute(string $value): void
    {
        $this->attributes['name'] = Str::lower($value);
    }

    public function setEmailAttribute(string $value): void
    {
        $this->attributes['email'] = Str::lower($value);
    }

    public function getNameAttribute(): string
    {
        return ucwords($this->attributes['name']);
    }
}
