<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Metadonnee extends Model
{
    protected $table = 'metadonnees';
    protected $primaryKey = 'idM';

    protected $fillable = [
        'libelleM', 'typeM'
    ];

    public function type_doc()
    {
        return $this->belongsTo(TypeDoc::class);
    }
}
