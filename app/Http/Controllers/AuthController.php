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

use Illuminate\Support\Facades\Mail;
use App\Mail\TwoFA_Login;
use App\Mail\ForgotPassword;
//use App\Mail\TwoFA_Login;
use App\Helpers\RandomCodeGenerator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

//Registration functions
    public function registerview(){
       
        $title='Register';
        return view('Auth/register',compact('title'));
    }

    public function registerUser(Request $request)
    {  
        $request->validate([
            'full_name' => 'required',
            'email' => 'required|email|unique:users',
            'phone'=>'required',
            // 'password' => 'required|min:6',
            'password' => [
                'required',
                'string',
                'min:8', // Minimum length of 8 characters
                'max:17',
                'regex:/[A-Z]/', // Requires at least one uppercase letter
                'regex:/[a-z]/', // Requires at least one lowercase letter
                'regex:/[0-9]/', // Requires at least one digit
                'regex:/[@$!%*#?&]/', // Requires at least one special character
            ],
            'confirm_password'=>'required|same:password', 
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
        if($check==true) {
            return redirect('login')->with('success','You have been registered successfully');
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

//End of Registration



//Login Functions 
public function loginview(){
    $error='';
    $title='Login';
    return view('Auth/login',compact('title'));
    
}

public function loginUser(Request $request)
{
    $request->validate([
        'email' => 'required',
        'password' => 'required',
    ]);

    $credentials = $request->only('email', 'password');
    if (auth()->attempt($credentials)) {

        $user=User::where('id',Auth::User()->id)->first();
        $request->session()->put('loginId',Auth::User()->id);

        // $fourDigitCode = RandomCodeGenerator::generateRandomCode(5); 
        // $user->twoFA_code=Hash::make($fourDigitCode);
        // $user->save();
        // Mail::to($user->email)->send(new TwoFA_Login($fourDigitCode));
        // return redirect('twofaview');
        return redirect('dashboard');

       }
 
    return redirect()->back()->with('Error','Login details are invalid');
  
}



//End of Login functions








//Authentication views
//Authenticate ---------------------------------------------------------------------
public function authenticate(Request $request) {
    $formFields = $request->validate([
        'email' => ['required', 'email'],
        'password' => 'required'
    ]);

    // Retrieve the user instance directly from the database
    $user = User::where('email', $formFields['email'])->first();

    // Check if the user exists and the password is correct
    if ($user && Hash::check($formFields['password'], $user->password)) {
        // Generate OTP
        $fourDigitCode = rand(100000, 999999);
        $user->twoFA_code =Hash::make($fourDigitCode);
        // $user->otp_created_at = now();
        $user->save();

        // Store email in session for OTP verification
        session(['email' => $formFields['email']]);
     
        // Send OTP to user's email
        // Mail::to($user->email)->send(new SendOtpMail($otp));
        Mail::to($user->email)->send(new TwoFA_Login($fourDigitCode));
        // return redirect('twofaview');

        // Redirect to OTP verification page
        return redirect('/twofaview');
    } else {
        return redirect('/login')->with('Error', 'Wrong credentials!!');
    }
}






public function twofaview(){
    $title='Verify 2FA';
    $email = session('email');
    return view ('Panel/verify2fa',compact('title','email'));
}



public function verify2FA(Request $request){
// $twoFAcode=123;
$email = session('email');
$user=User::where('email','=',$email)->first();
// ,Session::get('loginId'))->first();



if(Hash::check($request->twoFA_input , $user->twoFA_code)){
// if($request->twoFA_input == $user->twoFA_code){
  
    $user->twoFA_code = null; // Clear the OTP code
    $user->save();

    // Log the user in
    auth()->login($user);
    $ID=User::where('email',$email)->pluck('id')->first();
    $request->session()->put('loginId',$ID);

    // Clear the email from the session
    // $request->session()->forget('email');
    return redirect('/dashboard')->with('success','Login Successful!');
}
else{
return back()->with('Error',"Wrong Code!!!");
}
   
}

//Resend OTP
public function resendOtp()
{
$email = session('email');
$user = User::where('email', $email)->first();

if ($user) {
    // Generate a new OTP and store the generation time
    // $otp = rand(100000, 999999);
    // $user->otp_code = $otp;
    // $user->otp_created_at = now();
    // $user->save();

    $fourDigitCode = rand(100000, 999999);
    $user->twoFA_code =Hash::make($fourDigitCode);
    // $user->otp_created_at = now();
    $user->save();

    // Store email in session for OTP verification
    session(['email' => $email]);
 
    // Send OTP to user's email
    // Mail::to($user->email)->send(new SendOtpMail($otp));
    Mail::to($user->email)->send(new TwoFA_Login($fourDigitCode));

   

    return redirect()->back()->with('success', 'A new  OTP code has been sent to your email.');
} else {
    return redirect()->back()->with('error', 'Error resending OTP. Please try again.');
}
}



public function enable2FA($id){

$res=User::find($id);
$res->twoFA_enabled=1;
$res->save();
return back()->with('success','You have enabled 2fa');
}


public function disable2FA($id){
//$res=User::where('id','=',$id)->first();
$res=User::find($id);
$res->twoFA_code= 0;
$res->twoFA_enabled=0;
$res->twoFA_code= 0;
$res->save();
return back()->with('Error','You have disabled 2fa');
}








public function dashboard(){
$email = session('email');
$userdata =array();
if(Session::has('loginId')){
    // $userdata=User::where('email','=',$email)->get();
    $userdata=Auth::user();
    //  $userdata=User::where('id','=',Session::get('loginId'))->first();

if($userdata->role=='admin'){
    $profiles=Therapist::count();
    // $loggedInUsers=Session::count();
    $therapist=User::where('role','therapist')->count();
    $student=User::where('role','student')->count();
    $rec=Recommendations::count();
    $pendingapt=Appointments::where('status','pending')->count();
    return view('Panel/Admin/home',compact('userdata',
  
    'rec',
    'profiles',
    'therapist',
    'student',
    'pendingapt'
));
}

else if($userdata->role=='therapist'){
    $choose=Choosetherapist::where('therapist_id',Auth::user()->id)->get();
    // $public_journal=Journal::where('user_id',$choose->first()->student_id)->where('view_content',1)->count();
    // if(!$public_journal){
    //     $public_journal=0;
    // }
    $apt=Appointments::where('Therapists_id',Auth::user()->id)->count();
    $accepted_apt=Appointments::where('Therapists_id',Auth::user()->id)->where('status','accepted')->count();
    $rejected_apt=Appointments::where('Therapists_id',Auth::user()->id)->where('status','rejected')->count();
    $pending_apt=Appointments::where('Therapists_id',Auth::user()->id)->where('status','accepted')->count();
    // $urgent_anxiety=Expert::where('user_id',$choose->first()->student_id)->where('socialanxiety_level', 'severe')
    // ->orWhere('socialanxiety_level', 'very_severe')
    // ->count();

    $columnData = [];
    // $hello = User::select('twoFA_enabled')->get();
    $data=User::select('twoFA_enabled')->where('id','=',Session::get('loginId'))->get();
    foreach ($data as $data) {
    $columnData[] = $data;
    }
    // response()->json($columnData);
    return view('Panel/therapist/home',compact('userdata','columnData','accepted_apt','rejected_apt','pending_apt'));
}
else if($userdata->role=='student'){
    $columnData = [];
    
    $data=User::select('twoFA_enabled')->where('id','=',Session::get('loginId'))->get();
    $journal=Journal::where('user_id',Auth::user()->id)->count();
    $apt=Appointments::where('user_id',Auth::user()->id)->count();
    $accepted_apt=Appointments::where('user_id',Auth::user()->id)->where('status','accepted')->count();
    $exp=Expert::where('user_id',Auth::user()->id)->count();
// $apt=Appointments;
// $exp=Expert;
    foreach ($data as $data) {
    $columnData[] = $data;
}
    $choosecount=Choosetherapist::where('student_id',Auth::user()->id)->where('application_status','accepted')->orWhere('application_status','pending')->count();

    return view('Panel/student/home',compact('userdata','columnData','journal','apt','exp','accepted_apt','choosecount'));
}
else{
    $user=Auth::User();
    return view('home',compact('user'));   
}
}

}



public function forgotpassword(Request $request){
$title;
if ($request->isMethod('get')) {
$title='Forgot password';
return view('auth/forgot_password/emailview',compact('title'));

} 
if ($request->isMethod('post')) 
{
 
$title='Reset Password';
$useremail=User::where('email','=',$request->email)->first();
$passwordresetlink=DB::table('password_reset_tokens')->where('email','=',$request->email);
$request->validate([
    'email'=>'required|email|unique:password_reset_tokens'
]);
if($useremail){
$token=Str::random(64);

DB::table('password_reset_tokens')->insert([
    'email'=>$request->email,
    'token'=>$token,
    'created_at'=>Carbon::now()
]);
//return redirect('verifyforgotToken');
Mail::to($request->email)->send(new ForgotPassword($token));
//return view('auth/forgot_password/resetpassword',compact('title'));
return redirect('login')->with('success','We have sent you a password reset link to your Email');


}
else if($passwordresetlink){
    return redirect()->back()->with('Error','Password reset link has been sent.No need to resend link');    
}

else{
   
// return view('auth/forgot_password/emailview',compact('title'))->with('Error','Email does not exist.Try again');
   return redirect()->with('Error','Email does not exist.Try again');
}       

}
}
public function resetpasswordlink($token){
    $title='Reset Password ';
    return view('auth/forgot_password/resetpassword',compact('token','title'));    
    
}

public function resetpassword(Request $request,$token){
    if ($request->isMethod('get')) 
    {
    return view('auth/forgot_password/resetpassword',compact('token'));    
    }
    if ($request->isMethod('post')) 
    {
        $request->validate([
            'email'=>'required|min:4|email|exists:users', 
            'password' => [
                'required',
                'string',
                'min:8', // Minimum length of 8 characters
                'max:17',
                'regex:/[A-Z]/', // Requires at least one uppercase letter
                'regex:/[a-z]/', // Requires at least one lowercase letter
                'regex:/[0-9]/', // Requires at least one digit
                'regex:/[@$!%*#?&]/', // Requires at least one special character
            ],
            'confirm_password'=>'required|same:password', 
        
        ]);
        $password_reset_request=DB::table('password_reset_tokens')->where('email',$request->email)
        ->where('token',$request->token)
        ->first();
       if(!$password_reset_request){
        DB::table('password_reset_tokens')->where('token',$request->token)
        ->delete();
        return redirect('forgotpassword')->with('Error','Wrong email or Invalid token.Resend a new link');
       }
       else{
        User::where('email',$request->email)->update(['password'=>Hash::make($request->password)]);
        DB::table('password_reset_tokens')->where('email',$request->email)
        ->delete();

        return redirect('login')->with('success','Password has been updated.You can now login');
       }

    }    
}


public function profile(Request $request,$id){
    $userdata=User::where('id','=',Session::get('loginId'))->first();
    $userpwd=User::where('id','=',Session::get('loginId'))->value('password');
    $title='Profile Page';
 if($request->isMethod('get')){
    return view('auth.profile.profile',compact('userdata','userpwd','title'));
 }
 if($request->isMethod('post')){
    $rules = [
         // 'email'=>'required|min:4|email|exists:users', 
         'full_name'=>'min:4',
         'phone'=>'min:4',
         
     
    ];
    
    
   
   
    $userdata->full_name=$request->full_name;
    $userdata->email=$request->email;
    $userdata->phone=$request->phone;
    // $userdata->password=$request->password;
   
    if ($request->filled('password')) {
        $rules['password'] = [
            'string',
            'min:8', // Minimum length of 8 characters
            'max:17',
            'regex:/[A-Z]/', // Requires at least one uppercase letter
            'regex:/[a-z]/', // Requires at least one lowercase letter
            'regex:/[0-9]/', // Requires at least one digit
            'regex:/[@$!%£*#?&]/', // Requires at least one special character
        ];
        $rules['confirm_password']=[
        'confirm_password'=>'same:password', 
        ];
       
        $userdata->password = Hash::make($request->input('password'));
    }
    $request->validate($rules);
    $userdata->save();
    return redirect()->back()->with('success','Profile has been updated.');
 }
}




//Logout functionality
public function logout() {
    // $data=User::where('id','=',Auth::User()->id)->first();
    // $data->twoFA_code=Hash::make(0);
    Session::flush();
    Auth::logout();

    return redirect('login')->with('success','Logout succesfull. So sad to see you go.');
}
//End of logout functions



// public function verifyforgotToken(Request $request){
//     $title='Verify Password Reset token '; 
   
//     // $now = Carbon::now();
//     //  $expire=Config::get('auth.passwords.users.expire');
//     // //$expire=Config::get('auth.passwords.users.expire');
//     // $expiresAt = Carbon::parse($expire); // Assuming $expiresAt is the token expiration timestamp
//     // $minutesRemaining = $expiresAt->diffInMinutes($now);

//     // $tokenExpirationMinutes = Config::get('auth.passwords.users.expire');
//     // // Calculate the token expiration timestamp
//     // $tokenExpirationTimestamp =$now->addMinutes(30);

    
//     // 'expire','now','minutesRemaining','tokenExpirationMinutes', 'tokenExpirationTimestamp'

//     if ($request->isMethod('get')) 
//     {
    
//     return view('auth/forgot_password/verifyemailotp',compact('title'));    
//     }
//     if ($request->isMethod('post')) 
//     {
//         $otp=123;
//         if($request->resettoken==$otp)
//         {
//         dd('Your OTP is verified');
//         }
//         else{
//             dd('Wrong OTP code ');
//         }

//     }
// }





}
