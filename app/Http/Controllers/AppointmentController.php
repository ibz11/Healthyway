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


class AppointmentController extends Controller
{

   //Therapists Controls
   public function  modalrejection(Request $request,$appointment_id){
if($request->isMethod('get')){
   $appointment=Appointments::find($appointment_id);
   return view('Panel.therapist.modals.rejectionmodal',compact('appointment'));
}

if($request->isMethod('post')){
   $appointment=Appointments::find($appointment_id); 
   $appointment->rejectionreason=$request->rejectionreason;
   $appointment->save();
   return redirect()->back()->with(['success'=>"Rejection Reason has been added"]);
}
   }


   public function  modalonline(Request $request,$appointment_id){
      if($request->isMethod('get')){
         $appointment=Appointments::find($appointment_id);
         return view('Panel.therapist.modals.onlinelinkmodal',compact('appointment'));
      }
      
      if($request->isMethod('post')){
         $request->validate([
            'onlinelink'=>'required'
         ]);
         $appointment=Appointments::find($appointment_id); 
         $appointment->onlinelink=$request->onlinelink;
         $appointment->save();
         return redirect()->back()->with(['success'=>"Online link has been added"]);
      }
         }






public function rejectapt($appointment_id){
$appointment=Appointments::find($appointment_id);
$appointment->status='rejected';
$appointment->save();
return redirect()->back()->with('warning','Appointment is rejected');
}
public function acceptapt($appointment_id){
   $appointment=Appointments::find($appointment_id);
   $appointment->status="accepted";
   $appointment->rejectionreason="NONE";
   $appointment->save();
   return redirect()->back()->with('success','Appointment is accepted');
  
   // echo $appointment->status;
}

public function viewstudentsappointments(){
   $userdata=User::where('id','=',Session::get('loginId'))->first();
   $appointment=Appointments::where('Therapists_id',Auth::User()->id)->latest()->simplePaginate(15);
   
   return view('panel.therapist.studentappointments',compact('userdata','appointment')); 
}





   //End of therapists Controls
   public function createappointment(Request $request){

   $request->validate([
    'time'=>'required',  
    'appointment_date'=>'required',  
    'location'=>'required',  
    ]);
   $student_email=Auth::user()->email;
    $appointment=new Appointments;
    $appointment->user_id=Auth::User()->id;
    $appointment->Therapists_id=$request->therapists_id;
    $appointment->appointment_date=$request->appointment_date;
    $appointment->time=$request->time;
    $appointment->student_email=$student_email;
    $appointment->location=$request->location;
    $appointment->issue=$request->issue;
    $appointment->save();
    return redirect()->back()->with('success','Appointment is created');

   }
   public function myAppointments()
   {
    $userdata=User::where('id','=',Session::get('loginId'))->first();
    $appointment=Appointments::where('user_id',Auth::User()->id)->latest()->simplePaginate(8);
    $latestapt=Appointments::where('user_id',Auth::User()->id)->latest()->first();
   if(!$latestapt){
      $latestapt='no-data';
   }
    $location=Therapist::all();
    //select('location')->get();
   //  $address=$location;
   //  //$location[0]['location'];
   //  dd($latestapt);
    return view('Panel.student.myappointments',compact('userdata','appointment','location','latestapt'));
   }
   public function viewappointment(Request $request,$appointment_id){
    $appointment=Appointments::find($appointment_id);
    
    return view('Panel.student.modals.appointmentmodal', compact('appointment'));

   }

   public function updateappointment(Request $request,$appointment_id){
    $appointment=Appointments::find($appointment_id);
    $location=Therapist::select('location')->where('therapist_id',$appointment->Therapists_id)->get();
  

    if($request->isMethod('get')){
   
   
    return view('Panel.student.modals.updateappointmentmodal', compact('appointment'));
    }

    if($request->isMethod('post')){

        $request->validate([
         'time'=>'required',  
         'appointment_date'=>'required',  
         'location'=>'required',  
         ]);
     
         $appointment=Appointments::find($appointment_id);
         $appointment->user_id=Auth::User()->id;
         $appointment->Therapists_id=$request->Therapists_id;
         $appointment->appointment_date=$request->appointment_date;
         $appointment->time=$request->time;
         $appointment->student_email=$request->student_email;
         $appointment->location=$request->location;
         $appointment->issue=$request->issue;
         $appointment->update();
         
        return redirect('myAppointments')->with('success','Appointment is Updated');
        }
   }
   public function deleteappointment(Request $request,$appointment_id){
    $appointment=Appointments::find($appointment_id);
    $appointment->delete();
    return redirect()->back()->with('warning','Appointment is deleted');

   }








   
}
