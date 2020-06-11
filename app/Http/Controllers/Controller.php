<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Http\Request;
use App\Mail\SendMail;
use Mail;
use App\Action;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function myDemoMail()
    {
        $myEmail = 'hkalt@gmail.com';
   
        $action = Action::find(21);
        $details =array(
            'title' => $action->objetA,
            'body' => $action->messageA
        );return $details;

        \Mail::to($myEmail)->send(new SendMail($details));
        return view('emails.sendMail');
    
    }
}
