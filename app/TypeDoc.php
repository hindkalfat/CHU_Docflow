<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeDoc extends Model
{
    protected $table = 'types_doc';
    protected $primaryKey = 'idTd';

    protected $fillable = [
        'intiluleTd', 'descriptionTd',
    ];

    public function metadonnees()
    {
        return $this->hasMany(Metadonnee::class, 'm_idTd');
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'd_idTd');
    }

    public function workflow()
    {
        return $this->hasOne(Workflow::class, 'w_idTd');
    }
}
