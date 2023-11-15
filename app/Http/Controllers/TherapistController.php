<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rules;
use App\Models\Recommendations;
use App\Models\Expert;
use App\Models\Journal;
use App\Models\Therapist;
use App\Models\Appointments;
use App\Models\Choosetherapist;
use App\Models\Notifications;
use App\Models\Timeslot;
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
use Barryvdh\DomPDF\Facade\Pdf;
class TherapistController extends Controller
{

public function countNot(){
$notCount=Notifications::where('therapist_id',Auth::user()->id)->count();  
return view('Panel.therapist.header',compact('notCount'));
}



//Notifcations
public function markread($NotID){
  $not=Notifications::find($NotID);
  $not->Mark_read='read';
  $not->update();
return redirect()->back()->with('success','Notification is marked as Read');
}

public function markunread($NotID){
  $not=Notifications::find($NotID);
  $not->Mark_read='unread';
  $not->update();
return redirect()->back()->with('warning','Notification is marked as Unread'); 
}
public function deletenotification($NotID){
  $not=Notifications::find($NotID);
  $not->delete();
return redirect()->back()->with('Error','Notification is deleted');
}
//End of Notifications
public function therapistnotifications()
{
$userdata=User::where('id','=',Session::get('loginId'))->first();
$not=Notifications::where('therapist_id',Auth::user()->id)->get();
return view('Panel.therapist.notifications',compact('not','userdata'));


  }

