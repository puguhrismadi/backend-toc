<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//old route
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post(
    '/register', 
    [App\Http\Controllers\RegisterController::class, 'register']
)->name('register');

Route::match(
    ['get', 'post'], 
    '/login', 
    [App\Http\Controllers\LoginController::class, 'login']
)->name('login');

Route::post(
    '/resend/email/token', 
    [App\Http\Controllers\RegisterController::class, 'resendPin']
)->name('resendPin');

Route::middleware('auth:sanctum')->group(function () {
    Route::post(
        'email/verify',
        [App\Http\Controllers\RegisterController::class, 'verifyEmail']
    );
    Route::middleware('verify.api')->group(function () {
        Route::post(
            '/logout', 
            [App\Http\Controllers\LoginController::class, 'logout']
        );
    });
});

Route::post(
    '/forgot-password', 
    [App\Http\Controllers\ForgotPasswordController::class, 'forgotPassword']
);
Route::post(
    '/verify/pin', 
    [App\Http\Controllers\ForgotPasswordController::class, 'verifyPin']
);
Route::post(
    '/reset-password', 
    [App\Http\Controllers\ResetPasswordController::class, 'resetPassword']
);
