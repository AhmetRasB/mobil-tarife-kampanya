<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'is_active',
        'is_admin',
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
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
        'is_admin' => 'boolean',
    ];
    
    public function teklifs()
    {
        return $this->hasMany(Teklif::class);
    }
    
    public function abonelikler()
    {
        return $this->hasMany(Abonelik::class);
    }

    public function isAdmin()
    {
        return $this->is_admin;
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->role->name === $role;
        }
        return $this->role->id === $role->id;
    }

    public function hasPermission($permission)
    {
        if (is_string($permission)) {
            return $this->role->permissions->contains('slug', $permission);
        }
        return $this->role->permissions->contains('id', $permission->id);
    }

    public function hasAnyPermission($permissions)
    {
        if (is_string($permissions)) {
            return $this->role->permissions->contains('slug', $permissions);
        }
        return $this->role->permissions->intersect($permissions)->isNotEmpty();
    }
}
