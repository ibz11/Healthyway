<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Hash;
use Session;
use App\Models\User;
use App\Models\Appointments;
use App\Models\Therapist;
use App\Models\Timeslot;

class TimeslotController extends Controller
{
    public function timeslotstherapist(Request $request){
        /*  $times = [
             '8:30-9:30',
             '10:00-11:00',
             '11:30-12:30',
             '2:30-3:30',
             '3:30-4:30',
         ];*/
       
       $selectedID = $request->input('therapists_id');
       //16;
       $selectedDate =$request->input('appointment_date');
       // '2023-11-30';
       
       
       
       $times = Timeslot::where('therapist_id', $selectedID)
       ->pluck('timeslot')
       ->toArray();
       
         
         
       // $selectedTime = $request->input('time');
       
       // Query the database to get available time slots based on $selectedDate
       $bookedTimeSlots = Appointments::where('Therapists_id', $selectedID)
       ->where('appointment_date', $selectedDate)
       ->where(function ($query) {
          $query->where('status', 'pending')
              ->orWhere('status', 'accepted');
       })
       ->pluck('time')
       ->toArray();
       
       $availableTimeSlots = array_values(array_diff($times, $bookedTimeSlots));
    //    dd($times);
        return response()->json([
       'available_time_slots' => $availableTimeSlots,
       'booked_time_slots' => $bookedTimeSlots,
       ]);
          
       }

    public function timeslotspage(){
        $userdata=User::where('id','=',Session::get('loginId'))->first();
       $times=Timeslot::where('therapist_id',Auth::user()->id)->get(); 
       if($times->isEmpty()){
        $times='no-data';
       }
    //    echo $times;
       return view('Panel.therapist.Timeslot.home',compact('userdata','times'));
    }
    public function createtimeslot(Request $request){
        $userdata=User::where('id','=',Session::get('loginId'))->first();
        if($request->isMethod('get')){
            return view('Panel.therapist.Timeslot.create',compact('userdata'));
        }
        if($request->isMethod('post')){
        $request->validate([
            'timeslot'=>'required'
        ]);

        // echo $request->timeslot;
        $times=new Timeslot;
        $times->therapist_id=Auth::user()->id;
        $times->timeslot=$request->timeslot;
        $times->save();
        return redirect('timeslotspage')->with('success','Timeslot is created');
        }
    }
    public function updatetimeslot(Request $request,$time_id)
    {  
        $userdata=User::where('id','=',Session::get('loginId'))->first();
        $times=Timeslot::find($time_id); 
        if($request->isMethod('get')){
            return view('Panel.therapist.Timeslot.update',compact('times','userdata'));
       
    }

    if($request->isMethod('post')){
        $request->validate([
            'timeslot'=>'required'
        ]);  
        $times=Timeslot::find($time_id); 
        $times->therapist_id=Auth::user()->id;
        $times->timeslot=$request->timeslot;
        $times->update();
        return redirect('timeslotspage')->with('success','Timeslot is updated');
       }
    }
    public function deletetimeslot(Request $request,$time_id){
    $times=Timeslot::find($time_id);
    $times->delete();
    return redirect('timeslotspage')->with('Error','Timeslot is deleted');
    }

//Admin Timeslots

public function therapiststimeslot(){
    $userdata=User::where('id','=',Session::get('loginId'))->first();
$user=User::where('role','therapist')->get();
$therapist=Therapist::all();
return view('Panel.Admin.Timeslot.therapists',compact('userdata','user','therapist'));
}
public function admintimeslotspage($id){
    $userdata=User::where('id','=',Session::get('loginId'))->first();
    // $therapist=Therapist::where('user_id',$id)->get();
    $therapist=Therapist::where('user_id',$id)->latest()->get();
   $times=Timeslot::where('therapist_id',$id)->latest()->get(); 
   if($times->isEmpty()){
    $times='no-data';
   }
//    echo $times;
   return view('Panel.Admin.Timeslot.home',compact('userdata','times','therapist'));
}
public function admincreatetimeslot(Request $request,$id){
    $userdata=User::where('id','=',Session::get('loginId'))->first();
    $therapist=Therapist::where('user_id',$id)->get();
    $user=User::all();
    if($request->isMethod('get')){
        return view('Panel.Admin.Timeslot.create',compact('userdata','user','therapist'));
    }
    if($request->isMethod('post')){
    $request->validate([
        'timeslot'=>'required'
    ]);

    // echo $request->timeslot;
    $times=new Timeslot;
    $times->therapist_id=$request->therapist_id;
    $times->timeslot=$request->timeslot;
    $times->save();
    return redirect('therapiststimeslot')->with('success','Timeslot is created');
    }
}
public function adminupdatetimeslot(Request $request,$time_id)
{  
    $userdata=User::where('id','=',Session::get('loginId'))->first();
    $times=Timeslot::find($time_id); 
    if($request->isMethod('get')){
        return view('Panel.Admin.Timeslot.update',compact('times','userdata'));
   
}

if($request->isMethod('post')){
    $request->validate([
        'timeslot'=>'required'
    ]);  
    $times=Timeslot::find($time_id); 
    $times->therapist_id=$request->therapist_id;
    $times->timeslot=$request->timeslot;
    $times->update();
    return redirect('therapiststimeslot')->with('success','Timeslot is updated');
   }
}
public function admindeletetimeslot(Request $request,$time_id){
$times=Timeslot::find($time_id);
$times->delete();
return redirect()->back()->with('Error','Timeslot is deleted');
}
























}
