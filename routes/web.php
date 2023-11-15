<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TherapistController;
use App\Http\Controllers\ExpertController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\TimeslotController;
use App\Http\Controllers\LoginController;
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
Route::post('/authenticate', [AuthController::class,'authenticate']);
Route::post('/verifyLoginOtp', [LoginController::class,'verifyLoginOtp']);
Route::get('/twofaview', [AuthController::class,'twofaview']);
Route::get('resendOtp', [AuthController::class,'resendOtp']);


Route::get('/login', [AuthController::class,'loginview'])->middleware('AlreadyAuth');
Route::get('/register', [AuthController::class,'registerview'])->middleware('AlreadyAuth');
Route::post('/registerUser', [AuthController::class,'registerUser']);
// Route::post('/customRegistration', [AuthController::class,'customRegistration']);


Route::get('/dashboard', [AuthController::class,'dashboard']);
// ->middleware('isLoggedin');


// ->middleware('auth');
// 'AlreadyAuth','2FAVerified',


//OLD Authentication
Route::post('/loginUser', [AuthController::class,'loginUser']);
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
Route::middleware(['auth','admin'])->group(function () {

Route::get('/users', [AdminController::class,'users']);
Route::match(['get', 'post'],'updateuser/{id}',[AdminController::class,'updateuser'] );
route::get('deleteuser/{id}',[AdminController::class,'deleteuser']);
route::post('createuser',[AdminController::class,'createuser']);

//Admin Expert system recommendations
route::get('/getadminrecommendations',[AdminController::class,'getadminrecommendations']);
Route::post('/updaterecommendation/{Recommendations_id}',[AdminController::class,'updaterecommendation']);
route::get('/getadminRecommendationDetails/{Recommendations_id}',[AdminController::class,'getadminRecommendationDetails']);
route::post('/createrecommendation',[AdminController::class,'createrecommendation']);
route::get('/deleterecommendation/{Recommendations_id}',[AdminController::class,'deleterecommendation']);

//Therapist Profiles routes
route::get('/therapistprofiles',[AdminController::class,'therapistprofiles']);
route::get('viewtherapistprofile/{therapist_id}',[AdminController::class,'viewtherapistprofile']);

Route::match(['get', 'post'],'updatetherapistprofile/{therapist_id}',[AdminController::class,'updatetherapistprofile'] );
Route::get('deletetherapistprofile/{therapist_id}',[AdminController::class,'deletetherapistprofile']);
Route::match(['get', 'post'],'admincreatetherapistprofile',[AdminController::class,'admincreatetherapistprofile'] );

//Journal controlls
route::get('/adminstudentjournals',[AdminController::class,'adminstudentjournals']);

route::get('/adminviewstudentjournal/{id}',[AdminController::class,'adminviewstudentjournal']);

Route::match(['get', 'post'],'adminupdatejournal/{Journal_id}',[AdminController::class,'adminupdatejournal'] );
route::get('admindeletejournal/{Journal_id}',[AdminController::class,'admindeletejournal']);


route::get('/adminpublicjournal/{id}',[AdminController::class,'adminpublicjournal']);
route::get('/adminprivatejournal/{id}',[AdminController::class,'adminprivatejournal']);

route::get('adminpublicselectjournal/{Journal_id}',[AdminController::class,'adminpublicselectjournal']);
route::get('adminprivateselectjournal/{Journal_id}',[AdminController::class,'adminprivateselectjournal']);

//Appointments
route::get('/allstudents',[AdminController::class,'allstudents']);
route::get('/adminAppointments/{id}',[AdminController::class,'adminAppointments']);
route::get('admindeleteappointment/{appointment_id}',[AdminController::class, 'admindeleteappointment']);
Route::match(['get', 'post'],'adminupdateappointment/{appointment_id}',[AdminController::class,'adminupdateappointment'] );

//Display only therapists and students
route::get('displayonlytherapists',[AdminController::class, 'displayonlytherapists']);
route::get('displayonlystudents',[AdminController::class, 'displayonlystudents']);

//Chosen therapists routes
route::get('studentschosen',[AdminController::class, 'studentschosen']);
route::get('studentschosentherapist/{id}',[AdminController::class, 'studentschosentherapist']);
route::get('admindeletetherapistapplication/{ChooseID}',[AdminController::class, 'admindeletetherapistapplication']);
route::get('/adminacceptapplication/{ChooseID}',[AdminController::class,'adminacceptapplication']);
route::get('/adminrejectapplication/{ChooseID}',[AdminController::class,'adminrejectapplication']);

//Rules Routes
Route::get('/exprules',[AdminController::class,'exprules']);

//Therapists timeslots
route::get('therapiststimeslot',[TimeslotController::class,'therapiststimeslot']);
route::get('admintimeslotspage/{id}',[TimeslotController::class,'admintimeslotspage']);

Route::match(['get', 'post'],'admincreatetimeslot/{id}',[TimeslotController::class,'admincreatetimeslot'] );
Route::match(['get', 'post'],'adminupdatetimeslot/{time_id}',[TimeslotController::class,'adminupdatetimeslot'] );
route::get('admindeletetimeslot/{time_id}',[TimeslotController::class,'admindeletetimeslot']);


//Admin therapist appliation approval

Route::get('acceptprofile/{therapist_id}', [AdminController::class,'acceptprofile']);
Route::get('rejectprofile/{therapist_id}', [AdminController::class,'rejectprofile']);

});

