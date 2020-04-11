<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Condition extends Model
{
    protected $table = 'conditions';
    protected $primaryKey = 'idC';

    protected $fillable = [
        
    ];

    public function workflow()
    {
        return $this->belongsTo(Workflow::class);
    }
}
