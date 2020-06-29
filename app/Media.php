<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    public $table = "medias";
    protected $primaryKey = 'idM';
    
    protected $fillable  = ['idM','file','fileName','_idM'];
}
