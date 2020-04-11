<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Groupe extends Model
{
    protected $table = 'groupes';
    protected $primaryKey = 'idG';

    protected $fillable = [
        'nomG'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function actions()
    {
        return $this->hasMany(Action::class);
    }
}
