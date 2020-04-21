<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Document;
use App\User;
use App\Metadonnee;
use App\TypeDoc;
use Auth;

class DocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $id = Auth::user()->id; //Auth
        $user = User::find($id);
        $docs = $user->documents;

        $typesDoc = TypeDoc::all();

        return view('user.documents',['docs' => $docs], ['typesDoc' => $typesDoc]);
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


    public function metas()
    {
        $id = $_POST['id'];
        $typeD = TypeDoc::find($id);
        $metas = $typeD->metadonnees;
        return response()->json($metas);
    }
}
