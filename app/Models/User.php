<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Events\UserCreated;

class User extends Authenticatable implements MustVerifyEmail
{
    protected $dispatchesEvents = [
        'created' => UserCreated::class,
    ];

    public function leconsRated()
    {
        return $this->belongsToMany(Lecon::class);
    }

    protected $dates = [
        'created_at',
        'updated_at',
        'email_verified_at',
    ];

    public function professeurs()
    {
        return $this->hasMany(Professeur::class);
    }

    public function getPaginationAttribute()
    {
        return $this->settings->pagination;
    }

    public function getSettingsAttribute($value)
    {
        return json_decode($value);
    }

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lastname', 'name', 'email', 'password', 'settings'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the lecons.
     */
    public function lecons()
    {
        return $this->hasMany(Lecon::class);
    }

    /**
     * User is admin.
     *
     * @return integer
     */
    public function getAdminAttribute()
    {
        return $this->role === 'admin';
    }
}
