<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Therapist;
use App\Models\Expert;
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
    $therapist=Therapist::latest()->simplePaginate(8);
    return view('Panel.student.therapistprofile.profile',compact('userdata','therapist'));
}


public function viewtherapist(Request $request,$therapist_id){
    $therapist=Therapist::find($therapist_id);
    $userdata=User::where('id','=',Session::get('loginId'))->first();
    
    return view('Panel.student.therapistprofile.profileview',compact('userdata','therapist'));
}










}