 public function  myclients(){
  $choose=Choosetherapist::where('therapist_id',Auth::user()->id)->latest()->simplepaginate(15);
  $userdata=User::where('id','=',Session::get('loginId'))->first();
return view('Panel.therapist.myclients',compact('userdata','choose'));
  }
  public function  acceptclient($ChooseID){
    $choose=Choosetherapist::find($ChooseID);
    $choose->selection_status='selected';
    $choose->application_status='accepted';
    $choose->save();
    return redirect()->back()->with('success','Student`s application has been Accepted');
  }
  public function  rejectclient($ChooseID){
    $choose=Choosetherapist::find($ChooseID);
    $choose->selection_status='deselected';
    $choose->application_status='rejected';
    $choose->save();
  return redirect()->back()->with('warning','Student`s application has been Rejected');
  }
    public function appointmentcreate(Request $request){
        $appointment=new Appointments;
        //$appointment->user_id=Auth::User()->id;
        $appointment->user_id=$request->user_id;
        $appointment->Therapists_id=$request->Therapists_id;
        $appointment->appointment_date=$request->appointment_date;
        $appointment->student_email=$request->student_email;
        $appointment->time=$request->time;
        $appointment->onlinelink=$request->onlinelink;
        $appointment->location=$request->location;
       
        $appointment->save();
        return redirect()->back()->with('success','Appointment for the User has been created');

    }
    public function studentpdfview($id){
        $user=User::find($id);
        $user_id= Session::get('loginId');
        $userdata=User::where('id','=',Session::get('loginId'))->first();
        $expdata=Expert::where('user_id',$id)->latest()->get();
        $very_severe=Expert::where('user_id',$id)->where('socialanxiety_level','very_severe')->count();
        $severe=Expert::where('user_id',$id)->where('socialanxiety_level','severe')->count();
        $marked=Expert::where('user_id',$id)->where('socialanxiety_level','marked')->count();
        $moderate=Expert::where('user_id',$id)->where('socialanxiety_level','moderate')->count();
        $mild=Expert::where('user_id',$id)->where('socialanxiety_level','mild')->count();
         if($very_severe==0)
         {
           $very_severe=0;
         }
         if($severe==0)
         {
           $severe=0;
         }
         if($marked==0)
         {
           $marked=0;
         }
         if($moderate==0)
         {
           $moderate=0;
         }
         if($mild==0)
         {
           $mild=0;
         }
    
        $scores=Expert::where('user_id',$id)->sum('LSAS_score');
        $scorecount=Expert::select('LSAS_score')->where('user_id',$id)->count();
        $averageLSAS;
        if($scorecount==0){
            $averageLSAS=0;
        }
        else{
            $averageLSAS=round( $scores/intval($scorecount));
        }
    
        // orderBy('desc')
        // ->where('user_id',$user_id)
    
        $LSAS_scores = [];
        $created_at = [];
       
        $lsas=Expert::select('LSAS_score')->where('user_id','=',$user_id)->get();
        foreach ($lsas as $lsas) {
        $LSAS_scores [] = $lsas;
        }
        
        $createdAt=Expert::select('created_at')->where('user_id','=',$user_id)->get();
        foreach ($createdAt as $createdAt) {
        $created_at [] = $createdAt;
        }
        // print_r($created_at);
        return view('Panel.therapist.PDF.studentprogresspdfview',compact(
        'user',
        'userdata',
        'expdata',
        'LSAS_scores',
        'created_at', 
        'averageLSAS', 
        'very_severe',
        'severe',
        'marked',
        'moderate',
        'mild'
            ));
    }
    
    
    
    
    
    
    
    
    public function studentprogresspdf($id){
       
        $user=User::find($id);
        $user_id= Session::get('loginId');
        $userdata=User::where('id','=',Session::get('loginId'))->first();
        $expdata=Expert::where('user_id',$id)->latest()->get();
        $very_severe=Expert::where('user_id',$id)->where('socialanxiety_level','very_severe')->count();
        $severe=Expert::where('user_id',$id)->where('socialanxiety_level','severe')->count();
        $marked=Expert::where('user_id',$id)->where('socialanxiety_level','marked')->count();
        $moderate=Expert::where('user_id',$id)->where('socialanxiety_level','moderate')->count();
        $mild=Expert::where('user_id',$id)->where('socialanxiety_level','mild')->count();
         if($very_severe==0)
         {
           $very_severe=0;
         }
         if($severe==0)
         {
           $severe=0;
         }
         if($marked==0)
         {
           $marked=0;
         }
         if($moderate==0)
         {
           $moderate=0;
         }
         if($mild==0)
         {
           $mild=0;
         }
    
        $scores=Expert::where('user_id',$id)->sum('LSAS_score');
        $scorecount=Expert::select('LSAS_score')->where('user_id',$id)->count();
        $averageLSAS;
        if($scorecount==0){
            $averageLSAS=0;
        }
        else{
            $averageLSAS=round( $scores/intval($scorecount));
        }
    
        // orderBy('desc')
        // ->where('user_id',$user_id)
    
        $LSAS_scores = [];
        $created_at = [];
       
        $lsas=Expert::select('LSAS_score')->where('user_id','=',$user_id)->get();
        foreach ($lsas as $lsas) {
        $LSAS_scores [] = $lsas;
        }
        
        $createdAt=Expert::select('created_at')->where('user_id','=',$user_id)->get();
        foreach ($createdAt as $createdAt) {
        $created_at [] = $createdAt;
        }
            $pdf = Pdf::loadView('Panel.therapist.PDF.studentprogresspdfview',[
               'user'=>$user ,
            'userdata'=>$userdata,
            'expdata'=>$expdata,
            'LSAS_scores'=>$LSAS_scores,
            'created_at'=>$created_at,
            'averageLSAS'=>$averageLSAS,
            'very_severe'=>$very_severe,
            'severe'=>$severe,
            'marked'=>$marked,
            'moderate'=>$moderate,
            'mild'=>$mild,
            
            ]
            
        )->setOptions([
            'dpi'=>150,
            'defaultFont' => 'sans-serif',
            'isHtml5ParserEnabled' => true,
            // 'isPhpEnabled' => true,
            // 'isPhpDebug' => true,
        ]);
             $pdfName=$user->full_name;
            return $pdf->download("$pdfName Progress.pdf");
        
    }










