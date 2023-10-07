<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Rules;
use App\Models\Recommendations;
use App\Models\Expert;
use App\Models\Journal;
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
use Illuminate\Http\Request;

class JournalController extends Controller
{
    public function journalstudent(){
        $user_id= Session::get('loginId');
        $userdata=User::where('id','=',Session::get('loginId'))->first();

        $journal=Journal::where('user_id','=',$user_id)->latest()->simplePaginate(8);
        return view('panel.student.journal',compact('userdata','journal'));
    }



    public function viewjournal(Request $request,$Journal_id)
    {    
        $journal=Journal::find($Journal_id);
        $userdata=User::where('id','=',Session::get('loginId'))->first();
     
        return view('panel.student.journal.view',compact('userdata','journal'));   
    }
    public function createjournal(Request $request){

    $user_id= Session::get('loginId');
    if ($request->isMethod('get')) 
    {
        $userdata=User::where('id','=',Session::get('loginId'))->first();
        return view('panel.student.journal.create',compact('userdata')); 
    }
    if ($request->isMethod('post')) 
    { 
$journal=new Journal;
$journal->title=$request->title;
$journal->user_id=$user_id;
$journal->view_content=$request->view_content;
$journal->content=$request->content;
$journal->save();
return redirect('journalstudent')->with('success','Journal is created succesfully');
    } 
    }
 

    public function updatejournal(Request $request,$Journal_id){
        $user_id= Session::get('loginId');
        if ($request->isMethod('get')) 
        {   $journal=Journal::find($Journal_id);
            $userdata=User::where('id','=',Session::get('loginId'))->first();
            return view('panel.student.journal.update',compact('userdata','journal')); 
        }
        if ($request->isMethod('post')) 
        { 
            $journal=Journal::find($Journal_id);
            $journal->title=$request->title;
            $journal->user_id=$user_id;
            $journal->view_content=$request->view_content;
            $journal->content=$request->content;
            $journal->save();
            return redirect('journalstudent')->with('success','Content has been updated');
        } 
    }
  
    public function deletejournal(Request $request,$Journal_id)
    {
$journal=Journal::find($Journal_id);
$journal->delete();
return redirect()->back()->with('Error','Content has been deleted');
    }
    public function publicjournal(){

    $user_id= Session::get('loginId');        
    $journal=Journal::where('user_id','=',$user_id)->update(['view_content'=>1]);
    return redirect()->back()->with('warning','All journals have been made public');
    }

    public function privatejournal(){
        $user_id= Session::get('loginId');        
        $journal=Journal::where('user_id','=',$user_id)->update(['view_content'=>0]);
        return redirect()->back()->with('success','All journals have been made Private');
    }


    public function privateselectjournal($Journal_id){
        $user_id= Session::get('loginId');        
        // $journal=Journal::where('user_id','=',$user_id)->update(['view_content'=>0]);
        $journal=Journal::find($Journal_id);
        $journal->view_content=0;
        $journal->save();
        return redirect()->back()->with('success','Journal have been made Private');
    }
    public function publicselectjournal($Journal_id)
    {
        $journal=Journal::find($Journal_id);
        $journal->view_content=1;
        $journal->save();
        return redirect()->back()->with('warning','Journal have been made Public');
    }


}
