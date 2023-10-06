<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TherapistController;
use App\Http\Controllers\ExpertController;
use App\Http\Controllers\JournalController;
use App\Mail\TwoFA_Login;
use Illuminate\Support\Facades\Mail;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
    // dd(session()->all());

});

//Authentication
Route::get('/login', [AuthController::class,'loginview'])->middleware('AlreadyAuth');
Route::get('/register', [AuthController::class,'registerview'])->middleware('AlreadyAuth');
Route::post('/registerUser', [AuthController::class,'registerUser']);
// Route::post('/customRegistration', [AuthController::class,'customRegistration']);
Route::post('/loginUser', [AuthController::class,'loginUser']);
Route::get('/dashboard', [AuthController::class,'dashboard'])->middleware('isLoggedin');

Route::get('/twofaview', [AuthController::class,'twofaview'])->middleware('auth');
// 'AlreadyAuth','2FAVerified',
Route::post('verify2FA', [AuthController::class,'verify2FA']);
Route::get('enable2FA/{id}', [AuthController::class,'enable2FA']);
Route::get('disable2FA/{id}', [AuthController::class,'disable2FA']);


Route::get('/chart-data',[AuthController::class,'getData']);


Route::get('/logout', [AuthController::class,'logout']);



Route::match(['get', 'post'], '/forgotpassword',[AuthController::class,'forgotpassword'] );



Route::get('/resetpasswordlink/{token}', [AuthController::class,'resetpasswordlink']);
route::match(['get', 'post'],'/resetpassword/{token}',[AuthController::class,'resetpassword']);


//Profile Update
Route::match(['get', 'post'],'profile/{id}',[AuthController::class,'profile'] )->middleware('AlreadyAuth','isLoggedin');







//Admin Controlls
Route::middleware(['admin','AlreadyAuth', 'isLoggedin'])->group(function () {

Route::get('/users', [AdminController::class,'users']);
Route::match(['get', 'post'],'updateuser/{id}',[AdminController::class,'updateuser'] );
route::get('deleteuser/{id}',[AdminController::class,'deleteuser']);

});

// 'AlreadyAuth','2FAVerified',



//Students routes
Route::middleware(['auth','student'])->group(function () 
{
route::get('progress',[ExpertController::class,'progress']);
Route::match(['get', 'post'],'expertsystem',[ExpertController::class,'expertsystem'] );
route::get('viewdiagnosis/{exp_id}',[ExpertController::class,'viewdiagnosis']);
route::get('deletediagnosis/{exp_id}',[ExpertController::class,'deletediagnosis']);
route::post('expertsystem2',[ExpertController::class,'expertsystem2']);

//Journal controls
route::get('/journalstudent',[JournalController::class,'journalstudent']);
route::get('viewjournal/{Journal_id}',[JournalController::class,'viewjournal']);
Route::match(['get', 'post'],'createjournal',[JournalController::class,'createjournal'] );
Route::match(['get', 'post'],'updatejournal/{Journal_id}',[JournalController::class,'updatejournal'] );
route::get('deletejournal/{Journal_id}',[JournalController::class,'deletejournal']);
route::get('publicjournal',[JournalController::class,'publicjournal']);
route::get('privatejournal',[JournalController::class,'privatejournal']);

route::get('publicselectjournal/{Journal_id}',[JournalController::class,'publicselectjournal']);
route::get('privateselectjournal/{Journal_id}',[JournalController::class,'privateselectjournal']);

});




//Therapists routes
Route::middleware(['therapist'])->group(function () 
{

route::get('/studentprogress',[TherapistController::class,'studentprogress']);
route::get('/viewstudent/{id}',[TherapistController::class,'viewstudent']);
route::get('/viewstudentdiagnosis/{exp_id}',[TherapistController::class,'viewstudentdiagnosis']);
route::get('/viewstudentjournals',[TherapistController::class,'viewstudentjournals']);
route::get('/studentjournals/{id}',[TherapistController::class,'studentjournals']);
route::get('/viewindividualjournal/{Journal_id}',[TherapistController::class,'viewindividualjournal']);

route::get('/therapistprofile',[TherapistController::class,'therapistprofile']);
Route::match(['get', 'post'],'createtherapistprofile',[TherapistController::class,'createtherapistprofile'] );
route::get('profileview/{therapist_id}',[TherapistController::class,'profileview']);
route::get('deleteprofile/{therapist_id}',[TherapistController::class,'deleteprofile']);
Route::match(['get', 'post'],'updateprofile/{therapist_id}',[TherapistController::class,'updateprofile'] );
});
    










