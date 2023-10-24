<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rules;
use App\Models\Recommendations;
use App\Models\Expert;
use App\Models\Choosetherapist;
use App\Models\Notifications;
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
class ExpertController extends Controller
{


    
    public function progress(){
        $user_id= Session::get('loginId');
        $userdata=User::where('id','=',Session::get('loginId'))->first();
        $expdata=Expert::where('user_id',$user_id)->latest()->simplePaginate(8);
        $latestexpdata=Expert::where('user_id',$user_id)->latest()->first();
       if(!$latestexpdata){
        $latestexpdata='no-data';
       }

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
        return view('Panel.student.progress',compact('userdata','expdata','LSAS_scores','created_at',  'averageLSAS',
       'latestexpdata',
       'very_severe',
        'severe',
        'marked',
        'moderate',
        'mild' ));
   

    }

    public function viewdiagnosis($exp_id){
        $expdata=Expert::find($exp_id);
        $user_id= Session::get('loginId');
        $userdata=User::where('id','=',Session::get('loginId'))->first();
        $diagnosis=Recommendations::select('Recommendation')->where('Recommendations_id',$expdata->recommend_id)->get();
        $recommendation=$diagnosis[0]['Recommendation'];
       // echo $recommendation ;  
       return view('Panel.student.viewdiagnosis',compact('userdata','expdata','recommendation'));
    }

public function deletediagnosis($exp_id){
    $expdata=Expert::find($exp_id);
    $expdata->delete();
    return redirect()->back()->with('Error','Data has been deleted');
}



