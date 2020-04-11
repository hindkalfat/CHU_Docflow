<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    protected $table = 'actions';
    protected $primaryKey = 'idA';

    protected $fillable = [
        'nomA',   'titreA', 'directiveA',  'date_limiteA', 'opt_limiteA', 'date_rappelA', 'opt_rappelA', 'prioriteA',
    ];

    public function workflow()
    {
        return $this->belongsTo(Workflow::class);
    }

    public function taches()
    {
        return $this->hasMany(Tache::class);
    }

    public function groupe()
    {
        return $this->belongsTo(Groupe::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
