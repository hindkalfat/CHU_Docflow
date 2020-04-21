<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use App\User;
use App\RoleUser;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    
    public function index()
    {
        $users = User::all();

        return view('admin.utilisateurs',['users' => $users]);
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
         $user= new User();
 
        $user->nomU = $request->input('nomU');
        $user->prenomU = $request->input('prenomU');
        $user->serviceU = $request->input('serviceU');
        $user->villeU = $request->input('villeU');
        $user->numTelU = $request->input('numTelU');
        $user->emailPersoU = $request->input('emailPersoU');
        $user->adresseU = $request->input('adresseU');
        $user->professionU = $request->input('professionU');
        $user->centreU = $request->input('centreU');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));

        $user->save();

        $user_role = new RoleUser();
        $user_role->_idU= $user->id;
        $user_role->_idR=2;

        $user_role->save();

        return response()->json(['success' => "updated" , 'id' => $user->id]);;
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
        $id = $request->IDU;
        $user = User::find($id);

        $user->nomU = $request->nomU;
        $user->prenomU = $request->prenomU;
        $user->villeU = $request->villeU;
        $user->adresseU = $request->adresseU;
        $user->numTelU = $request->numTelU;
        $user->emailPersoU = $request->emailPersoU;
        $user->professionU = $request->professionU;
        $user->centreU = $request->centreU;
        $user->serviceU = $request->serviceU;

        $user->save();
        return response()->json(['success' => "updated"]);;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->idU;
        $user = User::find($id);
        $user->delete();
        return response()->json(['success' => "deleted", 'id' => $id]);;
    }
}
