<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rules;
use App\Models\Recommendations;
use App\Models\Expert;
use App\Models\Journal;
use App\Models\Therapist;
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
use Illuminate\Support\Facades\Auth;

class TherapistController extends Controller
{
    public function studentprogress(){
        $user_id= Session::get('loginId');
        $userdata=User::where('id','=',Session::get('loginId'))->first();
        $user=User::where('role','student')->latest()->simplePaginate(12);
        // simplePaginate(1);


        return view('Panel.therapist.progress.studentProgress',compact('userdata','user'));
    }

    public function viewstudent(Request $request,$id){
        $expdata=Expert::where('user_id',$id)->latest()->simplePaginate(8);
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
        $user=User::where('role','student')->latest()->simplePaginate(12);
        return view('Panel.therapist.journal.viewstudentjournals',compact('userdata','user'));

    }
    public function studentjournals(Request $request,$id){
        $user_id= Session::get('loginId');
        $userdata=User::where('id','=',Session::get('loginId'))->first();
        $user=User::find($id);
      

        $journal=Journal::where('user_id','=',$id)->latest()->simplePaginate(12);
     
        return view('Panel.therapist.journal.studentjournals',compact('userdata','user','journal'));
    }
    public function viewindividualjournal(Request $request,$Journal_id){
        $journal=Journal::find($Journal_id);
        $userdata=User::where('id','=',Session::get('loginId'))->first();
     
        return view('panel.therapist.journal.journalview',compact('userdata','journal')); 
    }

    public function therapistprofile(){
        $userdata=User::where('id','=',Session::get('loginId'))->first();
        $therapist=Therapist::where('user_id',Auth::User()->id)->get();
        return view('Panel.therapist.profile.profile',compact('userdata','therapist'));
    }


    public function profileview(Request $request,$therapist_id){
        $therapist=Therapist::find($therapist_id);
        $userdata=User::where('id','=',Session::get('loginId'))->first();
        return view('Panel.therapist.profile.profileview',compact('userdata','therapist'));
    }
    public function createtherapistprofile(Request $request){
        if($request->isMethod('get')){
        $userdata=User::where('id','=',Session::get('loginId'))->first();

          
        return view('Panel.therapist.profile.create',compact('userdata'));
        }  
        if ($request->isMethod('post'))
        {  $request->validate([
            'specialization' => 'title',
            'specialization' => 'required',
            'location' => 'required',
            'profile_img' => 'required|image|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
        ]);
           

            $therapist=new Therapist;
            $therapist->user_id=Auth::User()->id;
            $therapist->Full_name=Auth::User()->full_name;
            $therapist->email=Auth::User()->email;
            $therapist->phone=Auth::User()->phone;

            $therapist->Location=$request->location;
            $therapist->title=$request->title;
            $therapist->specialization=$request->specialization;
            $therapist->bio=$request->bio;

            $profile_img=$request->profile_img;

            if($profile_img){
                  $imagename=time().'.'.$profile_img->getClientOriginalExtension();
            
                  $profile_img->move('therapist_img',$imagename);
            
                  $therapist->profile_img= $imagename;
                  }

            $therapist->save();
            return redirect('therapistprofile')->with('success','Profile is created');

       
        } 
    }


    public function updateprofile(Request $request,$therapist_id){
        if($request->isMethod('get')){
        $userdata=User::where('id','=',Session::get('loginId'))->first();
        $therapist=Therapist::find($therapist_id);
          
        return view('Panel.therapist.profile.update',compact('userdata','therapist'));
        }  
        if ($request->isMethod('post'))
        {  $request->validate([
            'specialization' => 'title',
            'specialization' => 'required',
            'location' => 'required',
            'profile_img' => 'image|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
        ]);
           

            $therapist=Therapist::find($therapist_id);
            $therapist->user_id=Auth::User()->id;
            $therapist->Full_name=Auth::User()->full_name;
            $therapist->email=Auth::User()->email;
            $therapist->phone=Auth::User()->phone;

            $therapist->Location=$request->location;
            $therapist->title=$request->title;
            $therapist->specialization=$request->specialization;
            $therapist->bio=$request->bio;

            $profile_img=$request->profile_img;

            if(!$profile_img){
            
            }
                
            else{
                  $imagename=time().'.'.$profile_img->getClientOriginalExtension();
            
                  $profile_img->move('therapist_img',$imagename);
            
                  $therapist->profile_img= $imagename;
                  }

            $therapist->save();
            return redirect('therapistprofile')->with('success','Profile is Updated');

       
        } }






public function deleteprofile(Request $request,$therapist_id){
$therapist=Therapist::find($therapist_id);
$therapist->delete();
return redirect('therapistprofile')->with('warning','Profile has been deleted');
    }
}
