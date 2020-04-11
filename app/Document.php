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
        return $this->belongsTo(TypeDoc::class);
    }

    public function versions()
    {
        return $this->hasMany(Version::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
