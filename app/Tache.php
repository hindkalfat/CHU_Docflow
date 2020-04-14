<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{
    protected $table = 'taches';
    protected $primaryKey = 'idT';

    protected $fillable = [
        
    ];

    public function action()
    {
        return $this->belongsTo(Action::class,'t_idA');
    }
}
