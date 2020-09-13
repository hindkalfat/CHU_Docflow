<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
use App\Notifications\NewTask;
use App\Notifications\archiveNotification;
use Illuminate\Notifications\DatabaseNotification;
use App\Notifications\MsgNotification;
use DateTime;
use App\Document;
use App\User;
use App\Groupe;
use App\Metadonnee;
use App\TypeDoc;
use App\GroupeDoc;
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
use App\Message;
use App\Media;
use App\ActionMeta;




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
        $docsU = $user->documents->pluck('idD');
        $groupes = $user->groupes; 
        $groupesID = $user->groupes->pluck('idG'); 
        $docsG = GroupeDoc::whereIn('_idG',$groupesID)->pluck('_idD'); 
        
        $docs = Document::whereIn('idD',$docsG)->orwhereIn('idD',$docsU)->distinct()->get();

        $workflow = Workflow::pluck('w_idTd');
        $typesDoc = TypeDoc::wherein('idTD',$workflow)->get();

        return view('user.documents',['docs' => $docs, 'typesDoc' => $typesDoc, 'groupes' => $groupes]);
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
        $groupes = $request->input('grp');

        $document->d_idTd = $request->input('typeDoc');
        $document->nomD = $request->input('nomD');
        $document->titreD = $request->input('titreD');
        $document->etatD = "actif";
        $document->d_idU = Auth::user()->id;
        if($groupes)
        {
            $document->droitD = 'partagé';
        }
            
        else
            $document->droitD = 'privé';

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

        if($groupes)
        {
            foreach ($groupes as $groupe) {
                $grp_doc = new GroupeDoc;
                $grp_doc->_idD = $document->idD;
                $grp_doc->_idG = $groupe;
                $grp_doc->save();
            }
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
        $user = Auth::user();
        $hasher = app('hash');
        if ($hasher->check($request->input("inp_password"), $user->password)) {
            $id = $request->idD;
            $doc = Document::find($id);
            $doc->delete();
            return response()->json(['success' => "deleted", 'id' => $id]);;
        }
        else
            return response()->json(['success' => "not deleted"]);
        
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
        $workflow = $document->type_doc->workflow;
        $metas = $document->type_doc->metadonnees;
        $metasV = Metadonnee::join('metas_docs','metas_docs._idM','=','metadonnees.idM')
                                ->whereIn('metadonnees.idM',$metas)
                                ->get(); 
        $contributeursU = User::join('actions','actions.a_idU','=','users.id')
                                ->where('a_idW',$workflow->idWf)
                                ->select('users.*')
                                ->distinct('users.id')
                                ->get(); 
        $contributeursG = Groupe::join('actions','actions.a_idG','=','groupes.idG')
                                ->where('a_idW',$workflow->idWf)
                                ->select('groupes.*')
                                ->distinct('groupes.id')
                                ->get(); 
        $actionsDoc = $workflow->actions->pluck('idA');  
        $encours = Tache::whereIn('t_idA',$actionsDoc)->where('etatT',1)->get(); 
        $contributeursUG = null; 
        foreach ($contributeursG as $grp) {
            $contributeursUG = $grp->users;
        }  
         
        $droitsG = GroupeDoc::join('groupes','groupes.idG','=','groupes_docs._idG')
                            ->where('_idD',$id)
                            ->get();
                        
        return view('user.document',['doc' => $document,'versions' => $versions, 'contributeursU' => $contributeursU, 'contributeursG' => $contributeursG, 'encours' => $encours, 'metas' => $metas, 'droitsG' =>$droitsG]);
    }

    public static function actions($id,$document,$version) //$id
    {
        $doc = Document::find($id);

        $workflow = $doc->type_doc->workflow;
        $actionWf = $workflow->actions->pluck('idA');
        $conditionWf = $workflow->conditions->pluck('idC'); 

        $actionsS = Successeur::where('_idFrom','=',NULL)
                            ->wherein('_idTo',$actionWf)
                            ->pluck('_idTo');
        $conditionsS = CondSuccesseur::where('_idFrom','=',NULL)
                            ->wherein('_idTo',$conditionWf)
                            ->pluck('_idTo'); 

        foreach ($actionsS as $actionS ) {
            $action = Action::find($actionS);

            if($action->typeA == "Email")
            {
                if ($action->destinataireIA) {
                    $myEmail = $action->destinataireIA;

                    $details = array('body' => $action->messageA);
                    $obj = $action->objetA;
                    Mail::to($myEmail)->send(new SendMail($details,$obj));
                }elseif($action->a_destinataireU){
                    $recepteur  =  $action->a_destinataireU;
                    $emetteur =  $doc->user->id;
                    
                    $message=Message::create(['message'=>$action->messageA,'content'=>strip_tags($action->messageA),'sujet'=>$action->objetA,'from_id'=>$emetteur,'to_id'=>$recepteur]);


                    $details = [
                        'id_msg' => $message->idM ,
                        'message' => $message->message,
                        'sujet' => $message->sujet,
                        'sender' => $doc->user->id
                    ];

                    $user = User::find($recepteur);

                    Notification::send($user, new MsgNotification($details));
                }
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
                        $a = $tache->date_echeanceT = Date('d/m/Y H:i:s', strtotime('+'.$action->date_limiteA.' hours'));
                        break;
                    case 'm':
                        $a = $tache->date_echeanceT = Date('d/m/Y H:i:s', strtotime('+'.$action->date_limiteA.' minutes'));
                        break;
                } 
                $b = DateTime::createFromFormat('d/m/Y H:i:s', $a);
                switch ($action->opt_rappelA) {
                    case 'j':
                       $rappel = date_sub($b,date_interval_create_from_date_string($action->date_rappelA.' days')); 
                       break;
                    case 'h':
                        $rappel = date_sub($b,date_interval_create_from_date_string($action->date_rappelA.' hours'));
                        break;
                    case 'm':
                        $rappel = date_sub($b,date_interval_create_from_date_string($action->date_rappelA.' minutes'));
                        break;
                } 
                $tache->date_rappelT = date_format($rappel,"d/m/Y H:i:s");
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
            //cond comp foreach   
            
        }

        foreach ($conditionsS as $conditionS) {
            $cond = Condition::find($conditionS);


                $result= static::testCondition($cond,$doc); 
                $nextA_oui = $cond->_idAo;
                $nextA_non = $cond->_idAn;
                $nextC_oui = $cond->_idCo;
                $nextC_non = $cond->_idCn;
                if($result == 1)
                {
                    if($nextA_oui)
                        static::nextCondition($nextA_oui,$id,NUll);
                    else if($nextC_oui)
                        static::nextConditionCond($nextC_oui,$doc);
                }
                else if($result == 0)
                    if($nextA_non)
                        static::nextCondition($nextA_non,$id,NULL);
                    else if($nextC_non)
                        static::nextConditionCond($nextC_non,$doc);
        }
        return response()->json(['success' => "created", 'document' => $document, 'version' => $version]);

    }

    public static function nextActions($id,$doc,$idT) //$doc = idD
    {
        $action = Action::find($id); 
         
        $actionsS = Successeur::where('_idFrom','=',$id) 
                                ->whereNotNull('_idTo')
                                ->pluck('_idTo');
        $conditionsS = CondSuccesseur::where('_idFrom','=',$id) 
                                ->pluck('_idTo');
        $document = Document::find($doc);

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
                        static::nextConditionCond($nextC_oui,$document);
                }
                else if($tacheApp->Etat_avcT == 'Rejeter')
                    if($nextA_non)
                        static::nextCondition($nextA_non,$doc,$action);
                    else if($nextC_non)
                        static::nextConditionCond($nextC_non,$document);
            }else{
                $document = Document::find($doc);
                $result= static::testCondition($cond,$document);
                $nextA_oui = $cond->_idAo;
                $nextA_non = $cond->_idAn;
                $nextC_oui = $cond->_idCo;
                $nextC_non = $cond->_idCn;
                if($result == 1)
                {
                    if($nextA_oui)
                        static::nextCondition($nextA_oui,$doc,NUll);
                    else if($nextC_oui)
                        static::nextConditionCond($nextC_oui,$document);
                }
                else if($result == 0)
                    if($nextA_non)
                        static::nextCondition($nextA_non,$doc,NULL);
                    else if($nextC_non)
                        static::nextConditionCond($nextC_non,$document);
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
                    $document = Document::find($doc);
                    if ($act->destinataireIA) {
                        $myEmail = $act->destinataireIA;
                        
                        $details = array('body' => $act->messageA);
                        $obj = $act->objetA;
                        Mail::to($myEmail)->send(new SendMail($details,$obj)); 
                    }elseif($act->a_destinataireU){
                        $recepteur  =  $act->a_destinataireU;
                        $emetteur =  $document->user->id;
                        
                        $message=Message::create(['message'=>$act->messageA,'content'=>strip_tags($act->messageA),'sujet'=>$act->objetA,'from_id'=>$emetteur,'to_id'=>$recepteur]);
    
    
                        $details = [
                            'id_msg' => $message->idM ,
                            'message' => $message->message,
                            'sujet' => $message->sujet,
                            'sender' => $document->user->id
                        ];
    
                        $user = User::find($recepteur);
    
                        Notification::send($user, new MsgNotification($details));
                    }  
                    static::nextActions($act->idA,$doc,null);

                }
                else
                {
                    $tache = new Tache;
                    $tache->t_idA = $actionS;
                    $tache->t_idD = $doc;
                    switch ($act->opt_limiteA) {
                        case 'j':
                            $a = $tache->date_echeanceT = Date('d/m/Y H:i:s', strtotime('+'.$act->date_limiteA.' days'));
                            break;
                        case 'h':
                            $a = $tache->date_echeanceT = Date('d/m/Y H:i:s', strtotime('+'.$act->date_limiteA.' hours'));
                            break;
                        case 'm':
                            $a = $tache->date_echeanceT = Date('d/m/Y H:i:s', strtotime('+'.$act->date_limiteA.' minutes'));
                            break;
                    } 
                    $b = DateTime::createFromFormat('d/m/Y H:i:s', $a);
                    switch ($act->opt_rappelA) {
                        case 'j':
                        $rappel = date_sub($b,date_interval_create_from_date_string($act->date_rappelA.' days')); 
                        break;
                        case 'h':
                            $rappel = date_sub($b,date_interval_create_from_date_string($act->date_rappelA.' hours'));
                            break;
                        case 'm':
                            $rappel = date_sub($b,date_interval_create_from_date_string($act->date_rappelA.' minutes'));
                            break;
                    } 
                    $tache->date_rappelT = date_format($rappel,"d/m/Y H:i:s"); 
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

    public static function nextCondition($next,$doc,$action) //$doc=idD
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
                $document = Document::find($doc);
                if ($act->destinataireIA) {
                    $myEmail = $act->destinataireIA;

                    $details = array('body' => $act->messageA);
                    $obj = $act->objetA;
                    Mail::to($myEmail)->send(new SendMail($details,$obj));
                }elseif($act->a_destinataireU){
                    $recepteur  =  $act->a_destinataireU;
                    $emetteur =  $document->user->id;
                    
                    $message=Message::create(['message'=>$act->messageA,'content'=>strip_tags($act->messageA),'sujet'=>$act->objetA,'from_id'=>$emetteur,'to_id'=>$recepteur]);


                    $details = [
                        'id_msg' => $message->idM ,
                        'message' => $message->message,
                        'sujet' => $message->sujet,
                        'sender' => $document->user->id
                    ];

                    $user = User::find($recepteur);

                    Notification::send($user, new MsgNotification($details));
                }
                


                static::nextActions($act->idA,$doc,null);

            }
            else
            {
                $tache = new Tache;
                $tache->t_idA = $next;
                $tache->t_idD = $doc;
                switch ($act->opt_limiteA) {
                    case 'j':
                        $a = $tache->date_echeanceT = Date('d/m/Y H:i:s', strtotime('+'.$act->date_limiteA.' days'));
                        break;
                    case 'h':
                        $a = $tache->date_echeanceT = Date('d/m/Y H:i:s', strtotime('+'.$act->date_limiteA.' hours'));
                        break;
                    case 'm':
                        $a = $tache->date_echeanceT = Date('d/m/Y H:i:s', strtotime('+'.$act->date_limiteA.' minutes'));
                        break;
                } 
                $b = DateTime::createFromFormat('d/m/Y H:i:s', $a);
                switch ($act->opt_rappelA) {
                    case 'j':
                       $rappel = date_sub($b,date_interval_create_from_date_string($act->date_rappelA.' days')); 
                       break;
                    case 'h':
                        $rappel = date_sub($b,date_interval_create_from_date_string($act->date_rappelA.' hours'));
                        break;
                    case 'm':
                        $rappel = date_sub($b,date_interval_create_from_date_string($act->date_rappelA.' minutes'));
                        break;
                } 
                $tache->date_rappelT = date_format($rappel,"d/m/Y H:i:s");
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

    public static function nextConditionCond($next,$doc)  //$doc=Document
    {
        $cond = Condition::find($next);

        if($cond->typeC == "condApp")
        {
            $actApp = Action::find($cond->c_idA);
            $tacheApp = Tache::where('t_idA',$cond->c_idA)->where('t_idD',$doc->idD)->whereNotNull('Etat_avcT')->orderBy('updated_at', 'desc')->first();;
            $nextA_oui = $cond->_idAo;
            $nextA_non = $cond->_idAn;
            $nextC_oui = $cond->_idCo;
            $nextC_non = $cond->_idCn;
            if($tacheApp->Etat_avcT == 'Accepter')
            {
                if($nextA_oui)
                    static::nextCondition($nextA_oui,$doc->idD,$action);
                else if($nextC_oui)
                    static::nextConditionCond($nextC_oui,$doc);//faux
            }
            else if($tacheApp->Etat_avcT == 'Rejeter')
                if($nextA_non)
                    static::nextCondition($nextA_non,$doc->idD,$action);
                else if($nextC_non)
                    static::nextConditionCond($nextC_non,$doc);//faux
        }else{
            $result= static::testCondition($cond,$doc);
            $nextA_oui = $cond->_idAo;
            $nextA_non = $cond->_idAn;
            $nextC_oui = $cond->_idCo;
            $nextC_non = $cond->_idCn;
            if($result == 1)
            {
                if($nextA_oui)
                    static::nextCondition($nextA_oui,$doc->idD,NUll);
                else if($nextC_oui)
                    static::nextConditionCond($nextC_oui,$doc);
            }
            else if($result == 0)
                if($nextA_non)
                    static::nextCondition($nextA_non,$doc->idD,NULL);
                else if($nextC_non)
                    static::nextConditionCond($nextC_non,$doc);
        }
    }

    public static function testCondition($condition,$document) //$document = Document
    {
        $rq = $condition->formuleC;
        $doc = $document->idD;
        $rq =str_replace('$doc',$doc,$rq);
        
        $metas=DB::select("$rq");
        
        if (count($metas)>1) {
            $r = 1;
            foreach ($metas as $meta) {
                if($r || $meta)
                    $x=1;
                else
                    $x=0;
            }
            return $x;  
        }else if(count($metas) == 0){
            return 0;
        }else{
            if($metas[0]->cpt == 1)
                return 1;
            else
                return 0;
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

        if($tache->action->a_idU)
            $user_tache->_idU = $tache->action->user->id;
        else if($tache->action->a_idG)
            $user_tache->_idU = $tache->t_idU;

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

        $actMeta = ActionMeta::join('metadonnees','metadonnees.idM','=','actions_metas._idM')->where('_idA',$tache->action->idA)->get();
        if($actMeta)
            foreach ($actMeta as $meta ) {
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
            $userRoles = Auth::user()->roles->pluck('nomR');
            $id = Auth::user()->id; //Auth
            $user = User::find($id);
            $docsU = $user->documents->pluck('idD');
            $groupes = $user->groupes; 
            $groupesID = $user->groupes->pluck('idG'); 
            $docsG = GroupeDoc::whereIn('_idG',$groupesID)->pluck('_idD'); 

            //METAS

            if ($request->search == '' ) {
                if($userRoles->contains('admin'))
                    $metas = Document::all();
                else if($userRoles->contains('user'))
                {
                    $metas = Document::whereIn('idD',$docsG)->orwhereIn('idD',$docsU)->distinct()->get();
                }

                //$metas = Document::all();
                $productsM = $metas->pluck('idD');

            } else {
                $productsM= Metadonnee::join('metas_docs','metas_docs._idM','=','metadonnees.idM')
                            ->where('libelleM','LIKE','%'.$request->search."%")
                            ->orwhere('valeur','LIKE','%'.$request->search."%")
                            ->pluck('_idD');
            }

            //TYPE

            if ($request->input('typeD') == '' ) {
                if($userRoles->contains('admin'))
                    $types = TypeDoc::all()->pluck('idTd');
                else if($userRoles->contains('user'))
                    $types = Document::where('d_idU',Auth::user()->id)->orwhereIn('idD',$productsM)->distinct()->pluck('d_idTd');
            } else {
                $types = $request->input('typeD'); 
            }

            //ETAT

            if ($request->input('etatD') == '' ) {
                $etat = ['actif' , 'archive'];
            } else {
                $etat = $request->input('etatD'); 
            }

            if($userRoles->contains('admin'))
            {
                $docs = Document::join('users','users.id','=','documents.d_idU')
                        ->join('versions','versions.v_idD','=','documents.idD')
                        ->whereIn('idD',$productsM)->whereIn('d_idTd',$types)
                        ->whereIn('etatD',$etat)
                        ->get()
                        ->keyBy('idD');; 
            } else if($userRoles->contains('user'))
            {
                $docs = Document::join('users','users.id','=','documents.d_idU')
                        ->join('versions','versions.v_idD','=','documents.idD')
                        ->where(function($q) use ($docsG,$docsU){
                            $q->whereIN('idD',$docsG)
                              ->orWhereIn('idD',$docsU);
                        })
                        ->whereIn('idD',$productsM)->whereIn('d_idTd',$types)
                        ->whereIn('etatD',$etat)
                        ->get()
                        ->keyBy('idD');;
            }
                
            return response()->json(['success' => "deleted", 'docs' => $docs, 'p'=> $productsM, 't' =>$types]);;
        }
    }

    public function archiver(Request $request)
    {
        $document=Document::find($request->input('docArchi'));
        $document->etatD = 'archivé';
        $document->save();
    }

}
