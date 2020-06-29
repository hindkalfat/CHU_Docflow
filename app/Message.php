<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['idM','message','content','sujet','from_id','to_id','save','delete'];

    protected $table = 'messages';
    protected $primaryKey = 'idM';

    public function sender()
    {
        return $this->belongsTo(User::class,'from_id','id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class,'to_id','id');
    }

    public function medias()
    {
        return $this->hasMany(Media::class, '_idM');
    }
}
