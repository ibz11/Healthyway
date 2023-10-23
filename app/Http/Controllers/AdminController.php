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
    //Therapist profiles
    public function admincreatetherapistprofile(Request $request){
        if($request->isMethod('get')){

        $userdata=User::where('id','=',Session::get('loginId'))->first();
        $user=User::where('role','therapist')->latest()->get();
          
        return view('Panel.Admin.therapistprofile.create',compact('userdata','user'));
        }  
        if ($request->isMethod('post'))
        {  $request->validate([
            'therapist_id'=>'required|unique:therapists,user_id',
            'email'=>'required|unique:therapists,email',
    
            'full_name'=>'required',
            'phone'=>'required|unique:therapists,phone',
            // 'title' => 'required',
            'specialization' => 'required',
            'location' => 'required',
            'profile_img' => 'required|image|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
        ]);
           

            $therapist=new Therapist;
            $therapist->user_id=$request->therapist_id;
            $therapist->Full_name=$request->full_name;
            $therapist->email=$request->email;
            $therapist->phone=$request->phone;

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
            return redirect('therapistprofiles')->with('success','Profile is created');

       
        } 
    }


    public function updatetherapistprofile(Request $request,$therapist_id){
        if($request->isMethod('get')){
        $userdata=User::where('id','=',Session::get('loginId'))->first();
        $therapist=Therapist::find($therapist_id);
          
        return view('Panel.Admin.therapistprofile.update',compact('userdata','therapist'));
        }  
        if ($request->isMethod('post'))
        {  $request->validate([
            'specialization' => 'title',
            'specialization' => 'required',
            'location' => 'required',
            'profile_img' => 'image|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
        ]);
           

            $therapist=Therapist::find($therapist_id);
            $therapist->user_id=$request->user_id;
            $therapist->Full_name=$request->full_name;
            $therapist->email=$request->email;
            $therapist->phone=$request->phone;

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
            return redirect('therapistprofiles')->with('success','Profile is Updated');

       
        } }
    public function deletetherapistprofile(Request $request,$therapist_id){
        $therapist=Therapist::find($therapist_id);
        $therapist->delete();
        return redirect('therapistprofiles')->with('warning','Profile has been deleted');   
    }
    public function therapistprofiles(){
        $userdata=User::where('id','=',Session::get('loginId'))->first();
        // $choose=Choosetherapist::select('therapist_id')->where('student_id',Auth::user()->id)->where('application_status','accepted')->get();
    
        $therapist=Therapist::latest()->simplePaginate(8);
        return view('Panel.Admin.therapistprofile.profile',compact('userdata','therapist'));
    
    } 
    
    public function viewtherapistprofile(Request $request,$therapist_id){
        $therapist=Therapist::find($therapist_id);
        $userdata=User::where('id','=',Session::get('loginId'))->first();
        return view('Panel.Admin.therapistprofile.profileview',compact('userdata','therapist'));
    }
    //Recomendation routes

    public function getadminrecommendations()
    {
    $userdata=User::where('id','=',Session::get('loginId'))->first();
      $rec=Recommendations::simplePaginate(9);
      return view('Panel.Admin.recommendations',compact('rec','userdata'));
    }
    public function getadminRecommendationDetails($Recommendations_id)
    {
        $rec = Recommendation::find($id);
        return view('Panel.Admin.modals.recommendationmodal',compact('rec'));
    }
    public function updaterecommendation(Request $request,$Recommendations_id)
    {
        
            $rec=Recommendations::find($Recommendations_id);
            $rec->fear_level=$request->fear_level;
            $rec->avoidance_level=$request->avoidance_level;
            $rec->Recommendation=$request->recommendation;
            $rec->update();
       
            // $request->all();
            return redirect('getadminrecommendations')->with('success','Recommendation has been Updated.');
     

    }
    public function deleterecommendation(Request $request,$Recommendations_id)
    {
        $rec=Recommendations::find($Recommendations_id); 
        $rec->delete(); 
        return redirect('getadminrecommendations')->with('Error','Recommendation has been Deleted.
        You should not delete the data as it works with the expert system');
    }
    public function  createrecommendation(Request $request){
        $rec=new Recommendations;
        $rec->fear_level=$request->fear_level;
        $rec->avoidance_level=$request->avoidance_level;
        $rec->Recommendation=$request->recommendation;
        $rec->save();
        return redirect('getadminrecommendations')->with('success','Recommendation has been created.');
    }









    public function createuser(Request $request){
        $request->validate([
      
             'email' => 'required|email|unique:users',
        ]);
          //     'full_name' => 'required',
        //     'phone'=>'required',
        //     // 'password' => 'required|min:6',
        //     'password' => [
        //         'required',
        //         'string',
        //         'min:8', // Minimum length of 8 characters
        //         'max:17',
        //         'regex:/[A-Z]/', // Requires at least one uppercase letter
        //         'regex:/[a-z]/', // Requires at least one lowercase letter
        //         'regex:/[0-9]/', // Requires at least one digit
        //         'regex:/[@$!%*#?&]/', // Requires at least one special character
        //     ]
       
        // ]);
           
        $data = $request->all();
        $check = $this->create($data);
        if($check==true) {
            return redirect()->back()->with('success','You have succesfully created a user');
            }
            else{
                return back()->with('Error','Something went wrong try again');
            }  
    }
    public function create(array $data)
    {
      return User::create([
        'full_name' => $data['full_name'],
        'phone' => $data['phone'],
        'email' => $data['email'],
        'role' => $data['role'],
        'password' => Hash::make($data['password'])
      ]);
    } 
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