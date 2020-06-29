<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Metadonnee extends Model
{
    protected $table = 'metadonnees';
    protected $primaryKey = 'idM';

    protected $fillable = [
        'libelleM', 'typeM' , 'm_idTd'
    ];

    public function type_doc()
    {
        return $this->belongsTo(TypeDoc::class,'m_idTd');
    }

    public function actions()
    {
        return $this->belongsToMany(Action::class,'actions_metas', '_idM', '_idA');
    }
}
