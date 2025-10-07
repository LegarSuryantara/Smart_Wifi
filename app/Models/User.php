<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name', 'ip_address', 'email', 'password', 'phone', 'address', 'profile_photo',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'ip_address' => 'string',
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Check if user has any admin role (for future-proofing)
     */
    public function isAdmin(): bool
    {
        return $this->hasAnyPermission(['admin-access', ]); 
    }

    /**
     * Check if user is regular user
     */
    public function isRegularUser(): bool
    {
        return $this->hasRole('user');
    }
    public function orders()
    {
        return $this->hasMany(Orders::class);
    }
}