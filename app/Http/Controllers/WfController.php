<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TypeDoc;
use App\User;
use App\Workflow;
use App\Action;

class WfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typesDoc = TypeDoc::all();
        $users = User::all();

        return view('admin.test', ['typesDoc' => $typesDoc, 'users' => $users]);   
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
        $workflow = new Workflow;

        $workflow->w_idTd = $request->input('typeDoc');
        $workflow->nomWf = $request->input('nomWf');
        $workflow->descriptionWf = $request->input('descWf');
        $workflow->save();

        return response()->json(['success' => "created", 'workflow' => $workflow ]);
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

    public function addAction(Request $request)
    { 
        $action = new Action;

        $action->nomA = $request->input('nomA');
        $action->titreA = $request->input('titreA');
        $action->directiveA = $request->input('directiveA');
        $action->date_limiteA = $request->input('date_limiteA');
        $action->opt_limiteA = $request->input('opt_limiteA');
        $action->date_rappelA = $request->input('date_rappelA');
        $action->opt_rappelA = $request->input('opt_rappelA');
        $action->prioriteA = "haute";// $request->input('prioriteA');
        $action->a_idW = $request->input('a_idW');
        $action->a_idG = 1;// $request->input('a_idG');
        $action->a_idU = $request->input('a_idU');

        $action->save();
    }
}
