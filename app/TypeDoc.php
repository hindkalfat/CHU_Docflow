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
        return $this->hasMany(Metadonnee::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function workflow()
    {
        return $this->hasOne(Workflow::class);
    }
}
