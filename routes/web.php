<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Agent\AgentAuthController;
use App\Http\Controllers\Admin\AgentController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\ListingController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\BuyerController;
use App\Http\Controllers\Admin\OfferController;
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
    return view('custom-welcome');
});
Route::group(['middleware' => 'authcheck','prefix' => 'admin'], function () {
    Route::get('/', [AdminAuthController::class, 'dashboard']); 
    Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])->name('admin.dashboard'); 
    //Route for agents start
    Route::get('/agent/list', [AgentController::class, 'index'])->name('list.agent');
    Route::get('create/agent',[AgentController::class,'create'])->name('create.agent');
    Route::post('save/agent',[AgentController::class,'store'])->name('register.agent');
    Route::get('edit/agent/{id}',[AgentController::class,'edit'])->name('edit.agent');
    Route::put('update/agent/{id}',[AgentController::class,'update'])->name('update.agent');
    Route::put('upload/agent/avatar/{id}',[AgentController::class,'updateImage'])->name('upload.agent.avatar');
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
    Route::put('upload/listing/avatar/{id}',[ListingController::class,'updateImage'])->name('upload.listing.avatar');
    Route::get('/listing/form', [ListingController::class, 'form'])->name('listing.form');
    Route::get('/listing/form/{id}', [ListingController::class, 'editListingForm'])->name('edit.listing.form');
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


    Route::get('edit/listing/step1/{id}', [ListingController::class, 'editStep1'])->name('edit.listing.step1');
    Route::get('edit/listing/step2/{id}', [ListingController::class, 'editStep2'])->name('edit.listing.step2');
    Route::get('edit/listing/step3/{id}', [ListingController::class, 'editStep3'])->name('edit.listing.step3');
    Route::get('edit/listing/step4/{id}', [ListingController::class, 'editStep4'])->name('edit.listing.step4');
    Route::get('edit/listing/step5/{id}', [ListingController::class, 'editStep5'])->name('edit.listing.step5');
   Route::post('update/listing/step1/{id}', [ListingController::class, 'updateStep1'])->name('update.listing.step1');
    Route::post('update/listing/step2/{id}', [ListingController::class, 'updateStep2'])->name('update.listing.step2');
   Route::post('update/listing/step3/{id}', [ListingController::class, 'updateStep3'])->name('update.listing.step3');
   Route::post('update/listing/step4/{id}', [ListingController::class, 'updateStep4'])->name('update.listing.step4');
   Route::post('update/listing/step5/{id}', [ListingController::class, 'updateStep5'])->name('update.listing.step5');
     //End route for listing
     //route for import/export
     Route::get('get/options/{id}', [ListingController::class, 'getOptions'])->name('get.options');
     Route::get('data/import', [ListingController::class, 'getImportFile'])->name('data.import.view');
     Route::post('data/import', [ListingController::class, 'importCsv'])->name('data.import');
     //end route for import/export
     //start route for leads
     Route::get('/lead/all', [LeadController::class, 'index'])->name('all.lead');
     Route::get('create/lead',[LeadController::class,'create'])->name('create.lead');
     Route::post('store/lead',[LeadController::class,'store'])->name('store.lead');
     Route::get('edit/lead/{id}',[LeadController::class,'edit'])->name('edit.lead');
     Route::put('update/lead/{id}',[LeadController::class,'update'])->name('update.lead');
     Route::get('view/lead/{id}',[LeadController::class,'show'])->name('show.lead');
     Route::delete('/lead/destroy/{id}',[LeadController::class,'destroy'])->name('lead.destroy');
     //end route for leads

     //routes for buyers
   /*  Route::get('/buyer/{id?}', [BuyerController::class,'showForm'])->name('buyerForm');
    Route::post('/buyer',  [BuyerController::class,'processForm'])->name('buyerForm.process'); */
   /*  Route::match(['get', 'post'], 'buyer', [BuyerController::class, 'processForm'])->name('buyerForm.process'); */
   Route::get('/buyer/list', [BuyerController::class, 'index'])->name('list.buyer');
   Route::get('view/buyer/{id}',[BuyerController::class,'show'])->name('show.buyer');
   Route::delete('/buyer/{id}',[BuyerController::class,'destroy'])->name('buyer.destroy');
     //end route for buyers

    //routes for offers
   Route::get('/offer', [OfferController::class, 'showForm'])->name('offer.form');
    Route::post('/offer', [OfferController::class, 'processForm'])->name('offer.form.process');
     //end route for offers

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

