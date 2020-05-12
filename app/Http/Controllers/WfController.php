<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\TypeDoc;
use App\User;
use App\Workflow;
use App\Action;
use App\Successeur;

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

        if($request->input('typeA')=="Email")
        {
            $action->objetA = $request->input('objetA');
            $action->messageA = $request->input('messageA');
            $action->a_destinataireU = $request->input('a_destinataireU');
            $action->destinataireIA = $request->input('destinataireIA');
            $action->date_limiteA = 3;
            $action->opt_limiteA = 'jour(s)';
        }
        else
        {
            $action->directiveA = $request->input('directiveA');
            $action->date_limiteA = $request->input('date_limiteA');
            $action->opt_limiteA = $request->input('opt_limiteA');
            $action->date_rappelA = $request->input('date_rappelA');
            $action->opt_rappelA = $request->input('opt_rappelA');
            $action->prioriteA = $request->input('prioriteA');
            $action->versionA = $request->input('versionA');
            //$action->a_idG = 1;// $request->input('a_idG');
            $action->a_idU = $request->input('a_idU');

        }
        $action->nomA = $request->input('nomA');
        $action->typeA = $request->input('typeA');
        $action->a_idW = $request->input('a_idW');
        $action->idop = $request->input('idoperator');

        $action->save();
    }

    public function successeurs(Request $request)
    { 
        $dataWf = $request->input('getData'); 
        $json = json_decode($dataWf, true);

        $idWf = $request->input('idWf');
        
        foreach ($json['links'] as $data ) {

            $successeur = new Successeur;

            if($data['fromOperatorType'] == 'Début')
            {
                $actionT= Action::where('idop',$data['toOperator'])
                            ->where('a_idW',$request->input('idWf'))
                            ->take(1)
                            ->get();
                $successeur->_idFrom = null;
                $successeur->_idTo = $actionT[0]->idA;
            }else{
                $actionF= Action::where('idop',$data['fromOperator'])
                            ->where('a_idW',$request->input('idWf'))
                            ->take(1)
                            ->get();  
                        
                $actionT= Action::where('idop',$data['toOperator'])
                            ->where('a_idW',$request->input('idWf'))
                            ->take(1)
                            ->get();
                $successeur->_idFrom = $actionF[0]->idA;
                $successeur->_idTo = $actionT[0]->idA;
            }

            $successeur->save();
        }

        return Redirect::to('/admin/users');
    }

    public function checkUniqueWf(Request $request)
    {
        $type = TypeDoc::find($request->input('typeDocUnique'));
        if(!$type->workflow)
            return response()->json(['success' => "unique"]);
        else 
            return response()->json(['success' => "duplicated"]);
    }
}
