<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
use App\Notifications\NewTask;
use Illuminate\Notifications\DatabaseNotification;
use App\Document;
use App\User;
use App\Groupe;
use App\Metadonnee;
use App\TypeDoc;
use App\Version;
use App\Successeur;
use App\CondSuccesseur;
use App\Action;
use App\Condition;
use App\Tache;
use App\UserTache;
use App\MetaDoc;
use App\Workflow;
use App\Mail\SendMail;
use File;
use Auth;
use Notification;
use Mail;
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

        $workflow = Workflow::pluck('w_idTd');
        $typesDoc = TypeDoc::wherein('idTD',$workflow)->get();

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
        $typeD = TypeDoc::find($request->input('typeDoc'));

        $document->d_idTd = $request->input('typeDoc');
        $document->nomD = $request->input('nomD');
        $document->titreD = $request->input('titreD');
        $document->etatD = "actif";
        $document->d_idU = Auth::user()->id;

        $document->save(); 
        $version = new Version;

        $version->numV = 1;

        $File = $request->file('file'); 
        $fileName = uniqid().$File->getClientOriginalName();
        $version->nomV = $File->getClientOriginalName();
        $File->move(public_path('pdf'), $fileName);
        $version->doc = $fileName;
        $version->v_idD = $document->idD;
        $version->save();

        $metas = $typeD->metadonnees;

        foreach ($metas as $meta ) {
            $a = $meta->idM;
            $metaDoc = new MetaDoc;
            $metaDoc->_idM = $meta->idM;
            $metaDoc->_idD = $document->idD;
            $metaDoc->_idUT = null;
            if ($request->input("".$a)) 
                $metaDoc->valeur = $request->input("".$a);
            else
                $metaDoc->valeur = null;
            $metaDoc->save();
            

        }

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
    public function destroy(Request $request)
    {
        $id = $request->idD;
        $doc = Document::find($id);
        $doc->delete();
        return response()->json(['success' => "deleted", 'id' => $id]);;
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
        $actionC = $document->type_doc->workflow->actions->where('couranteA',1);
        return view('user.document',['doc' => $document,'versions' => $versions, 'actionC' => $actionC]);
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

            if($action->typeA == "Email")
            {
                $myEmail = $action->destinataireIA;
   
                $details = array('body' => "bonjour");
               // Mail::to($myEmail)->send(new SendMail($details));
              /*  Mail::to($myEmail)->send(new SendMail($details)); */
                /* $data =  response()->json(['message' => $action->messageA]);
                $obj = $action->objetA;
                Mail::send('emails.sendMail', $data, function($message) use ($myEmail,$obj) {
                    $message->to($myEmail, 'A ')
                            ->subject($obj);
                    $message->from('chudocflow@gmail.com','CHUDocflow');
                  }); */

                $details = array('body' => $action->messageA);
                $obj = $action->objetA;
                Mail::to($myEmail)->send(new SendMail($details,$obj));
                 static::nextActions($action->idA,$id,null);

            }
            else
            {
                $tache = new Tache;
                $tache->t_idA = $action->idA;
                $tache->t_idD = $id;
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
                {
                    $user = User::find($action->a_idU);
                    Notification::send($user, new NewTask(Action::find($action->idA)));
                }
                else if($action->a_idG) //tester
                {
                    $groupe = Groupe::find($action->a_idG);
                    foreach ($groupe->users as $user) {
                        Notification::send($user, new NewTask(Action::find($action->idA)));
                    }
                }
                
            }
                
            
            return response()->json(['success' => "created", 'document' => $document, 'version' => $version]);
        }
         

    }

    public static function nextActions($id,$doc,$idT) 
    {
        $action = Action::find($id); 
         
        $actionsS = Successeur::where('_idFrom','=',$id) 
                                ->whereNotNull('_idTo')
                                ->pluck('_idTo');
        $conditionsS = CondSuccesseur::where('_idFrom','=',$id) 
                                ->pluck('_idTo');

        foreach ($conditionsS as $conditionS) {
            $cond = Condition::find($conditionS);
            if($cond->typeC == "condApp")
            {
                $actApp = Action::find($cond->c_idA);
                $tacheApp = Tache::where('t_idA',$cond->c_idA)->where('t_idD',$doc)->whereNotNull('Etat_avcT')->orderBy('updated_at', 'desc')->first();;
                $nextA_oui = $cond->_idAo;
                $nextA_non = $cond->_idAn;
                $nextC_oui = $cond->_idCo;
                $nextC_non = $cond->_idCn;
                if($tacheApp->Etat_avcT == 'Accepter')
                {
                    if($nextA_oui)
                        static::nextCondition($nextA_oui,$doc,$action);
                    else if($nextC_oui)
                        static::nextCondition($nextC_oui,$doc,$action);
                }
                else if($tacheApp->Etat_avcT == 'Rejeter')
                    if($nextA_non)
                        static::nextCondition($nextA_non,$doc,$action);
                    else if($nextC_non)
                        static::nextCondition($nextC_non,$doc,$action);
            }
        }

        foreach ($actionsS as $actionS) {
            
            $act = Action::find($actionS);

            $predecesseurs = Successeur::join('taches','successeurs._idFrom','=','taches.t_idA')
                                        ->where('_idTo','=',$actionS)
                                        ->where('etatT', '=', 1)
                                        ->pluck('_idFrom');

            if(count($predecesseurs)==0)
            {
                if($act->typeA == "Email")
                {
                    $myEmail = $act->destinataireIA;
    
                    /* $details = [
                        'title' => $act->objetA,
                        'body' => $act->messageA
                    ];
            
                    // Mail::to($myEmail)->send(new SendMail($details));
                    $data =  array('message' => $act->messageA);
                    $obj = $act->objetA;
                    Mail::send('emails.sendMail', $data, function($message) use ($myEmail,$obj) {
                        $message->to($myEmail, 'A ')
                                ->subject($obj);
                        $message->from('chudocflow@gmail.com','CHUDocflow');
                    }); */
                   /*  $details = array('body' => "bonjour");
                    Mail::to($myEmail)->send(new SendMail($details));
                    
 */
                    
                    $details = array('body' => $act->messageA);
                    $obj = $act->objetA;
                    Mail::to($myEmail)->send(new SendMail($details,$obj));   
                    static::nextActions($act->idA,$doc,null);

                }
                else
                {
                    $tache = new Tache;
                    $tache->t_idA = $actionS;
                    $tache->t_idD = $doc;
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
    
                    if($act->a_idU)
                    {
                        $user = User::find($act->a_idU);
                        Notification::send($user, new NewTask(Action::find($act->idA)));
                    }
                    else if($act->a_idG) //tester
                    {
                        $groupe = Groupe::find($act->a_idG);
                        foreach ($groupe->users as $user) {
                            Notification::send($user, new NewTask(Action::find($act->idA)));
                        }
                    }

                }
            }
        }

        if($idT)
            return response()->json(['idT' => $idT]);
    }

    public static function nextCondition($next,$doc,$action) 
    {

        $act = Action::find($next);

        $predecesseurs = Successeur::join('taches','successeurs._idFrom','=','taches.t_idA')
                                    ->where('_idTo','=',$next)
                                    ->where('etatT', '=', 1)
                                    ->pluck('_idFrom');

        if(count($predecesseurs)==0)
        {
            if($act->typeA == "Email")
            {
                $myEmail = $act->destinataireIA;

                $details = array('body' => $act->messageA);
                $obj = $act->objetA;
                Mail::to($myEmail)->send(new SendMail($details,$obj));


                static::nextActions($act->idA,$doc,null);

            }
            else
            {
                $tache = new Tache;
                $tache->t_idA = $next;
                $tache->t_idD = $doc;
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

                if($act->a_idU)
                {
                    $user = User::find($act->a_idU);
                    Notification::send($user, new NewTask(Action::find($act->idA)));
                }
                else if($act->a_idG) //tester
                {
                    $groupe = Groupe::find($act->a_idG);
                    foreach ($groupe->users as $user) {
                        Notification::send($user, new NewTask(Action::find($act->idA)));
                    }
                }

            }
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

        $document = $tache->document;

        if($tache->action->versionA == 1)
        {
            $version = new Version;

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
        }
        
        $user_tache->save();

        $typeD = $tache->document->type_doc;
        $metas = $typeD->metadonnees;

        foreach ($metas as $meta ) {
            $a = $meta->idM;
            $metaDoc = new MetaDoc;
            $metaDoc->_idM = $meta->idM;
            $metaDoc->_idD = $document->idD;
            $metaDoc->_idUT = $user_tache->idUT;
                if ($request->input("".$a)) 
                    $metaDoc->valeur = $request->input("".$a);
                else
                    $metaDoc->valeur = null;
            $metaDoc->save();
        }

        return $this->nextActions($tache->action->idA,$document->idD,$tache->idT);
    }

    public function search(Request $request)
    {
        if($request->ajax())
        {
            if ($request->search == '' ) {
                $metas = Document::all();
                $productsM = $metas->pluck('idD');

            } else {
                $productsM= Metadonnee::join('metas_docs','metas_docs._idM','=','metadonnees.idM')
                            ->where('libelleM','LIKE','%'.$request->search."%")
                            ->orwhere('valeur','LIKE','%'.$request->search."%")
                            ->pluck('_idD');
            }

            if ($request->input('typeD') == '' ) {
                $types = TypeDoc::all()->pluck('idTd');
            } else {
                $types = $request->input('typeD'); 
            }

            if ($request->input('etatD') == '' ) {
                $etat = ['actif' , 'archive'];
            } else {
                $etat = $request->input('etatD'); 
            }

            $docs = Document::join('users','users.id','=','documents.d_idU')
                    ->join('versions','versions.v_idD','=','documents.idD')
                    ->whereIn('idD',$productsM)->whereIn('d_idTd',$types)
                    ->whereIn('etatD',$etat)
                    ->get()
                    ->keyBy('idD');;       
            return response()->json(['success' => "deleted", 'docs' => $docs, 'p'=> $productsM, 't' =>$types]);;
        }
    }


}
