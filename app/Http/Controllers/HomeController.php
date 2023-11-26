<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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

class HomeController extends Controller
{
    public function home(){
        $therapist=Therapist::all();
        return view('home',compact('therapist'));
    }
}