    public function getrecommendations()
    {
    $userdata=User::where('id','=',Session::get('loginId'))->first();
      $rec=Recommendations::simplePaginate(9);
      return view('Panel.therapist.recommendations',compact('rec','userdata'));
    }
    public function getRecommendationDetails($Recommendations_id)
    {
        $rec = Recommendation::find($id);
        return view('Panel.therapist.modals.recommendationmodal',compact('rec'));
    }
    public function addrecommendation(Request $request,$Recommendations_id)
    {
        
            $rec=Recommendations::find($Recommendations_id);
            $rec->Recommendation=$request->recommendation;
            $rec->update();
            return redirect('getrecommendations')->with('success','Recommendation has been Added.');
     

    }
    public function studentprogress(){
        $user_id= Session::get('loginId');
        $userdata=User::where('id','=',Session::get('loginId'))->first();
      
        $choose=Choosetherapist::where('therapist_id',Auth::user()->id)->where('application_status','accepted')->get();
        // $user=User::where('id',$choose->student)->where('role','student')->latest()->simplePaginate(12);

        $user = [];
        foreach ($choose as $data) {
          $studentId = $data['student_id'];
      
          // Query the therapist profile based on the therapist ID
          $selected=User::where('id',$studentId)->latest()->first();
          // $therapistProfile = $selectedtherapist->where('user_id', $therapistId)->first();
      
          if ($selected) {
              // If a therapist profile is found, append it to the therapistProfiles array
              $user[] = $selected;
          }
      }
      
        // simplePaginate(1);


        return view('Panel.therapist.progress.studentProgress',compact('userdata','user'));
    }

    public function viewstudent(Request $request,$id){
        $expdata=Expert::where('user_id',$id)->latest()->simplePaginate(8);
        $user=User::find($id);
        $times=Timeslot::where('therapist_id',Auth::user()->id)->pluck('timeslot')->toArray();
        $userdata=User::where('id','=',Session::get('loginId'))->first();
        $latestexpdata=Expert::where('user_id',$id)->latest()->first();
        if(!$latestexpdata){
          $latestexpdata='no-data';
         }
       
        $very_severe=Expert::where('user_id',$id)->where('socialanxiety_level','very_severe')->count();
        $severe=Expert::where('user_id',$id)->where('socialanxiety_level','severe')->count();
        $marked=Expert::where('user_id',$id)->where('socialanxiety_level','marked')->count();
        $moderate=Expert::where('user_id',$id)->where('socialanxiety_level','moderate')->count();
        $mild=Expert::where('user_id',$id)->where('socialanxiety_level','mild')->count();
         if($very_severe==0)
         {
           $very_severe=0;
         }
         if($severe==0)
         {
           $severe=0;
         }
         if($marked==0)
         {
           $marked=0;
         }
         if($moderate==0)
         {
           $moderate=0;
         }
         if($mild==0)
         {
           $mild=0;
         }
    

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


        $address=Therapist::select('Location')->where('user_id',Auth::user()->id)->get();
        $location=$address[0]['Location'];
        return view('Panel.therapist.progress.viewprogress',compact(
          'times',
          'latestexpdata',
            'location',
            'user',
            'userdata',
            'averageLSAS',
            'expdata',
            'LSAS_scores',
            'created_at',
            'very_severe',
            'severe',
            'marked',
            'moderate',
            'mild'
        
        ));
    }

    public function viewstudentdiagnosis(Request $request,$exp_id){
        $expdata=Expert::find($exp_id);
        $user_id= Session::get('loginId');
        $userdata=User::where('id','=',Session::get('loginId'))->first();
        $diagnosis=Recommendations::select('Recommendation')->where('Recommendations_id',$expdata->recommend_id)->get();
        $recommendation=$diagnosis[0]['Recommendation'];
     
       return view('Panel.therapist.progress.viewstudentdiagnosis',
       compact(
        'userdata',
       'expdata',

       'recommendation',));
    
    }
    public function  viewstudentjournals(){
        $user_id= Session::get('loginId');
        $userdata=User::where('id','=',Session::get('loginId'))->first();
        //$user=User::where('role','student')->latest()->simplePaginate(12);

        $choose=Choosetherapist::where('therapist_id',Auth::user()->id)->where('application_status','accepted')->get();
        // $user=User::where('id',$choose->student)->where('role','student')->latest()->simplePaginate(12);
        $user = [];
        foreach ($choose as $data) {
          $studentId = $data['student_id'];
      
          // Query the therapist profile based on the therapist ID
          $selected=User::where('id',$studentId)->latest()->first();
          // $therapistProfile = $selectedtherapist->where('user_id', $therapistId)->first();
      
          if ($selected) {
              // If a therapist profile is found, append it to the therapistProfiles array
              $user[] = $selected;
          }
        }
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
      //   $zoom = new \MacsiDigital\Zoom\Support\Entry;
      //   $user = new \MacsiDigital\Zoom\User($zoom);
      // dd( $user) ;
        return view('Panel.therapist.profile.profile',compact('userdata','therapist'));
    }


