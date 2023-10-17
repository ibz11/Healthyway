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
use Barryvdh\DomPDF\Facade\Pdf;
class AdminController extends Controller
{
    public function users(){
        $userdata=User::where('id','=',Session::get('loginId'))->first();
        $users=User::all();
        return view('Panel.Admin.Users',compact('users','userdata'));

    }
    public function updateuser(Request $request,$id){
        $userdata=User::where('id','=',Session::get('loginId'))->first();
        $user=User::find($id);
        if ($request->isMethod('get')) 
        {

        return view('Panel.Admin.CRUD.updateuser',compact('userdata','user'));    
        }
        if ($request->isMethod('post')) 
        {
            $user=user::find($id);
        $user->full_name=$request->full_name;
        
        $user->email=$request->email;
        $user->phone=$request->phone;
        $user->role=$request->role;
        
        $user->save();
       
        
    
         return redirect('/users')->with('success','User is updated succesfully') ;  
        //return view('Panel.Admin.CRUD.updateuser',compact('userdata'));    
        }
}


public function deleteuser($id)
{
    $user=User::find($id);
     $user->delete();
     return redirect('/users')->with('error','The User was deleted successfully');
 

}

public function updateuserview($id){
    $dept=department::all();
    $user=user::find($id);
    return view('admin.updateuserview',compact('user','dept'));  
}















}