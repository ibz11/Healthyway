<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
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
    return view('welcome');
});

//Authentication
Route::get('/login', [AuthController::class,'loginview'])->middleware('AlreadyAuth');
Route::get('/register', [AuthController::class,'registerview'])->middleware('AlreadyAuth');
Route::post('/registerUser', [AuthController::class,'registerUser']);
Route::post('/loginUser', [AuthController::class,'loginUser']);
Route::get('/dashboard', [AuthController::class,'dashboard'])->middleware('isLoggedin');

Route::get('/twofaview', [AuthController::class,'twofaview'])->middleware('isLoggedin','2FAVerified');
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






