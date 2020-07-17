<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
use App\Notifications\MsgNotification;
use Illuminate\Notifications\DatabaseNotification;

use App\User;
use App\Message;
use App\Media;
use App\Mail\SendMail;
use File;
use Auth;
use Notification;
use Mail;

class MailBoxController extends Controller
{
    public function index()
    {
        Auth::user()->unreadNotifications->where('type','App\Notifications\MsgNotification')->markAsRead();
        $users = User::all();
        $messages = Message::where('save',0)->where('delete',0)->where('to_id',Auth::user()->id)->orderBy('created_at','desc')->get();
        $msgEnvoyés = Message::where('from_id',Auth::user()->id)->where('delete',0)->where('save',0)->get();
        $brouillons = Message::where('save',1)->where('delete',0)->get();
        $corbeilles = Message::where('delete',1)->get();

        return view('Messagerie.mailbox', ['users' => $users, 'messages' => $messages, 'msgEnvoyés' => $msgEnvoyés, 'brouillons' => $brouillons, 'corbeilles' => $corbeilles] );
    }

    function  envoyer(Request $request){
        $recepteur  =  $request->input('destinataire');
        $emetteur =  Auth::user()->id;
        
        $message=Message::create(['message'=>$request->input('message'),'content'=>$request->input('messageTxt'),'sujet'=>$request->input('sujet'),'from_id'=>$emetteur,'to_id'=>$recepteur]);

        $nbr=0;   
        if($request->hasFile('files')){
      	
            foreach ($request->file('files') as $file) {
                $name = $file->getClientOriginalName();
            
                $fileName = uniqid().$file->getClientOriginalName();
                $file->move(public_path('msg'),$fileName);


                $media = Media::create(['fileName'=>$name,'file'=>$fileName,'_idM'=> $message->idM]);
                $nbr++;  
            }
                
        }

        $details = [
            'id_msg' => $message->idM ,
            'message' => $message->message,
            'sujet' => $message->sujet,
            'sender' => Auth::user()->id
        ];

        $user = User::find($recepteur);

        Notification::send($user, new MsgNotification($details));

        return redirect('/mailbox');
    }

    function  enregistrer(Request $request){

        return 0;
        /* if( $request->input('exist') == 0 )
        $recepteur  =  $request->input('destinataire');
        $emetteur =  Auth::user()->id;
        
        $message=Message::create(['message'=>$request->input('message'),'content'=>$request->input('messageTxt'),'sujet'=>$request->input('sujet'),'from_id'=>$emetteur,'to_id'=>$recepteur, 'save' => 1]);

        $nbr=0;   
        if($request->hasFile('files')){
      	
            foreach ($request->file('files') as $file) {
                $name = $file->getClientOriginalName();
            
                $fileName = uniqid().$file->getClientOriginalName();
                $file->move(public_path('msg'),$fileName);


                $media = Media::create(['fileName'=>$name,'file'=>$fileName,'_idM'=> $message->idM]);
                $nbr++;  
            }
                
        }

        $details = [
            'id_msg' => $message->idM ,
            'message' => $message->message,
            'sujet' => $message->sujet,
            'sender' => Auth::user()->id
        ];

        $user = User::find($recepteur);

        Notification::send($user, new MsgNotification($details));

        return redirect('/mailbox'); */
    }

    function  supprimer(Request $request){

        $id = $request->input('msg_dlt');
        $msg = Message::find($id);
        $msg->delete = 1;
        $msg->save();
        return response()->json(['success' => "deleted" , "id" => $id ]);
    }
}
