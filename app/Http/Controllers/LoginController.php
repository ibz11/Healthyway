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
class LoginController extends Controller
{
    
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
        $user->twoFA_code = $fourDigitCode ;
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

public function verifyLoginOtp(Request $request)
{
    $request->validate([
        'otp' => 'required|numeric',
    ]);

    $email = session('email');
    $user = User::where('email', $email)->first();

    // if ($user && $request->otp == $user->otp_code) {
        if($user && $request->twoFA_input == $user->twoFA_code){
        // OTP is valid, complete the login process

        //Check if 2 mins
        // if (Carbon::parse($user->otp_created_at)->addMinutes(2)->isPast()) {
        //     return redirect('/verify-login-otp')->with('error', 'OTP has expired. Please resend.');
        // }
        // else{ 
            $user->twoFA_code = null; // Clear the OTP code
            $user->save();
    
            // Log the user in
            auth()->login($user);
    
            // Clear the email from the session
            $request->session()->forget('email');
    
            return redirect('/dashboard')->with('success', 'You are now logged in!');
        }
       
     else {
        // OTP is invalid, redirect back with an error message
        return redirect('/twofaview')->with('Error', 'Invalid OTP.', ['email'=>$email]);
    }
}

//Resend OTP
public function resendOtp()
{
$email = session('email');
$user = User::where('email', $email)->first();

if ($user) {
    // Generate a new OTP and store the generation time
    $otp = rand(100000, 999999);
    $user->otp_code = $otp;
    $user->otp_created_at = now();
    $user->save();

    // Send the new OTP to the user's email
    Mail::to($user->email)->send(new SendOtpMail($otp));

    return redirect('/verify-login-otp')->with('message', 'A new OTP has been sent to your email.');
} else {
    return redirect('/verify-login-otp')->with('error', 'Error resending OTP. Please try again.');
}
}



}
