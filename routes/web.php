<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Agent\AgentAuthController;
use App\Http\Controllers\Admin\AgentController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\ListingController;


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
    Route::get('/agent/list', [AgentController::class, 'index'])->name('list.agent');
    Route::get('create/agent',[AgentController::class,'create'])->name('create.agent');
    Route::post('save/agent',[AgentController::class,'store'])->name('register.agent');
    Route::get('edit/agent/{id}',[AgentController::class,'edit'])->name('edit.agent');
    Route::put('update/agent/{id}',[AgentController::class,'update'])->name('update.agent');
    Route::get('view/agent/{id}',[AgentController::class,'show'])->name('show.agent');
    Route::delete('/agents/{id}',[AgentController::class,'destroy'])->name('agents.destroy');
    Route::get('reset/password',[ResetPasswordController::class,'index'])->name('reset.password');
    Route::post('reset/password/link',[ResetPasswordController::class,'resetpasswordlink'])->name('reset.password.link');
    Route::get('profile',[AdminProfileController::class,'showProfile'])->name('show.profile');
    Route::get('edit/profile/{id}',[AdminProfileController::class,'editProfile'])->name('edit.profile');
    Route::put('update/profile/{id}',[AdminProfileController::class,'updateProfile'])->name('update.profile');
    Route::get('/listing/all', [ListingController::class, 'index'])->name('all.listing');
    Route::get('create/listing', [ListingController::class, 'create'])->name('create.listing');
});
Route::group(['middleware' => 'agentcheck','prefix' => 'agent'], function () {
    Route::get('/dashboard', [AgentAuthController::class, 'agentDashboard']); 
  
});

Route::get('login', [AdminAuthController::class, 'index'])->name('login');
Route::get('registration', [AdminAuthController::class, 'registration'])->name('register-user');
Route::post('custom-login', [AdminAuthController::class, 'customLogin'])->name('login.custom'); 
Route::post('custom-registration', [AdminAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [AdminAuthController::class, 'signOut'])->name('signout');