// 'AlreadyAuth','2FAVerified',



//Students routes
Route::middleware(['auth','student'])->group(function () 
{
route::get('timeslots',[AppointmentController::class,'timeslots']);
// Route::get('/timeslots/available', 'TimeSlotController@getAvailableTimeSlots')->name('timeslots.available');
route::get('expertsystemdiagnosis',[ExpertController::class,'expertsystemdiagnosis']);
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

//Therapist profile routes
route::get('/studenttherapistprofile',[StudentController::class,'studenttherapistprofile']);
route::get('/viewtherapist/{therapist_id}',[StudentController::class,'viewtherapist']);
route::post('createappointment',[AppointmentController::class,'createappointment']);
route::get('myAppointments',[AppointmentController::class,'myAppointments']);
route::get('deleteappointment/{appointment_id}',[AppointmentController::class, 'deleteappointment']);
route::get('viewappointment/{appointment_id}',[AppointmentController::class, 'viewappointment']);
Route::match(['get', 'post'],'updateappointment/{appointment_id}',[AppointmentController::class,'updateappointment'] );


//Progress pdf routes
Route::get('/myprogresspdf', [StudentController::class, 'myprogresspdf']);
route::get('/progresspdfview',[StudentController::class,'progresspdfview']);

//Select Therapist Routes
route::get('/deletetherapistapplication/{ChooseID}',[StudentController::class,'deletetherapistapplication']);
route::post('/choosetherapist/{therapist_id}',[StudentController::class,'choosetherapist']);
route::get('/selecttherapist/{ChooseID}',[StudentController::class,'selecttherapist']);
route::get('/deselecttherapist/{ChooseID}',[StudentController::class,'deselecttherapist']);
// route::get('/myChart',[StudentController::class,'myChart']);

});




//Therapists routes
Route::middleware(['auth','therapist'])->group(function () 
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

//Appointments
route::get('viewstudentappointments',[AppointmentController::class,'viewstudentsappointments']);
// route::get('viewmodalappointment/{appointment_id}',[AppointmentController::class, 'viewappointment']);
Route::get('acceptapt/{appointment_id}', [AppointmentController::class,'acceptapt']);
Route::get('rejectapt/{appointment_id}', [AppointmentController::class,'rejectapt']);
Route::match(['get', 'post'],'modalrejection/{appointment_id}',[AppointmentController::class,'modalrejection'] );
Route::match(['get', 'post'],'modalonline/{appointment_id}',[AppointmentController::class,'modalonline']);
//Expert system recommendations
route::get('/getrecommendations',[TherapistController::class,'getrecommendations']);

// 
Route::post('/addrecommendation/{Recommendations_id}',[TherapistController::class,'addrecommendation']);

route::get('/getRecommendationDetails/{Recommendations_id}',[TherapistController::class,'getRecommendationDetails']);
//Clients choosing therapist routes
route::get('/myclients',[TherapistController::class,'myclients']);
route::get('/acceptclient/{ChooseID}',[TherapistController::class,'acceptclient']);
route::get('/rejectclient/{ChooseID}',[TherapistController::class,'rejectclient']);

//Reports pdf
Route::get('/studentpdfview/{id}', [TherapistController::class, 'studentpdfview']);
Route::get('/studentprogresspdf/{id}', [TherapistController::class, 'studentprogresspdf']);
Route::post('/appointmentcreate', [TherapistController::class, 'appointmentcreate']);


//Notifications
Route::get('/therapistnotifications', [TherapistController::class, 'therapistnotifications']);
route::get('/markread/{NotID}',[TherapistController::class,'markread']);
route::get('/markunread/{NotID}',[TherapistController::class,'markunread']);
route::get('/deletenotification/{NotID}',[TherapistController::class,'deletenotification']);

//Timeslots
route::get('timeslotstherapist',[TimeslotController::class,'timeslotstherapist']);



route::get('timeslotspage',[TimeslotController::class,'timeslotspage']);
Route::match(['get', 'post'],'createtimeslot',[TimeslotController::class,'createtimeslot'] );
Route::match(['get', 'post'],'updatetimeslot/{time_id}',[TimeslotController::class,'updatetimeslot'] );
route::get('deletetimeslot/{time_id}',[TimeslotController::class,'deletetimeslot']);


});
    










