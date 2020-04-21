<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nomU','prenomU','serviceU', 'villeU','numTelU','emailPersoU','adresseU','professionU','centreU', 'email', 'password',
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

    public function groupes()
    {
        return $this->belongsToMany(Groupe::class);
    }

    public function actions()
    {
        return $this->hasMany(Action::class, 'a_idU');
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'd_idU');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'roles_users' , '_idU', '_idR');
    }
}
