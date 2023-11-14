<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Therapist;
use App\Models\Expert;
use App\Models\Choosetherapist;
use App\Models\Notifications;
use App\Models\Appointments;
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
class StudentController extends Controller
{
 
  public function deletetherapistapplication($ChooseID){
    $choose=Choosetherapist::find($ChooseID);
    $choose->delete();
    return redirect()->back()->with('warning','You have deleted application for this therapist');
  }
  public function selecttherapist($ChooseID){
    $choose=Choosetherapist::find($ChooseID);
      $choose->selection_status='selected';
      $choose->update();
      return redirect()->back()->with('success','You have selected this therapist');
    }

  public function deselecttherapist($ChooseID){
    $choose=Choosetherapist::find($ChooseID);
    $choose->selection_status='deselected';
    $choose->update();
    return redirect()->back()->with('warning','You have deselected this therapist');
  }
public function choosetherapist(Request $request ,$therapist_id){
  $user=Auth::User();
  $therapist=Therapist::find($therapist_id);

  $choose=new Choosetherapist;
  $choose->student_id=$user->id;
  $choose->student_fullname=$user->full_name;
  $choose->profile_id=$therapist->therapist_id;
  $choose->therapist_id=$therapist->user_id;
  $choose->therapist_fullname=$therapist->Full_name;
  $choose->save();

  return redirect()->back()->with('success','Therapist selection is succesfull.Wait for the therapist to accept your request');
  }
public function progresspdfview(){
    $user_id= Session::get('loginId');
    $userdata=User::where('id','=',Session::get('loginId'))->first();
    $expdata=Expert::where('user_id',$user_id)->latest()->get();
    $very_severe=Expert::where('user_id',$user_id)->where('socialanxiety_level','very_severe')->count();
    $severe=Expert::where('user_id',$user_id)->where('socialanxiety_level','severe')->count();
    $marked=Expert::where('user_id',$user_id)->where('socialanxiety_level','marked')->count();
    $moderate=Expert::where('user_id',$user_id)->where('socialanxiety_level','moderate')->count();
    $mild=Expert::where('user_id',$user_id)->where('socialanxiety_level','mild')->count();
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

    $scores=Expert::where('user_id',$user_id)->sum('LSAS_score');
    $scorecount=Expert::select('LSAS_score')->where('user_id',$user_id)->count();
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
    return view('Panel.student.progresspdfview',compact(
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
public function myprogresspdf(){
    $user_id= Session::get('loginId');
    $userdata=User::where('id','=',Session::get('loginId'))->first();
    $expdata=Expert::where('user_id',$user_id)->latest()->get();

    $very_severe=Expert::where('user_id',$user_id)->where('socialanxiety_level','very_severe')->count();
    $severe=Expert::where('user_id',$user_id)->where('socialanxiety_level','severe')->count();
    $marked=Expert::where('user_id',$user_id)->where('socialanxiety_level','marked')->count();
    $moderate=Expert::where('user_id',$user_id)->where('socialanxiety_level','moderate')->count();
    $mild=Expert::where('user_id',$user_id)->where('socialanxiety_level','mild')->count();
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


    $scores=Expert::where('user_id',$user_id)->sum('LSAS_score');
    $scorecount=Expert::select('LSAS_score')->where('user_id',$user_id)->count();
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
    $pdf = Pdf::loadView('Panel.student.PDF.progresspdfview',[
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
    return $pdf->download('myProgress.pdf');
}





public function deleteuser($id)
{
    $user=User::find($id);
     $user->delete();
     return redirect('/users')->with('error','The User was deleted successfully');
}



public function studenttherapistprofile(){
    $userdata=User::where('id','=',Session::get('loginId'))->first();
    $choose=Choosetherapist::select('therapist_id')->where('student_id',Auth::user()->id)->where('application_status','accepted')->get();
   
   
//This code selects al the therapist profileof the therapist where they have approven your chosen application 
    $selectedtherapistArray = [];
    foreach ($choose as $data) {
      $therapistId = $data['therapist_id'];
  
      // Query the therapist profile based on the therapist ID
      $selected=Therapist::where('user_id',$therapistId)->latest()->first();
      // $therapistProfile = $selectedtherapist->where('user_id', $therapistId)->first();
  
      if ($selected) {
          // If a therapist profile is found, append it to the therapistProfiles array
          $selectedtherapistArray[] = $selected;
      }
  }
  






    $therapist=Therapist::latest()->simplePaginate(8);
    return view('Panel.student.therapistprofile.profile',compact('userdata','therapist','selectedtherapistArray','choose'));
}


public function viewtherapist(Request $request,$therapist_id){
    $therapist=Therapist::find($therapist_id);
    $choose=Choosetherapist::where('therapist_id',$therapist->user_id)->where('student_id',Auth::user()->id)->get();
    // where('therapist_id',$therapist->user_id)->or
  





  







    if($choose->isEmpty()){
     $choose='no-data';
    }
 
    $choosestatus='pending';
    // Choosetherapist::select('status')->where('therapist_id',$therapist->user_id)->get();
    $choosecount=Choosetherapist::where('therapist_id',$therapist->user_id)->where('student_id',Auth::user()->id)->count();
    if($choosecount<=0){
        $choosecount=0;
    }
   
    $choosestatus='pending';


  $times=[
      '8:30-9:30',
      '10:00-11:00',
      '11:30-12:30',
      '2:30-3:30',
      '3:30-4:30', 
  ];
  
  $selectedDate = $request->input('appointment_date');
   $selectedTime =$request->input('time');
   $newslots=[];
   // Query the database to get available time slots based on $selectedDate
   for ($i = 0; $i < count($times); $i++) {
   $availableTimeSlots = Appointments::where('Therapists_id',$therapist->user_id)
   ->where('appointment_date', $selectedDate)
   ->where('time', $selectedTime)
   // $times[$i])
   ->pluck('time')
   ->toArray();
   $newtimes = array_values(array_diff($times, $availableTimeSlots));
   }

  //  dd($newtimes);
    $userdata=User::where('id','=',Session::get('loginId'))->first();
    return view('Panel.student.therapistprofile.profileview',compact(
      'times',
      'userdata',
      'therapist',
      'choose',
      'choosestatus',
      'choosecount'));
}










}
