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

    //Expert systems rules
    public function exprules(){
    $userdata=User::where('id','=',Session::get('loginId'))->first();
    $rules=Rules::all();
    return view('Panel.Admin.expertrules',compact('rules','userdata'));
    }
   
    public function createrule(){
        $rules=new Rules;
        $rules->score_range=$request->score_range;
        $rules->socialanxiety_level=$request->socialanxiety_level;
        $rules->save();
        return redirect()->back()->with('success','Rule Created Successfully');
    }

    public function updaterule($Rule_id){
        $rules=Rules::find($Rule_id);
        $rules->score_range=$request->score_range;
        $rules->socialanxiety_level=$request->socialanxiety_level;
        $rules->update();
        return redirect()->back()->with('success','Rule Updated Successfully');
    }

    public function deleterule($Rule_id){
        $rules=Rules::find($Rule_id);
        $rules->score_range=$request->score_range;
        $rules->socialanxiety_level=$request->socialanxiety_level;
        $rules->delete();
        return redirect()->back()->with('Error','Rule is Deleted');
    }




//Student Chosen Therapist functions
public function  adminacceptapplication($ChooseID){
    $choose=Choosetherapist::find($ChooseID);
    $choose->selection_status='selected';
    $choose->application_status='accepted';
    $choose->save();
    return redirect()->back()->with('success','Client application has been Accepted');
  }
  public function  adminrejectapplication($ChooseID){
    $choose=Choosetherapist::find($ChooseID);
    $choose->selection_status='deselected';
    $choose->application_status='rejected';
    $choose->save();
  return redirect()->back()->with('warning','Client application has been Rejected');
  }

public function admindeletetherapistapplication($ChooseID){
    $choose=Choosetherapist::find($ChooseID);
    $choose->delete();
    return redirect()->back()->with('warning','You have deleted application for this student`s chosen therapist');
  }
public function studentschosen(){
   
    // $user=User::all();
    $userdata=User::where('id','=',Session::get('loginId'))->first();
     $user = DB::table('users')->where('role','student')->simplepaginate(12);
     return view('Panel.Admin.chosentherapist.students',compact('user','userdata'));
}  


public function studentschosentherapist($id){
   
    // $user=User::all();
    
    $choose=Choosetherapist::where('student_id',$id)->latest()->simplepaginate(12);
    if($choose===null){
        $choose="no-data"; 
    }
    // $choose="no-data";
    $userdata=User::where('id','=',Session::get('loginId'))->first();
    //  $user = DB::table('users')->where('role','student')->simplepaginate(12);
    //   dd( $choose);
    // echo $choose;
     return view('Panel.Admin.chosentherapist.studentchosentherapist',compact('userdata','choose'));
} 
// Appointment Controlls
public function displayonlytherapists(){
   
        // $user=User::all();
        $userdata=User::where('id','=',Session::get('loginId'))->first();
         $users = DB::table('users')->where('role','therapist')->simplepaginate(12);
         return view('Panel.Admin.users',compact('users','userdata'));
    
        // $users=User::where('role','therapist')->simplepaginate(8);
        // return redirect('users')->with(compact('users'));
}

public function displayonlystudents(){
   
    // $user=User::all();
    $userdata=User::where('id','=',Session::get('loginId'))->first();
     $users = DB::table('users')->where('role','student')->simplepaginate(12);
     return view('Panel.Admin.users',compact('users','userdata'));

    // $users=User::where('role','therapist')->simplepaginate(8);
    // return redirect('users')->with(compact('users'));
}

public function adminupdateappointment(Request $request,$appointment_id){
    $appointment=Appointments::find($appointment_id);
    $location=Therapist::select('location')->where('therapist_id',$appointment->Therapists_id)->get();
  

    if($request->isMethod('get')){
   
   
    return view('Panel.Admin.modals.updateappointmentmodal', compact('appointment'));
    }

    if($request->isMethod('post')){

        $request->validate([
         'time'=>'required',  
         'appointment_date'=>'required',  
         'location'=>'required',  
         ]);
     
         $appointment=Appointments::find($appointment_id);
         $appointment->user_id=$request->user_id;
         $appointment->Therapists_id=$request->Therapists_id;
         $appointment->appointment_date=$request->appointment_date;
         $appointment->time=$request->time;
         $appointment->location=$request->location;
        //  $appointment->issue=$request->issue;
         $appointment->save();
         
        return redirect('myAppointments')->with('success','Appointment is Updated');
        }
   }
   public function admindeleteappointment(Request $request,$appointment_id){
    $appointment=Appointments::find($appointment_id);
    $appointment->delete();
    return redirect()->back()->with('warning','Appointment is deleted');

   }








