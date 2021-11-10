<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
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
     * @var string[]
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'role_id',
        'phone_number',
        'is_active',
        'warehouse_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function isAdmin()
    {
        if (auth()->user()->role_id == config('common.role.admin')) {
            return true;
        }
        return false;
    }

    public static function isStorekeeper()
    {
        if (auth()->user()->role_id == config('common.role.storekeeper')) {
            return true;
        }
        return false;
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(WareHouse::class);
    }
    /**
     * Check multiple roles
     * @param array $roles
     */
    public function hasAnyRole($roles)
    {
        return null !== $this->role()->whereIn('role', $roles)->first();
    }
    /**
     * Check one role
     * @param string $role
     */
    public function hasRole($role)
    {
        return null !== $this->role()->where('role', $role)->first();
    }
}
