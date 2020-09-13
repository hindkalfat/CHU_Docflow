<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Groupe;
use App\User;
use App\GroupeUser;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $groupes = Groupe::all();
        $users = User::all();

        return view('admin.groupes',['groupes' => $groupes] ,['users' => $users]);
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
        $groupe= new Groupe();
        $users = $request->input('userG');
 
        $groupe->nomG = $request->input('nomG');
        $groupe->save();

        foreach ($users as $user) {
            $user_grp = new GroupeUser();
            $user_grp->_idU = $user;
            $user_grp->_idG = $groupe->idG;
            $user_grp->save();
        }

        $usersAvt = $groupe->users->take(3);
        $nbr = $groupe->users->count()-3;

        return response()->json(['success' => "updated" ,'nbr' => $nbr,'usersAvt'=>$usersAvt, 'id' => $groupe->idG, 'groupe' => $groupe, 'users' => $groupe->users]);;
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
    public function update(Request $request)
    {
        $id = $request->IDG;
        $users =  $request->input('userG'); //1 2 8

        $groupe = Groupe::find($id);

        $groupe->nomG = $request->nomG;

        $bdd = GroupeUser::where('_idG',$id)->pluck('_idU'); //2
       
        $toRemove = GroupeUser::whereNotIn('_idU',$users)->where('_idG',$id)->get(); 
        foreach ($toRemove as $t ) {
            $t->delete();
        }
        $except = GroupeUser::where('_idG',$id)->pluck('_idU'); //2
        
        foreach ($users as $user) {
            if(  $except->search($user*1) === false )
            {
                $user_grp = new GroupeUser();
                $user_grp->_idU = $user;
                $user_grp->_idG = $groupe->idG;
                $user_grp->save();
            }
            
        }

        $groupe->save();

        $usersAvt = $groupe->users->take(3);
        $nbr = $groupe->users->count();

        $usersF = User::whereIn('id',$users)->get();
        return response()->json(['success' => "updated", "users" => $usersF, 'nbr' => $nbr,'usersAvt'=>$usersAvt, 'groupe' => $groupe,]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->idG; 
        $groupe = Groupe::find($id);
        $groupe->delete();
        return response()->json(['success' => "deleted", 'idG' => $id]);;
    }
}