    public function profileview(Request $request,$therapist_id){
        $therapist=Therapist::find($therapist_id);
        $userdata=User::where('id','=',Session::get('loginId'))->first();
        return view('Panel.therapist.profile.profileview',compact('userdata','therapist'));
    }
    public function createtherapistprofile(Request $request){
        if($request->isMethod('get')){
          $therapist=Therapist::where('user_id',Auth::User()->id)->get();
        $userdata=User::where('id','=',Session::get('loginId'))->first();

          
        return view('Panel.therapist.profile.create',compact('userdata','therapist'));
        }  
        if ($request->isMethod('post'))
        {  $request->validate([
            'title' => 'required',
            'credential' => 'required',
            'specialization' => 'required',
            'location' => 'required',
            'profile_img' => 'required|image|dimensions:min_width=50,min_height=50,max_width=1000,max_height=1000',

            'credential_img' => 'required|image|dimensions:min_width=50,min_height=50,max_width=1000,max_height=1000',
            // 'spec_img' => 'required|image|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
        ]);
           

            $therapist=new Therapist;
            $therapist->user_id=Auth::User()->id;
            $therapist->Full_name=Auth::User()->full_name;
            $therapist->email=Auth::User()->email;
            $therapist->phone=Auth::User()->phone;

            $therapist->Location=$request->location;
            $therapist->title=$request->title;
            $therapist->specialization=$request->specialization;
            $therapist->credential=$request->credential;

            $therapist->bio=$request->bio;

            $profile_img=$request->profile_img;
            $credential_img=$request->credential_img;
            $spec_img=$request->spec_img;

            if($profile_img){
                  $imagename=time().'.'.$profile_img->getClientOriginalExtension();
            
                  $profile_img->move('therapist_img',$imagename);
            
                  $therapist->profile_img= $imagename;
              }

              if($credential_img){
                $imagename=time().'.'.$credential_img->getClientOriginalExtension();
          
                $credential_img->move('credential',$imagename);
          
                $therapist->credential_img= $imagename;
            }

            if($spec_img){
              $imagename=time().'.'.$spec_img->getClientOriginalExtension();
        
              $spec_img->move('specialization',$imagename);
        
              $therapist->spec_img= $imagename;
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
          'title' => 'required',
          'credential' => 'required',
          'specialization' => 'required',
          'location' => 'required',
           'profile_img' => 'image|dimensions:min_width=50,min_height=50,max_width=1000,max_height=1000',

          'credential_img' => 'image|dimensions:min_width=50,min_height=50,max_width=1000,max_height=1000',
          // 'spec_img' => 'required|image|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
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
          
            $credential_img=$request->credential_img;
            $spec_img=$request->spec_img;

            if(!$profile_img){
            
            }
                
            else{
                  $imagename=time().'.'.$profile_img->getClientOriginalExtension();
            
                  $profile_img->move('therapist_img',$imagename);
            
                  $therapist->profile_img= $imagename;
                  }

              if(!$credential_img){

              }
              else{
                    $imagename=time().'.'.$credential_img->getClientOriginalExtension();
              
                    $credential_img->move('credential',$imagename);
              
                    $therapist->credential_img= $imagename;
                }
    
              if(!$spec_img){

              }else{
                  $imagename=time().'.'.$spec_img->getClientOriginalExtension();
            
                  $spec_img->move('specialization',$imagename);
            
                  $therapist->spec_img= $imagename;
              }
            
              // echo $request->specialization,$request->specialization, $request->credential,$request->spec_img, $request->location;


            $therapist->update();
            return redirect('therapistprofile')->with('success','Profile is Updated');

       } 
      
      
      
      
      
      
      
      }






public function deleteprofile(Request $request,$therapist_id){
$therapist=Therapist::find($therapist_id);
$therapist->delete();
return redirect('therapistprofile')->with('warning','Profile has been deleted');
    }
}
