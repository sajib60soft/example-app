<?php

use App\Http\Controllers\EmailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\PushNotificationController;
use App\Http\Controllers\SmsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/test', [HomeController::class, 'test'])->name('test');

Route::get('/mail', [EmailController::class, 'index'])->name('email');
Route::post('/mail-send', [EmailController::class, 'mailSend'])->name('mail.send');

Route::get('/sms', [SmsController::class, 'index'])->name('email');
Route::post('/sms-send', [SmsController::class, 'smsSend'])->name('sms.send');

Route::get('/easy', [SmsController::class, 'easyIndex'])->name('easy');
Route::post('/easy-send', [SmsController::class, 'easySend'])->name('easy.send');

Route::get('/map', [MapController::class, 'index'])->name('map');
Route::post('/map-store', [MapController::class, 'store'])->name('map.store');

Route::get('/notification', [PushNotificationController::class, 'index'])->name('notification');
Route::post('/token-store', [PushNotificationController::class, 'tokenStore'])->name('token.store');
Route::post('/notification-store', [PushNotificationController::class, 'store'])->name('notification.store');
