<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\support\Facades\DB;
use App\User;
use App\Mail\SendMail;
use Mail;
use Auth;

class rappelTache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rappel:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rappel tâche';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /* $users = User::all();
        $currentDateTime = date('d/m/Y H:i:s');
        foreach ($users as $user) {
            $actions = $user->actions;
            if($actions->count()>0)
                foreach ($actions as $action ) {
                    $taches = $action->taches;
                    if($taches->count()>0)
                        foreach ($taches as $tache) {
                            if($tache->etatT== 1 && $tache->date_rappelT == $currentDateTime){
                                $myEmail = $user->emailPersoU;
                                $message = 'vite';
                                $details = array('body' => $message);
                                $obj = 'rappel';
                                Mail::to($myEmail)->send(new SendMail($details,$obj)); 
                            }

                        }
                }
        } */
        $myEmail = "hkalfat@gmail.com";
        $message = 'vite';
        $details = array('body' => $message);
        $obj = 'rappel';
        Mail::to($myEmail)->send(new SendMail($details,$obj)); 
    }
}
