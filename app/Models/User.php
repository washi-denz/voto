<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $guarded = [];
    protected $fillable = [
        'name',
        'last_name',
        'username',
        'email',
        'password',
        'avatar',
        'user_id',
        'api_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'api_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function census()
    {
        $this->hasMany(Census::class);
    }

    function candidates()
    {
        $this->hasMany(Candidate::class);
    }

    function getRouteKeyName()
    {
        return 'username';
    }

    public function getLogoAttribute($value)
    {
        if ($value != null)
            return 'storage/logos/' . $value;
        return 'images/logos/default.png';
    }

    public function getPhotoAttribute($value)
    {
        if ($value != null)
            return 'storage/photos/' . $value;
        return 'images/photos/default.png';
    }
}
