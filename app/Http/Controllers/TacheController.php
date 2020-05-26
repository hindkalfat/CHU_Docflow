<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
use App\User;
use App\Tache;
use App\Action;
use Auth;

class TacheController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $actions = $user->actions->where('couranteA',1)->pluck('idA'); 
        $tachesEnCours = Tache::whereIn('t_idA',$actions)->get();
        $tachesTerminées = Tache::where('etatT',0)->get();
        $tachesImportantes =  DB::table('taches')
                            ->join('actions', 'taches.t_idA', '=', 'actions.idA')
                            ->where('taches.etatT',1)
                            ->where('actions.prioriteA','=','Haute')
                            ->get();
        $tachesGroupe = DB::table('taches')
                            ->join('actions', 'taches.t_idA', '=', 'actions.idA')
                            ->where('etatT',1)
                            ->whereNotNull('a_idG')
                            ->get();

/*
        $t = Tache::find(4); return $t->document->versions->where('numV',1)->first()->nomV;
        /*foreach ( $t->versions_recentes() as $tv) {
            dd($tv->nomV);
        }
        $mondoc= $t->document;
        $predecesseurs = $t->action->predecesseurs()->pluck('_idFrom');
        foreach(Action::whereIn('idA',$predecesseurs)->where('versionA',1)->get() as $a)
            $a->taches->where('t_idD',$mondoc->idD); */

        return view('user.taches1',['taches' => $tachesEnCours, 'tachesT' => $tachesTerminées, 'tachesG' => $tachesGroupe]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
