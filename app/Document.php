<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table = 'documents';
    protected $primaryKey = 'idD';

    protected $fillable = [
        'nomD', 'titreD', 'etatD',
    ];

    public function type_doc()
    {
        return $this->belongsTo(TypeDoc::class,'d_idTd');
    }

    public function versions()
    {
        return $this->hasMany(Version::class, 'v_idD');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'d_idU');
    }

    public function taches()
    {
        return $this->hasMany(Tache::class, 't_idD');
    }

    public function metadonnees()
    {
        return $this->belongsToMany(Metadonnee::class,'metas_docs', '_idD', '_idM');
    }
}