public function allstudents(){
    $user_id= Session::get('loginId');
    $userdata=User::where('id','=',Session::get('loginId'))->first();
    $user=User::where('role','student')->get();
    // $journal=Journal::where('user_id','=',$id)->latest()->simplePaginate(12);
    return view('Panel.Admin.appointments.allstudents',compact('userdata','user'));
}
public function adminAppointments($id)
{
 $userdata=User::where('id','=',Session::get('loginId'))->first();
 $appointment=Appointments::where('user_id',$id)->latest()->get();
//  where('user_id',Auth::User()->id)->latest()->simplePaginate(8);
$user=User::find($id);
 $latestapt=Appointments::where('user_id',$id)->latest()->first();
if(!$latestapt){
   $latestapt='no-data';
}
 $location=Therapist::all();
 //select('location')->get();
//  $address=$location;
//  //$location[0]['location'];
//  dd($latestapt);
 return view('Panel.Admin.appointments.studentappointments',compact('userdata','appointment','location','user','latestapt'));
}
    //Journal Controlls

    public function adminpublicjournal($id)
    {

        // $user_id= Session::get('loginId');        
        $journal=Journal::where('user_id','=',$id)->update(['view_content'=>1]);
        return redirect()->back()->with('warning','All journals have been made public');
        }
    
        public function adminprivatejournal($id){
            // $user_id= Session::get('loginId');        
            $journal=Journal::where('user_id','=',$id)->update(['view_content'=>0]);
            return redirect()->back()->with('success','All journals have been made Private');
        }

    public function adminprivateselectjournal($Journal_id){
        $user_id= Session::get('loginId');        
        // $journal=Journal::where('user_id','=',$user_id)->update(['view_content'=>0]);
        $journal=Journal::find($Journal_id);
        $journal->view_content=0;
        $journal->save();
        return redirect()->back()->with('success','Journal has been made Private');
    }

    public function adminpublicselectjournal($Journal_id)
    {
        $journal=Journal::find($Journal_id);
        $journal->view_content=1;
        $journal->save();
        return redirect()->back()->with('warning','Journal has been made Public');
    }



    public function adminstudentjournals(){
        $user_id= Session::get('loginId');
        $userdata=User::where('id','=',Session::get('loginId'))->first();
        $user=User::where('role','student')->get();
        // $journal=Journal::where('user_id','=',$id)->latest()->simplePaginate(12);
        return view('Panel.Admin.journals.studentjournals',compact('userdata','user'));
    }

    public function adminviewstudentjournal($id)
    {
    $user=User::find($id);
    $userdata=User::where('id','=',Session::get('loginId'))->first();
    $journal=Journal::where('user_id',$id)->latest()->get();

    return view('Panel.Admin.journals.individualstudentjournal',compact('userdata','journal','user'));
    }





    public function adminupdatejournal(Request $request,$Journal_id){

    // $user_id= Session::get('loginId');
    $studentjournal=Journal::find($Journal_id);

    if ($request->isMethod('get')) 
    {   $journal=Journal::find($Journal_id);
        $userdata=User::where('id','=',Session::get('loginId'))->first();
        return view('panel.Admin.journals.updatejournal',compact('userdata','journal')); 
    }
    if ($request->isMethod('post')) 
    { 
        $journal=Journal::find($Journal_id);
        $journal->title=$request->title;
        $journal->user_id=$request->student_id;
        $journal->view_content=$request->view_content;
        $journal->content=$request->content;
        $journal->update();
        return redirect('adminstudentjournals')->with('success','Journal has been updated');
    } 
    }

    public function admindeletejournal(Request $request,$Journal_id)
    {
    $journal=Journal::find($Journal_id);
    $journal->delete();
    return redirect()->back()->with('Error','Journal has been deleted');
    }

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
        // $therapist=Therapist::where('user_id',$therapist_id);
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
        $users=User::simplepaginate(12);
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