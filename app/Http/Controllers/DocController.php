<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
use App\Notifications\NewTask;
use Illuminate\Notifications\DatabaseNotification;
use App\Document;
use App\User;
use App\Metadonnee;
use App\TypeDoc;
use App\Version;
use App\Successeur;
use App\Action;
use App\Tache;
use App\UserTache;
use File;
use Auth;
use Notification;

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
        $document = new Document;

        $document->d_idTd = $request->input('typeDoc');
        $document->nomD = $request->input('nomD');
        $document->titreD = $request->input('titreD');
        $document->etatD = "actif";
        $document->d_idU = Auth::user()->id;

        $document->save(); 
        $version = new Version;

        $version->numV = 1;
        $version->nomV = $File->getClientOriginalName();

        $File = $request->file('file'); 
        $fileName = uniqid().$File->getClientOriginalName();
        $File->move(public_path('pdf'), $fileName);
        $version->doc = $fileName;
        $version->v_idD = $document->idD;
        $version->save();

        return $this->actions($document->idD,$document,$version);
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
        if($id)
        {
            $typeD = TypeDoc::find($id);
            $metas = $typeD->metadonnees;
            return response()->json($metas);
        }else{
            return response()->json(['success' => "no data"]);
        }
        
    }

    public function details($id)
    {
        $document = Document::find($id); 
        $versions = $document->versions;
        return view('user.document',['doc' => $document],['versions' => $versions]);
    }

    public static function actions($id,$document,$version) //$id
    {
        $doc = Document::find($id);

        $workflow = $doc->type_doc->workflow;
        $actionWf = $workflow->actions->pluck('idA');
        $actionsS = Successeur::where('_idFrom','=',NULL)
                            ->wherein('_idTo',$actionWf)
                            ->pluck('_idTo');

        foreach ($actionsS as $actionS ) {
            $action = Action::find($actionS);
            $action->couranteA = 1;
            $action->save();

            $tache = new Tache;
            $tache->t_idA = $action->idA;
            switch ($action->opt_limiteA) {
                case 'j':
                    $a = $tache->date_echeanceT = Date('d/m/Y H:i:s', strtotime('+'.$action->date_limiteA.' days'));
                    break;
                case 'h':
                    $b = $tache->date_echeanceT = Date('d/m/Y H:i:s', strtotime('+'.$action->date_limiteA.' hours'));
                    break;
                case 'm':
                    $c = $tache->date_echeanceT = Date('d/m/Y H:i:s', strtotime('+'.$action->date_limiteA.' minutes'));
                    break;
            } 
            switch ($action->opt_rappelA) {
                case 'j':
                    $tache->date_rappelT = Date($a, strtotime('-'.$action->date_rappelA.' days')) ;
                    break;
                case 'h':
                    $tache->date_rappelT = Date($b, strtotime('-'.$action->date_rappelA.' hours')) ;
                    break;
                case 'm':
                    $tache->date_rappelT = Date($c, strtotime('-'.$action->date_rappelA.' minutes'));
                    break;
            } 
            $tache->save();
            if($action->a_idU)
                $user = User::find($action->a_idU);
            else if($action->a_idG)
                $user = Groupe::find($action->a_idG);
            Notification::send($user, new NewTask(Action::find($action->idA)));
            
            return response()->json(['success' => "created", 'document' => $document, 'version' => $version]);
        }
         

    }

    public function nextActions() //$id
    {
        $action = Action::find(13); //tache finie
        $action->couranteA = 0;
        $actionsS = DB::table('successeurs')
                            ->join('actions','successeurs._idTo','=','actions.idA')//Successeur::
                            ->where('_idFrom','=',13)
                            ->where('couranteA', '=', 0)
                            ->pluck('_idTo');
        return $predecesseurs = Successeur::where('_idTo','=',$actionsS[0])->get(); //all cour=0
                            
        foreach ($actionsS as $actionS ) {//avec predecesseurs
            $action = Action::find($actionS);
            $action->couranteA = 1;
            $action->save();

            $tache = new Tache;
            $tache->t_idA = $action->idA;
            switch ($action->opt_limiteA) {
                case 'j':
                    $a = $tache->date_echeanceT = Date('d/m/Y H:i:s', strtotime('+'.$action->date_limiteA.' days'));
                    break;
                case 'h':
                    $a = $tache->date_echeanceT = Date('d/m/Y H:i:s', strtotime('+'.$action->date_limiteA.' hours'));
                    break;
                case 'm':
                    $a = $tache->date_echeanceT = Date('d/m/Y H:i:s', strtotime('+'.$action->date_limiteA.' minutes'));
                    break;
            } 
            switch ($action->opt_rappelA) {
                case 'j':
                    $tache->date_rappelT = Date($a, strtotime('-'.$action->date_rappelA.' days')) ;
                    break;
                case 'h':
                    $tache->date_rappelT = Date($a, strtotime('-'.$action->date_rappelA.' hours')) ;
                    break;
                case 'm':
                    $tache->date_rappelT = Date($a, strtotime('-'.$action->date_rappelA.' minutes'));
                    break;
            } 
            $tache->save();
        }

    }

    public function effectuerTache(Request $request)
    {
        $tache = Tache::find($request->input('idTache'));
        $tache->Etat_avcT = $request->input('typeTache');
        $tache->etatT = 0;
        $tache->save();

        $user_tache = new UserTache;
        $user_tache->_idT = $tache->idT;
        $user_tache->_idU = $tache->action->user->id;

        $version = new Version;
        $document = $tache->document;

        $lastVersion = Version::where('v_idD',$tache->document->idD)->max('numV');
        $version->numV = $lastVersion + 1;

        $File = $request->file('versionTache');  
        $version->nomV = $File->getClientOriginalName();
        $fileName = uniqid().$File->getClientOriginalName();
        $File->move(public_path('pdf'), $fileName);
        $version->doc = $fileName;
        $version->v_idD = $document->idD;
        $version->save();

        $user_tache->_idV = $version->idV;
        $user_tache->save();

        return response()->json(['success' => "created"]);
    }
}
