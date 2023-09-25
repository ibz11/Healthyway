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
        // $user=User::find($id);
        if ($request->isMethod('get')) 
        {

        return view('Panel.student.expertsystem',compact('userdata'));    
        }
        if ($request->isMethod('post')) 
        {
        //     $user=user::find($id);
        // $user->full_name=$request->full_name;
        
        // $user->email=$request->email;
        // $user->phone=$request->phone;
        // $user->role=$request->role;
        
        // $user->save();
       
        dd('test saved');
    
        //  return redirect('/users')->with('success','User is updated succesfully') ;  
            
        }
}


public function deleteuser($id)
{
    $user=User::find($id);
     $user->delete();
     return redirect('/users')->with('error','The User was deleted successfully');
 

}
}
