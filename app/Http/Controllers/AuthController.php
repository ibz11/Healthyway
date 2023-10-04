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
//use App\Mail\TwoFA_Login;
use App\Helpers\RandomCodeGenerator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;

class AuthController extends Controller
{

//Authentication views
    public function loginview(){
        $error='';
        $title='Login';
        return view('Auth/login',compact('title'));
    }
    public function registerview(){
       
        $title='Register';
        return view('Auth/register',compact('title'));
    }


//Registration and Login functions    
public function registerUser(Request $request){
$password=$request->password; 
$confirm_password=$request->confirmPassword;

$request->validate([
    'full_name'=>'required|min:3',
    'email'=>'required|min:4|email|unique:users',
    'phone'=>'min:10|max:10|unique:users', 
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

$user= new User;
$user->full_name=$request->full_name;
$user->email=$request->email;
$user->phone=$request->phone;
$user->password=Hash::make($request->password);
$res=$user->save();

if($res==true) {
return redirect('login')->with('success','You have been registered successfully');
}
else{
    return back()->with('Error','Something went wrong try again');
}

}

public function loginUser(Request $request){

$request->validate([
    'email'=>'required|min:4|email',
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

 
]);

$user=User::where('email','=',$request->email)->first();
$enabled2FA=User::where('twoFA_enabled','=',1)->first();
$disabled2FA=User::where('twoFA_enabled','=',0)->first();
$verified2FA=User::where('twoFA_enabled','=',1)->first();
$disabled2FA=User::where('twoFA_enabled','=',0)->first();
$twoFAcode=234;

if($user)
{
if(Hash::check($request->password,$user->password)){
        
        
        $request->session()->put('loginId',$user->id);
        if($enabled2FA){
        $fourDigitCode = RandomCodeGenerator::generateRandomCode(4); 
        $user->twoFA_code=Hash::make($fourDigitCode);
        $user->save();
        Mail::to($user->email)->send(new TwoFA_Login($fourDigitCode));
        return redirect('twofaview');
        }
        else{
        
        return redirect('dashboard');
        }
   

    }
    else
    {
        return back()->with('Error','This email is not registered or the password is wrong');
    }

}
else{
    return back()->with('Error','This email is not registered or the password is wrong');
}

}


public function twofaview(){
    $title='Verify 2FA';
    return view ('Panel/verify2fa',compact('title'));
}



public function verify2FA(Request $request){
// $twoFAcode=234;

$data=User::where('id','=',Session::get('loginId'))->first();

if(Hash::check($request->twoFA_input , $data->twoFA_code)){
    //$request->session()->put('loginId',$user->id);
    
    $data->twoFA_verified=1;
    $data->save();
    return redirect('/dashboard')->with('success','Login Successful!');
}
else{
return back()->with('Error',"Wrong 2FA Code.Try again");
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
$userdata =array();
if(Session::has('loginId')){
    $userdata=User::where('id','=',Session::get('loginId'))->first();

if($userdata->role=='admin')
    return view('Panel/Admin/home',compact('userdata'));

else if($userdata->role=='therapist'){
    // $hello=User::all();
    $columnData = [];
    // $hello = User::select('twoFA_enabled')->get();
    $hello=User::select('twoFA_enabled')->where('id','=',Session::get('loginId'))->get();
    foreach ($hello as $hello) {
    $columnData[] = $hello;
    }
    // response()->json($columnData);
    return view('Panel/therapist/home',compact('userdata','columnData'));
}
else if($userdata->role=='student'){
    $columnData = [];
    // $hello = User::select('twoFA_enabled')->get();
    $hello=User::select('twoFA_enabled')->where('id','=',Session::get('loginId'))->get();
    foreach ($hello as $hello) {
    $columnData[] = $hello;
    }
    return view('Panel/student/home',compact('userdata','columnData'));
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



public function logout(){
$verified2FA=User::where('twoFA_verified','=',1)->first();
$disabled2FA=User::where('twoFA_enabled','=',0)->first();

$data=User::where('id','=',Session::get('loginId'))->first();
if(Session::has('loginId')){
        if($verified2FA){
            $data->twoFA_code= 0;
            $data->twoFA_verified=0;
            $data->save();
            Session::pull('loginId');
            return redirect('login');
            
        }
        else{
            Session::pull('loginId');
            return redirect('login');  
        }
       
    }  
}


// public  function testFA(){
//     $fourDigitCode = RandomCodeGenerator::generateRandomCode(4); 
//     dd( $fourDigitCode);
// }



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
