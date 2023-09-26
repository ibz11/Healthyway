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

class TherapistController extends Controller
{
    public function studentprogress(){
        $userdata=User::where('id','=',Session::get('loginId'))->first();
        
        return view('Panel.therapist.studentProgress',compact('userdata'));
    }
}
