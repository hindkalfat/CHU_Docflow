<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Liste extends Model
{
    protected $table = 'listes';
    protected $primaryKey = 'idL';

    protected $fillable = [
        'libelleL', 'l_idM',
    ];
}