    public function expertsystem(Request $request){

        $userdata=User::where('id','=',Session::get('loginId'))->first();
       
        $questions=[
        '1. Using a telephone in public.(P)',
        '2. Participating in a small group activity.(P)',
        '3. Eating in public places. (P) ',
        '4. Drinking with others in public places. (P) 4.',
        '5. Talking to people in authority. (S) 5.',
        '6. Acting, performing or giving a talk in front of an audience. (P) 6.',
        '7. Going to a party. (S) 7.',
        '8. Working while being observed. (P) 8.',
        '9. Writing while being observed. (P) 9.',
        '10. Calling someone you dont know very well. (S) 10.',
        '11. Talking with people you dont know very well. (S) 11.',
        '12. Meeting strangers. (S) 12.',
        '13. Urinating in a public bathroom. (P) 13.',
        '14. Entering a room when others are already seated. (P) 14.',
        '15. Being the center of attention. (S) 15.',
        '16. Speaking up at a meeting. (P) 16.',
        '17. Taking a test. (P) 17.',
        '18. Expressing a disagreement or disapproval to people you dont know very well. (S)',
        '19. Looking at people you dont know very well in the eyes. (S) 19.',
        '20. Giving a report to a group. (P) 20.',
        '21. Trying to pick up someone. (P) 21.',
        '22. Returning goods to a store. (S) 22.',
        '23. Giving a party. (S) 23.',
        '24. Resisting a high pressure salesperson. (S)'
        ];
       
        $feartag=['F1','F2', 'F3','F4','F5','F6' ,'F7' ,'F8' ,'F9' ,'F10' ,'F11' ,'F12','F13','F14','F15' ,'F16' ,'F17','F18','F19','F20','F21','F22','F23','F24'];
    
        $avoidancetag=['A1','A2','A3','A4','A5','A6','A7','A8','A9','A10','A11','A12',
                      'A13','A14','A15','A16','A17','A18','A19','A20','A21','A22','A23','A24'];
        $choose=Choosetherapist::select('therapist_id')->where('student_id',Auth::user()->id)->get();
        if($choose->isEmpty()){
          $choose='no-data';
         }
    
         if ($request->isMethod('get')) 
        { 
        
        return view('Panel.student.expertsystem',compact('userdata','questions','feartag','avoidancetag','choose'))->with('Error','Test');  
        }
    

// public function expertsystem2(Request $request){
        if ($request->isMethod('post')) 
        {
      
        //Fear Request
        $F1=$request->F1; 
        $F2=$request->F2; 
        $F3=$request->F3;
        $F4=$request->F4;
        $F5=$request->F5;
        $F6=$request->F6;
        $F7=$request->F7;
        $F8=$request->F8;
        $F9=$request->F9;
        $F10=$request->F10;
        $F11=$request->F11;
        $F12=$request->F12;
        $F13=$request->F13;
        $F14=$request->F14;
        $F15=$request->F15;
        $F16=$request->F16;
        $F17=$request->F17;
        $F18=$request->F18;
        $F19=$request->F19;
        $F20=$request->F20;
        $F21=$request->F21;
        $F22=$request->F22;
        $F23=$request->F23;
        $F24=$request->F24;



        //Avoidance Request
        $A1=$request->A1;
        $A2=$request->A2;
        $A3=$request->A3;
        $A4=$request->A4;
        $A5=$request->A5;
        $A6=$request->A6;
        $A7=$request->A7;
        $A8=$request->A8;
        $A9=$request->A9;
        $A10=$request->A10;
        $A11=$request->A11;
        $A12=$request->A12;
        $A13=$request->A13;
        $A14=$request->A14;
        $A15=$request->A15;
        $A16=$request->A16;
        $A17=$request->A17;
        $A18=$request->A18;
        $A19=$request->A19;
        $A20=$request->A20;
        $A21=$request->A21;
        $A22=$request->A22;
        $A23=$request->A23;
        $A24=$request->A24;
    
        //Total Fear
        $totalFear= $F1 +$F2+ $F3+$F4+$F5+$F6+$F7+$F8+$F9+ $F10+ $F11 
        + $F12+ $F13+ $F14+ $F15+ $F16+ $F17+ $F18+ $F19+ $F20+ $F21+ $F22+ $F23+ $F24;

        //Total Avoidance
        $totalAvoidance=$A1 +$A2 + $A3 + $A4 + $A5 + $A6 + $A7 + $A8 + $A9  + $A10 + $A11 + $A12 
            + $A13 + $A14 + $A15 + $A16 + $A17 + $A18 + $A19 + $A20 + $A21 + $A22 + $A23 + $A24;

        //Total Fear +Total Avoidance
        $result=$totalFear+$totalAvoidance; 

        $user_id= Session::get('loginId');

        $highfear=$totalFear >= 49 && $totalFear <= 72;
        $midfear=$totalFear >= 25 && $totalFear <= 48;
        $lowfear=$totalFear >= 0 && $totalFear <= 24;
 
        $highAV=$totalAvoidance >= 49 && $totalAvoidance <= 72;
        $midAV=$totalAvoidance >= 25 && $totalAvoidance <= 48;
        $lowAV=$totalAvoidance >= 0 && $totalAvoidance <= 24;

        //Notifications
        //Very severe and severe social anxiety notifications
        
        if($choose=='no-data'){

        }
        else{
          if($result>=95){
            $not=new Notifications;
            $not->student_id=Auth::user()->id;
            $not->student_fullname=Auth::user()->full_name;
            $not->therapist_id=$choose->first()->therapist_id;
            $not->diagnosis='very severe';
            $not->LSAS_score=$result;
            $not->message="This user has score Very Severe levels of social anxiety";
            $not->save();
            
          }
         
            if($result>=80 && $result<=94){
            $not=new Notifications;
            $not->student_id=Auth::user()->id;
            $not->student_fullname=Auth::user()->full_name;
            $not->therapist_id=$choose->first()->therapist_id;
            $not->diagnosis='severe';
            $not->LSAS_score=$result;
            $not->message="This user has score Severe levels of social anxiety";
            $not->save();
            
          }
        }

        $exp=new Expert;

        // high + high
       
        if($highfear && $highAV){
            $myFear="high";
            $myAvoidance="high";

            $rules_id = Rules::select('Rule_id')->whereRaw('? BETWEEN SUBSTRING_INDEX(score_range, "-", 1) AND SUBSTRING_INDEX(score_range, "-", -1)', [$result])->get(); 
            $rules_idverysevere= Rules::select('Rule_id')->where('score_range','=' ,'95')->where('score_range' ,'<=',$result)->get();         
           
            $recommend_id=Recommendations::select('Recommendations_id')->where('fear_level',$myFear )->where('avoidance_level',$myAvoidance )->get();
            //$data=$db->toArray();
            $socialanxietylevel=Rules::select('socialanxiety_level')->whereRaw('? BETWEEN SUBSTRING_INDEX(score_range, "-", 1) AND SUBSTRING_INDEX(score_range, "-", -1)', [$result])->get();
            $socialanxiety_levelverysevere= Rules::select('socialanxiety_level')->where('score_range','=' ,'95')->where('score_range' ,'<=',$result)->get();
           
            //storing to database
            $exp->user_id=$user_id;
            $exp->recommend_id=$recommend_id[0]['Recommendations_id'];
            $exp->LSAS_score=$result;
            $exp->fear_level=$myFear;
            $exp->avoidance_level=$myAvoidance;
            if($result>=95){
            //Very severe
            $exp->socialanxiety_level=$socialanxiety_levelverysevere[0]['socialanxiety_level'] ;
            $exp->rules_id=$rules_idverysevere[0]['Rule_id'];
            
           
            }
            else{
             
             $exp->socialanxiety_level= $socialanxietylevel[0]['socialanxiety_level'];
             $exp->rules_id=$rules_id[0]['Rule_id'];
             
            
            }
            $exp->save(); 
            return redirect('/progress')->with('success','Congratulations on taking the LSAS test.View your latest result here');
        }
        
        //high + marked
       //ADD REMOVED DATA HERE!!!!!
       if($highfear && $midAV){
            $myFear="High";
            $myAvoidance="marked";

            $rules_id = Rules::select('Rule_id')->whereRaw('? BETWEEN SUBSTRING_INDEX(score_range, "-", 1) AND SUBSTRING_INDEX(score_range, "-", -1)', [$result])->get(); 
            $rules_idverysevere= Rules::select('Rule_id')->where('score_range','=' ,'95')->where('score_range' ,'<=',$result)->get();         
           
            $recommend_id=Recommendations::select('Recommendations_id')->where('fear_level',$myFear )->where('avoidance_level',$myAvoidance )->get();
            //$data=$db->toArray();
            $socialanxietylevel=Rules::select('socialanxiety_level')->whereRaw('? BETWEEN SUBSTRING_INDEX(score_range, "-", 1) AND SUBSTRING_INDEX(score_range, "-", -1)', [$result])->get();
            $socialanxiety_levelverysevere= Rules::select('socialanxiety_level')->where('score_range','=' ,'95')->where('score_range' ,'<=',$result)->get();
            //storing to database
            $exp->user_id=$user_id;
            $exp->recommend_id=$recommend_id[0]['Recommendations_id'];
            $exp->LSAS_score=$result;
            $exp->fear_level=$myFear;
            $exp->avoidance_level=$myAvoidance;

            if($result>=95){
            //Very severe
            $exp->socialanxiety_level=$socialanxiety_levelverysevere[0]['socialanxiety_level'] ;
            $exp->rules_id=$rules_idverysevere[0]['Rule_id'];


            }
            else{
            
            $exp->socialanxiety_level= $socialanxietylevel[0]['socialanxiety_level'];
            $exp->rules_id=$rules_id[0]['Rule_id'];

            }
            $exp->save(); 
            return redirect('/progress')->with('success','Congratulations on taking the test view your latest result here');



        }
        //high + low
       else if($highfear && $lowAV){
            $myFear="High";
            $myAvoidance="Low";

            $rules_id = Rules::select('Rule_id')->whereRaw('? BETWEEN SUBSTRING_INDEX(score_range, "-", 1) AND SUBSTRING_INDEX(score_range, "-", -1)', [$result])->get(); 
            $rules_idverysevere= Rules::select('Rule_id')->where('score_range','=' ,'95')->where('score_range' ,'<=',$result)->get();         
           
            $recommend_id=Recommendations::select('Recommendations_id')->where('fear_level',$myFear )->where('avoidance_level',$myAvoidance )->get();
            //$data=$db->toArray();
            $socialanxietylevel=Rules::select('socialanxiety_level')->whereRaw('? BETWEEN SUBSTRING_INDEX(score_range, "-", 1) AND SUBSTRING_INDEX(score_range, "-", -1)', [$result])->get();
            $socialanxiety_levelverysevere= Rules::select('socialanxiety_level')->where('score_range','=' ,'95')->where('score_range' ,'<=',$result)->get();
            //storing to database
            $exp->user_id=$user_id;
            $exp->recommend_id=$recommend_id[0]['Recommendations_id'];
            $exp->LSAS_score=$result;
            $exp->fear_level=$myFear;
            $exp->avoidance_level=$myAvoidance;
            if($result>=95){
            //Very severe
            $exp->socialanxiety_level=$socialanxiety_levelverysevere[0]['socialanxiety_level'] ;
            $exp->rules_id=$rules_idverysevere[0]['Rule_id'];


            }
            else{
            
            $exp->socialanxiety_level= $socialanxietylevel[0]['socialanxiety_level'];
            $exp->rules_id=$rules_id[0]['Rule_id'];

            }
            $exp->save(); 
            return redirect('/progress')->with('success','Congratulations on taking the test view your latest result here');

        }
        //mod +  high
      else  if($midfear && $highAV){
            $myFear="marked";
            $myAvoidance="High";

            $rules_id = Rules::select('Rule_id')->whereRaw('? BETWEEN SUBSTRING_INDEX(score_range, "-", 1) AND SUBSTRING_INDEX(score_range, "-", -1)', [$result])->get(); 
            $rules_idverysevere= Rules::select('Rule_id')->where('score_range','=' ,'95')->where('score_range' ,'<=',$result)->get();         
           
            $recommend_id=Recommendations::select('Recommendations_id')->where('fear_level',$myFear )->where('avoidance_level',$myAvoidance )->get();
            //$data=$db->toArray();
            $socialanxietylevel=Rules::select('socialanxiety_level')->whereRaw('? BETWEEN SUBSTRING_INDEX(score_range, "-", 1) AND SUBSTRING_INDEX(score_range, "-", -1)', [$result])->get();
            $socialanxiety_levelverysevere= Rules::select('socialanxiety_level')->where('score_range','=' ,'95')->where('score_range' ,'<=',$result)->get();
            //storing to database
            $exp->user_id=$user_id;
            $exp->recommend_id=$recommend_id[0]['Recommendations_id'];
            $exp->LSAS_score=$result;
            $exp->fear_level=$myFear;
            $exp->avoidance_level=$myAvoidance;
            if($result>=95){
            //Very severe
            $exp->socialanxiety_level=$socialanxiety_levelverysevere[0]['socialanxiety_level'] ;
            $exp->rules_id=$rules_idverysevere[0]['Rule_id'];


            }
            else{
            
            $exp->socialanxiety_level= $socialanxietylevel[0]['socialanxiety_level'];
            $exp->rules_id=$rules_id[0]['Rule_id'];

            }
            $exp->save(); 
            return redirect('/progress')->with('success','Congratulations on taking the test view your latest result here');

        }
        //mod +  mod
     else   if($midfear && $midAV){
            $myFear="marked";
            $myAvoidance="marked";


            $rules_id = Rules::select('Rule_id')->whereRaw('? BETWEEN SUBSTRING_INDEX(score_range, "-", 1) AND SUBSTRING_INDEX(score_range, "-", -1)', [$result])->get(); 
            $rules_idverysevere= Rules::select('Rule_id')->where('score_range','=' ,'95')->where('score_range' ,'<=',$result)->get();         
           
            $recommend_id=Recommendations::select('Recommendations_id')->where('fear_level',$myFear )->where('avoidance_level',$myAvoidance )->get();
            //$data=$db->toArray();
            $socialanxietylevel=Rules::select('socialanxiety_level')->whereRaw('? BETWEEN SUBSTRING_INDEX(score_range, "-", 1) AND SUBSTRING_INDEX(score_range, "-", -1)', [$result])->get();
            $socialanxiety_levelverysevere= Rules::select('socialanxiety_level')->where('score_range','=' ,'95')->where('score_range' ,'<=',$result)->get();
            //storing to database
            $exp->user_id=$user_id;
            $exp->recommend_id=$recommend_id[0]['Recommendations_id'];
            $exp->LSAS_score=$result;
            $exp->fear_level=$myFear;
            $exp->avoidance_level=$myAvoidance;
            if($result>=95){
            //Very severe
            $exp->socialanxiety_level=$socialanxiety_levelverysevere[0]['socialanxiety_level'] ;
            $exp->rules_id=$rules_idverysevere[0]['Rule_id'];


            }
            else{
            
            $exp->socialanxiety_level= $socialanxietylevel[0]['socialanxiety_level'];
            $exp->rules_id=$rules_id[0]['Rule_id'];

            }
            $exp->save(); 
            return redirect('/progress')->with('success','Congratulations on taking the test view your latest result here');

        }
        //mod + low
      else  if($midfear && $lowAV){
            $myFear="marked";
            $myAvoidance="Low";

            $rules_id = Rules::select('Rule_id')->whereRaw('? BETWEEN SUBSTRING_INDEX(score_range, "-", 1) AND SUBSTRING_INDEX(score_range, "-", -1)', [$result])->get(); 
            $rules_idverysevere= Rules::select('Rule_id')->where('score_range','=' ,'95')->where('score_range' ,'<=',$result)->get();         
           
            $recommend_id=Recommendations::select('Recommendations_id')->where('fear_level',$myFear )->where('avoidance_level',$myAvoidance )->get();
            //$data=$db->toArray();
            $socialanxietylevel=Rules::select('socialanxiety_level')->whereRaw('? BETWEEN SUBSTRING_INDEX(score_range, "-", 1) AND SUBSTRING_INDEX(score_range, "-", -1)', [$result])->get();
            $socialanxiety_levelverysevere= Rules::select('socialanxiety_level')->where('score_range','=' ,'95')->where('score_range' ,'<=',$result)->get();
            //storing to database
            $exp->user_id=$user_id;
            $exp->recommend_id=$recommend_id[0]['Recommendations_id'];
            $exp->LSAS_score=$result;
            $exp->fear_level=$myFear;
            $exp->avoidance_level=$myAvoidance;
            if($result>=95){
            //Very severe
            $exp->socialanxiety_level=$socialanxiety_levelverysevere[0]['socialanxiety_level'] ;
            $exp->rules_id=$rules_idverysevere[0]['Rule_id'];


            }
            else{
            
            $exp->socialanxiety_level= $socialanxietylevel[0]['socialanxiety_level'];
            $exp->rules_id=$rules_id[0]['Rule_id'];

            }
            $exp->save(); 
            return redirect('/progress')->with('success','Congratulations on taking the test view your latest result here');

        }
        //low + high
       else  if($lowfear && $lowAV){
            $myFear="Low";
            $myAvoidance="Low";

            $rules_id = Rules::select('Rule_id')->whereRaw('? BETWEEN SUBSTRING_INDEX(score_range, "-", 1) AND SUBSTRING_INDEX(score_range, "-", -1)', [$result])->get(); 
            $rules_idverysevere= Rules::select('Rule_id')->where('score_range','=' ,'95')->where('score_range' ,'<=',$result)->get();         
           
            $recommend_id=Recommendations::select('Recommendations_id')->where('fear_level',$myFear )->where('avoidance_level',$myAvoidance )->get();
            //$data=$db->toArray();
            $socialanxietylevel=Rules::select('socialanxiety_level')->whereRaw('? BETWEEN SUBSTRING_INDEX(score_range, "-", 1) AND SUBSTRING_INDEX(score_range, "-", -1)', [$result])->get();
            $socialanxiety_levelverysevere= Rules::select('socialanxiety_level')->where('score_range','=' ,'95')->where('score_range' ,'<=',$result)->get();
            //storing to database
            $exp->user_id=$user_id;
            $exp->recommend_id=$recommend_id[0]['Recommendations_id'];
            $exp->LSAS_score=$result;
            $exp->fear_level=$myFear;
            $exp->avoidance_level=$myAvoidance;
            if($result>=95){
            //Very severe
            $exp->socialanxiety_level=$socialanxiety_levelverysevere[0]['socialanxiety_level'] ;
            $exp->rules_id=$rules_idverysevere[0]['Rule_id'];


            }
            else{
            
            $exp->socialanxiety_level= $socialanxietylevel[0]['socialanxiety_level'];
            $exp->rules_id=$rules_id[0]['Rule_id'];

            }
            $exp->save(); 
            return redirect('/progress')->with('success','Congratulations on taking the test view your latest result here');

        }
        //low + mod
       else if($lowfear && $midAV){
            $myFear="Low";
            $myAvoidance="marked";

            $rules_id = Rules::select('Rule_id')->whereRaw('? BETWEEN SUBSTRING_INDEX(score_range, "-", 1) AND SUBSTRING_INDEX(score_range, "-", -1)', [$result])->get(); 
            $rules_idverysevere= Rules::select('Rule_id')->where('score_range','=' ,'95')->where('score_range' ,'<=',$result)->get();         
           
            $recommend_id=Recommendations::select('Recommendations_id')->where('fear_level',$myFear )->where('avoidance_level',$myAvoidance )->get();
            //$data=$db->toArray();
            $socialanxietylevel=Rules::select('socialanxiety_level')->whereRaw('? BETWEEN SUBSTRING_INDEX(score_range, "-", 1) AND SUBSTRING_INDEX(score_range, "-", -1)', [$result])->get();
            $socialanxiety_levelverysevere= Rules::select('socialanxiety_level')->where('score_range','=' ,'95')->where('score_range' ,'<=',$result)->get();
            //storing to database
            $exp->user_id=$user_id;
            $exp->recommend_id=$recommend_id[0]['Recommendations_id'];
            $exp->LSAS_score=$result;
            $exp->fear_level=$myFear;
            $exp->avoidance_level=$myAvoidance;
            if($result>=95){
            //Very severe
            $exp->socialanxiety_level=$socialanxiety_levelverysevere[0]['socialanxiety_level'] ;
            $exp->rules_id=$rules_idverysevere[0]['Rule_id'];


            }
            else{
            
            $exp->socialanxiety_level= $socialanxietylevel[0]['socialanxiety_level'];
            $exp->rules_id=$rules_id[0]['Rule_id'];

            }
            $exp->save(); 
            return redirect('/progress')->with('success','Congratulations on taking the test view your latest result here');

        }
        //low +low
       else if($lowfear && $lowAV){
            $myFear="Low";
            $myAvoidance="Low";

            $rules_id = Rules::select('Rule_id')->whereRaw('? BETWEEN SUBSTRING_INDEX(score_range, "-", 1) AND SUBSTRING_INDEX(score_range, "-", -1)', [$result])->get(); 
            $rules_idverysevere= Rules::select('Rule_id')->where('score_range','=' ,'95')->where('score_range' ,'<=',$result)->get();         
           
            $recommend_id=Recommendations::select('Recommendations_id')->where('fear_level',$myFear )->where('avoidance_level',$myAvoidance )->get();
            //$data=$db->toArray();
            $socialanxietylevel=Rules::select('socialanxiety_level')->whereRaw('? BETWEEN SUBSTRING_INDEX(score_range, "-", 1) AND SUBSTRING_INDEX(score_range, "-", -1)', [$result])->get();
            $socialanxiety_levelverysevere= Rules::select('socialanxiety_level')->where('score_range','=' ,'95')->where('score_range' ,'<=',$result)->get();
            //storing to database
            $exp->user_id=$user_id;
            $exp->recommend_id=$recommend_id[0]['Recommendations_id'];
            $exp->LSAS_score=$result;
            $exp->fear_level=$myFear;
            $exp->avoidance_level=$myAvoidance;
            if($result>=95){
            //Very severe
            $exp->socialanxiety_level=$socialanxiety_levelverysevere[0]['socialanxiety_level'] ;
            $exp->rules_id=$rules_idverysevere[0]['Rule_id'];


            }
            else{
            
            $exp->socialanxiety_level= $socialanxietylevel[0]['socialanxiety_level'];
            $exp->rules_id=$rules_id[0]['Rule_id'];

            }
            $exp->save(); 
            return redirect('/progress')->with('success','Congratulations on taking the LSAS test.View your latest result here');

        }

        //Error handling none +none
        
        if($result==0){
        return redirect()->back()->with('success','You have no social anxiety or you have not filled out the form');
        }

        ECHO 'ERROR 404.s';
        
  
    
    }  
}








}
