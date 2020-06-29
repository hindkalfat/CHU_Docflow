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
        return $this->belongsTo(Workflow::class, 'a_idW');
    }

    public function taches()
    {
        return $this->hasMany(Tache::class, 't_idA');
    }

    public function groupe()
    {
        return $this->belongsTo(Groupe::class, 'a_idG');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'a_idU');
    }

    public function predecesseurs()
    {
        return Successeur::where('_idTo','=',$this->idA)->get();
    }

    public function metadonnees()
    {
        return $this->belongsToMany(Metadonnee::class,'actions_metas', '_idA', '_idM');
    }
}
