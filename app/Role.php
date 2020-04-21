<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'idR';
    public function users()
    {
        return $this->belongsToMany(User::class, 'roles_users', '_idU', '_idR');
    }
}
