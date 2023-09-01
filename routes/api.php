<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\VerifyUserController;
use App\Http\Controllers\Api\Auth\LoginGoogleController;
use App\Http\Controllers\Api\Auth\LoginFacebookController;
use App\Http\Controllers\Api\Auth\ResetPasswordUserController;
use App\Http\Controllers\Api\UserTypes\FootballUsersController;
use App\Http\Controllers\Api\UserTypes\Pe\FootballPeController;
use App\Http\Controllers\Api\HomePage\FootballUsersTypesController;
use App\Http\Controllers\Api\UserTypes\Coach\FootballCoachController;
use App\Http\Controllers\Api\UserTypes\Player\FootballPlayerController;



Route::prefix('auth')->group(function () {

    Route::post('register',[RegisterController::class,'register']);
    Route::post('login',[LoginController::class,'login']);
    // ----------------------------------------------------------------------------------
    Route::post('verify/sendOtp',[VerifyUserController::class,'sendOTP']);
    Route::post('verify/checkOtp',[VerifyUserController::class,'checkOTP']);
    Route::post('verify/resendOtp',[VerifyUserController::class,'resendOTP']);
    // ----------------------------------------------------------------------------------

    Route::post('forgetpassword/sendOtp',[ResetPasswordUserController::class,'sendCode']);
    Route::post('forgetpassword/checkOtp',[ResetPasswordUserController::class,'checkOTP']);

    // ----------------------------------------------------------------------------------
    Route::post('social/facebook',[LoginFacebookController::class,'login']);
    Route::post('social/google',[LoginGoogleController::class,'login']);
});
Route::group(['middleware' => ['auth'],'prefix'=>'auth'],function () {
    Route::post('forgetpassword/resetpassword',[ResetPasswordUserController::class,'resetPassword']);
    Route::delete('logout',[LoginController::class,'logout']);
});



Route::group(['middleware' => 'auth','prefix'=>'usertype'],function () {

    Route::get('show',[FootballUsersController::class,'index']);
// ----------------------------------------------------------------------------------------------------------------
    Route::prefix('player')->group(function () {
        Route::post('store', [FootballPlayerController::class, 'storeFootballPlayer'])->middleware('checkprofile');
        Route::put('update', [FootballPlayerController::class, 'updateFootballPlayer']);

    });

// ----------------------------------------------------------------------------------------------------------------
    Route::prefix('coach')->group(function () {
        Route::post('store', [FootballCoachController::class, 'storeFootballCoach'])->middleware('checkprofile');
        Route::put('update', [FootballCoachController::class, 'updateFootballCoach']);
    });


// ----------------------------------------------------------------------------------------------------------------
    Route::prefix('pe')->group(function () {
        Route::post('store', [FootballPeController::class, 'storeFootballPe'])->middleware('checkprofile');
        Route::put('update', [FootballPeController::class, 'updateFootballPe']);
    });

});

Route::group(['middleware'=>'auth','prefix'=>'homepage'],function () {
    Route::get('show',[FootballUsersTypesController::class,'index']);
});




