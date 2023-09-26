<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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
class StudentController extends Controller
{
    public function progress(){
        $userdata=User::where('id','=',Session::get('loginId'))->first();
        // $users=User::all();
        return view('Panel.student.progress',compact('userdata'));

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

                if ($request->isMethod('get')) 
                { 

    return view('Panel.student.expertsystem',compact('userdata','questions','feartag','avoidancetag'))->with('Error','Test');  
                }
         if ($request->isMethod('post')) 
    {
    // $request->validate([
    // 'feartag'=>'required',
    // ]);

    $F1=$request->F1; 
    $A1=$request->A1;
    $F2=$request->F2 ; 
    $A2=$request->A2;

    //Total Fear
    $totalFear=$F1 +$F2 ;
    //Total Avoidance
    $totalAvoidance=$A1 +$A2;
    //Total Fear +Total Avoidance
    $result=$totalFear+$totalAvoidance; 
    
    //Database logic
    dd("totalFear: ",$totalFear,"  totalAvoidance:  ",$totalAvoidance,"  total: ",$result);
    //  //return redirect()->back()->with('success','User is updated succesfully') ;  
    }
}
public function expertsystem2(Request $request){
    //$userdata=User::where('id','=',Session::get('loginId'))->first();
    $F1=$request->F1; 
    $A1=$request->A1;
    $F2=$request->F2 ; 
    $A2=$request->A2;

    //Total Fear
    $totalFear=$F1 +$F2 ;
    //Total Avoidance
    $totalAvoidance=$A1 +$A2;
    //Total Fear +Total Avoidance
    $result=$totalFear+$totalAvoidance; 
    
    //Database logic
    echo "totalFear: ",$totalFear,"  totalAvoidance:  ",$totalAvoidance,"  total: ",$result;
    



}

public function deleteuser($id)
{
    $user=User::find($id);
     $user->delete();
     return redirect('/users')->with('error','The User was deleted successfully');
}














}
