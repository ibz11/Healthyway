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
