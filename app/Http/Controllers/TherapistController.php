<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rules;
use App\Models\Recommendations;
use App\Models\Expert;
use App\Models\Journal;
use Hash;
use Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\TwoFA_Login;
use App\Mail\ForgotPassword;
use App\Helpers\RandomCodeGenerator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;

class TherapistController extends Controller
{
    public function studentprogress(){
        $user_id= Session::get('loginId');
        $userdata=User::where('id','=',Session::get('loginId'))->first();
        $user=User::where('role','student')->latest()->get();
        // simplePaginate(1);


        return view('Panel.therapist.progress.studentProgress',compact('userdata','user'));
    }

    public function viewstudent(Request $request,$id){
        $expdata=Expert::where('user_id',$id)->latest()->get();
        $user=User::find($id);
        $userdata=User::where('id','=',Session::get('loginId'))->first();
        $scores=Expert::where('user_id',$id)->sum('LSAS_score');
        $scorecount=Expert::select('LSAS_score')->where('user_id',$id)->count();
        $averageLSAS;
        if($scorecount==0){
            $averageLSAS=0;
        }
        else{
            $averageLSAS=round( $scores/intval($scorecount));
        }

        $LSAS_scores = [];
        $created_at = [];
       
        $lsas=Expert::select('LSAS_score')->where('user_id','=',$id)->get();
        foreach ($lsas as $lsas) {
        $LSAS_scores [] = $lsas;
        }
        
        $createdAt=Expert::select('created_at')->where('user_id','=',$id)->get();
        foreach ($createdAt as $createdAt) {
        $created_at [] = $createdAt;
        }

        return view('Panel.therapist.progress.viewprogress',compact('user','userdata','averageLSAS','expdata','LSAS_scores','created_at'));
    }

    public function viewstudentdiagnosis(Request $request,$exp_id){
        $expdata=Expert::find($exp_id);
        $user_id= Session::get('loginId');
        $userdata=User::where('id','=',Session::get('loginId'))->first();
        $diagnosis=Recommendations::select('Recommendation')->where('Recommendations_id',$expdata->recommend_id)->get();
        $recommendation=$diagnosis[0]['Recommendation'];
     
       return view('Panel.therapist.progress.viewstudentdiagnosis',compact('userdata','expdata','recommendation'));
    
    }
    public function  viewstudentjournals(){
        $user_id= Session::get('loginId');
        $userdata=User::where('id','=',Session::get('loginId'))->first();
        $user=User::where('role','student')->latest()->get();
        return view('Panel.therapist.journal.viewstudentjournals',compact('userdata','user'));

    }
    public function studentjournals(Request $request,$id){
        $user_id= Session::get('loginId');
        $userdata=User::where('id','=',Session::get('loginId'))->first();
        $user=User::find($id);
      

        $journal=Journal::where('user_id','=',$id)->latest()->get();
     
        return view('Panel.therapist.journal.studentjournals',compact('userdata','user','journal'));
    }
    public function viewindividualjournal(Request $request,$Journal_id){
        $journal=Journal::find($Journal_id);
        $userdata=User::where('id','=',Session::get('loginId'))->first();
     
        return view('panel.therapist.journal.journalview',compact('userdata','journal')); 
    }
}
