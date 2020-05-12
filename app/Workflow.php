<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workflow extends Model
{
    protected $table = 'workflows';
    protected $primaryKey = 'idWf';

    protected $fillable = [
        'nomWf', 'descriptionWf'
    ];

    public function conditions()
    {
        return $this->hasMany(Condition::class);
    }

    public function actions()
    {
        return $this->hasMany(Action::class,'a_idW');
    }

    public function type_doc()
    {
        return $this->belongsTo(TypeDoc::class);
    }
}
