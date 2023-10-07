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
   public function createappointment(Request $request){

   $request->validate([
    'time'=>'required',  
    'appointment_date'=>'required',  
    'location'=>'required',  
    ]);

    $appointment=new Appointments;
    $appointment->user_id=Auth::User()->id;
    $appointment->Therapists_id=$request->Therapists_id;
    $appointment->appointment_date=$request->appointment_date;
    $appointment->time=$request->time;
    $appointment->location=$request->location;
    $appointment->issue=$request->issue;
    $appointment->save();
    return redirect()->back()->with('success','Appointment is created');

   }
   public function myAppointments()
   {
    $userdata=User::where('id','=',Session::get('loginId'))->first();
    $appointment=Appointments::where('user_id',Auth::User()->id)->simplePaginate(8);
    
    $location=Therapist::select('location')->get();
    $address=$location[0]['location'];
    // echo $address;
    return view('Panel.student.myappointments',compact('userdata','appointment','address'));
   }
   public function viewappointment(Request $request,$appointment_id){
    $appointment=Appointments::find($appointment_id);
    
    return view('Panel.student.modals.appointmentmodal', compact('appointment'));

   }

   public function updateappointment(Request $request,$appointment_id){
    $appointment=Appointments::find($appointment_id);
    $location=Therapist::select('location')->where('therapist_id',$appointment->Therapists_id)->get();
    $address=$location[0]['location'];

    if($request->isMethod('get')){
   
   
    return view('Panel.student.modals.updateappointmentmodal', compact('appointment','address'));
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
         $appointment->location=$request->location;
         $appointment->issue=$request->issue;
         $appointment->save();
         
        return redirect()->back()->with('success','Appointment is Updated');
        }
   }
   public function deleteappointment(Request $request,$appointment_id){
    $appointment=Appointments::find($appointment_id);
    $appointment->delete();
    return redirect()->back()->with('warning','Appointment is deleted');

   }
}
