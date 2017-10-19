<?php

namespace App\Http\Controllers;

use App\User;
use App\Mail\NewQuestion;
use Illuminate\Http\Request;


class QuestionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
      
        
    }
    
    /**
     * questions.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validate(request(), [
            'modal_questions_subject' => 'required|string|max:255',
            'modal_questions_msg' => 'required|string',

            
            
        ]
        );

        $dataMessage = request()->all();
        //dd($dataMessage);
        //$partner = User::find($dataMessage['partner']);
        //$user = User::find($dataMessage['user']);

        $dataMessage['questionUser'] = auth()->user(); 

        try {
            
            \Mail::to($dataMessage['partner'])->send(new NewQuestion($dataMessage));
            
            if($dataMessage['user'])
                \Mail::to($user)->send(new NewQuestion($dataMessage));

          return 'ok';

        }catch (\Swift_TransportException $e)  //Swift_RfcComplianceException
        {
            \Log::error($e->getMessage());
        }

       
    }

    
    
}
