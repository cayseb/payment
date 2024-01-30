<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Payment\PaymentController;
use App\Http\Controllers\Payment\SuccessController;
use App\Http\Controllers\Registration\RegistrationController;
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
Route::get('/success', SuccessController::class . '@index')->name('success');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/pay', PaymentController::class . '@index')->name('pay');

Route::post('/login', AuthController::class . '@authenticate');


Route::get('/register', RegistrationController::class . '@index')->name('register.index');
Route::get('/register/store', RegistrationController::class . '@store')->name('register.store');

