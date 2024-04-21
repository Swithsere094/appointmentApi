<?php

use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\userController;
use App\Http\Controllers\VerificationController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Login
Route::get('/getIdTypes', [HomeController::class, 'getIdTypes'])->name('getIdTypes');
Route::post('/userRegister', [HomeController::class, 'userRegister'])->name('userRegister');
Route::post('/userLogin', [HomeController::class, 'userLogin'])->name('userLogin');
Route::post('/logout', [HomeController::class, 'logout']);

//emailVerification
Route::get('/email/verify/{id}', [VerificationController::class, 'verify'])->name('emailVerify');

//ResetPassword
Route::post('/password/email',  [ForgotPasswordController::class, 'forgotPassword'])->name('forgotPassword');
Route::post('/password/code/check', [ForgotPasswordController::class, 'codeCheck'])->name('codeCheck');
Route::post('/password/reset', [ForgotPasswordController::class, 'resetPassword'])->name('resetPassword');

Route::get('/getBusinessList', [userController::class, 'getBusinessList'])->name('getBusinessList');
