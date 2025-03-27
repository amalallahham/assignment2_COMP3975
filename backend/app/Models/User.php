<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'password',
        'first_name',   // fixed: from firstName
        'last_name',    // fixed: from lastName
        'registration_date',
        'is_approved',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_approved' => 'boolean',
        'registration_date' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Default attribute values.
     */
    protected $attributes = [
        'is_approved' => false,
        'role' => self::ROLE_CONTRIBUTOR,
    ];

    const ROLE_ADMIN = 'Admin';
    const ROLE_CONTRIBUTOR = 'Contributor';

    /**
     * Override to use 'username' instead of 'email' for login
     */
    public function getAuthIdentifierName()
    {
        return 'username';
    }
}
