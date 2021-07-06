<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailerController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SendmailController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/home', [App\Http\Controllers\CustomerController::class, 'store'])->name('store');

Route::post('/image', [App\Http\Controllers\CustomerController::class, 'create'])->name('image.store');


Route::get("email", [MailerController::class, "email"])->name("email");

Route::post("send-email", [MailerController::class, "composeEmail"])->name("send-email");


Route::post('sendemail',[SendmailController::class,'sendmail'])->name('sendMyMail');