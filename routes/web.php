<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Agent\AgentAuthController;
use App\Http\Controllers\Admin\AgentController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\ListingController;
use App\Http\Controllers\Auth\ForgetPasswordController;


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
Route::group(['middleware' => 'authcheck','prefix' => 'admin'], function () {
    Route::get('/dashboard', [AdminAuthController::class, 'dashboard']); 
    //Route for agents start
    Route::get('/agent/list', [AgentController::class, 'index'])->name('list.agent');
    Route::get('create/agent',[AgentController::class,'create'])->name('create.agent');
    Route::post('save/agent',[AgentController::class,'store'])->name('register.agent');
    Route::get('edit/agent/{id}',[AgentController::class,'edit'])->name('edit.agent');
    Route::put('update/agent/{id}',[AgentController::class,'update'])->name('update.agent');
    Route::get('view/agent/{id}',[AgentController::class,'show'])->name('show.agent');
    Route::delete('/agents/{id}',[AgentController::class,'destroy'])->name('agents.destroy');
    //End Route for agent

    //Route for user reset password
    Route::get('reset/password',[ResetPasswordController::class,'index'])->name('reset.password');
    Route::post('reset/password/link',[ResetPasswordController::class,'resetpasswordlink'])->name('reset.password.link');
    //End route for reset password

     //Route for user profile
    Route::get('profile',[AdminProfileController::class,'showProfile'])->name('show.profile');
    Route::get('edit/profile/{id}',[AdminProfileController::class,'editProfile'])->name('edit.profile');
    Route::put('update/profile/{id}',[AdminProfileController::class,'updateProfile'])->name('update.profile');
    //end route for user profile

     //Route for user listing
    Route::get('/listing/all', [ListingController::class, 'index'])->name('all.listing');
    Route::get('view/listing/{id}',[ListingController::class,'show'])->name('show.listing');
    Route::delete('/listing/{id}',[ListingController::class,'destroy'])->name('listing.destroy');
    Route::get('/listing/form', [ListingController::class, 'form'])->name('listing.form');
    Route::get('create/listing/step1', [ListingController::class, 'createStep1'])->name('create.listing.step1');
    Route::get('create/listing/step2', [ListingController::class, 'createStep2'])->name('create.listing.step2');
    Route::get('create/listing/step3', [ListingController::class, 'createStep3'])->name('create.listing.step3');
    Route::get('create/listing/step4', [ListingController::class, 'createStep4'])->name('create.listing.step4');
    Route::get('create/listing/step5', [ListingController::class, 'createStep5'])->name('create.listing.step5');
    Route::post('store/listing/step1', [ListingController::class, 'storeStep1'])->name('store.listing.step1');
    Route::post('store/listing/step2', [ListingController::class, 'storeStep2'])->name('store.listing.step2');
    Route::post('store/listing/step3', [ListingController::class, 'storeStep3'])->name('store.listing.step3');
    Route::post('store/listing/step4', [ListingController::class, 'storeStep4'])->name('store.listing.step4');
    Route::post('store/listing/step5', [ListingController::class, 'storeStep5'])->name('store.listing.step5');
     //End route for listing

});
Route::group(['middleware' => 'agentcheck','prefix' => 'agent'], function () {
    Route::get('/dashboard', [AgentAuthController::class, 'agentDashboard']); 
  
});

Route::get('login', [AdminAuthController::class, 'index'])->name('login');
Route::get('registration', [AdminAuthController::class, 'registration'])->name('register-user');
Route::post('custom-login', [AdminAuthController::class, 'customLogin'])->name('login.custom'); 
Route::post('custom-registration', [AdminAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [AdminAuthController::class, 'signOut'])->name('signout');
// route for forget password
Route::get('forget/password', [ForgetPasswordController::class, 'index'])->name('forget.password');
Route::post('update/password/link', [ForgetPasswordController::class, 'updatePasswordLink'])->name('update.password.link');
Route::get('update/password', [ForgetPasswordController::class, 'updatePassword'])->name('update.password');
Route::post('reset/forget/password', [ForgetPasswordController::class, 'resetForgetPassword'])->name('reset.forget.password');
//end route for forget password

