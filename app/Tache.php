<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{
    protected $table = 'taches';
    protected $primaryKey = 'idT';

    protected $fillable = [
        
    ];

    public function action()
    {
        return $this->belongsTo(Action::class,'t_idA');
    }

    public function document()
    {
        return $this->belongsTo(Document::class,'t_idD');
    }

    public function versions_recentes()
    {
        $mondoc= $this->document; 
        $predecesseurs = $this->action->predecesseurs()->pluck('_idFrom');
        $i=0;
        $mesTaches = null;
        if($predecesseurs)
        {
           if( Action::whereIn('idA',$predecesseurs)->where('versionA',1)->get()) 
           {
               foreach(Action::whereIn('idA',$predecesseurs)->where('versionA',1)->get() as $as){
                    if( $as->taches->where('t_idD',$mondoc->idD)->pluck('idT'))
                        foreach ($as->taches->where('t_idD',$mondoc->idD)->pluck('idT') as $a) {
                            $mesTaches[$i] = $a;
                            $i++;
                        }
               }
               if($mesTaches)
               {
                    $mesVersions = UserTache::whereIn('_idT',$mesTaches)->pluck('_idV');
                    return Version::whereIn('idV',$mesVersions)->get();
               }
           }
        }
        else
            return null;
    }
}
