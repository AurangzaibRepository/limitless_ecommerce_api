<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
