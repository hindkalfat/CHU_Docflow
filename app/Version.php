<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
    protected $table = 'versions';
    protected $primaryKey = 'idV';

    protected $fillable = [
        'numV', 'doc',
    ];

    public function document()
    {
        return $this->belongsTo(Document::class, 'v_idD');
    }
}
