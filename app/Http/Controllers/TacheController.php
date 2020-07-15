<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
use App\Notifications\NewTask;
use Illuminate\Notifications\DatabaseNotification;
use App\User;
use App\Tache;
use App\Action;
use Auth;
use Notification;

class TacheController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index1()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $groupes = $user->groupes->unique()->pluck('idG');
        $actions = $user->actions->where('couranteA',1)->pluck('idA'); return $actions;

        $tachesEnCours = Tache::whereIn('t_idA',$actions)->where('etatT',1)->get();

        $tachesTerminées = Tache::join('actions', 'taches.t_idA', '=', 'actions.idA')
        ->where('etatT',0)->where('a_idU',$id)->get();

        $tachesImportantes =  DB::table('taches')
                            ->join('actions', 'taches.t_idA', '=', 'actions.idA')
                            ->where('couranteA',1)
                            ->where('a_idU',$id)
                            ->where('taches.etatT',1)
                            ->where('actions.prioriteA','=','Haute')
                            ->get();

        $tachesGroupe = DB::table('taches')
                            ->join('actions', 'taches.t_idA', '=', 'actions.idA')
                            ->where('couranteA',1)
                            ->where('a_idU',$id)
                            ->where('etatT',1)
                            ->whereNotNull('a_idG')
                            ->whereIn('a_idG',$groupes)
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

    public function index()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $groupes = $user->groupes->unique()->pluck('idG'); 

        $actions = $user->actions->pluck('idA');
        $action_grp=Action::whereIn('a_idG',$groupes)->pluck('idA');
        
        $encours = Tache::whereIn('t_idA',$actions)->where('etatT',1)->get();//where(t_idU,auth)
        $encoursA = Tache::where('t_idU',$id)->where('etatT',1)->get();
        
        $terminées = Tache::whereIn('t_idA',$actions)->where('etatT',0)->get();
        $Tgroupes = Tache::whereIn('t_idA',$action_grp)->whereNULL('t_idU')->where('etatT',1)->get();
        
        return view('user.taches1',['taches' => $encours, 'tachesAff' => $encoursA, 'tachesT' => $terminées, 'tachesG' => $Tgroupes ]);

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
    public function affecter(Request $request)
    {
        $tache = Tache::find($request->input('tache'));
        $user = User::find($request->input('idG'));
        $tache->t_idU = $request->input('idG');
        $tache->save();
        Notification::send($user, new NewTask(Action::find($tache->action->idA)));
        if($request->input('idG') == Auth::user()->id)
            $to = "mine";
        else
            $to = "not_mine";
        return response()->json(['success' => "deleted", 'tache' => $request->input('tache'), 'user' => $to ]);
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
