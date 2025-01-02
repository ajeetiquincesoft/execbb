<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AgentController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\ListingController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\BuyerController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ReferralController;
use App\Http\Controllers\Admin\ShowingController;
use App\Http\Controllers\Admin\LoginActivityController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\ReferralTypeController;
use App\Http\Controllers\Admin\ContactTypeController;
use App\Http\Controllers\Admin\ProbMatchController;
use App\Http\Controllers\Admin\CriteriaRankController;
use App\Http\Controllers\Auth\ForgetPasswordController;
use App\Http\Controllers\Admin\EmailBuyerController;
use App\Http\Controllers\Admin\ReportsController;
//Controller for agent
use App\Http\Controllers\Agent\AgentAuthController;
use App\Http\Controllers\Agent\AgentBuyerController;
use App\Http\Controllers\Auth\AgentResetPasswordController;
use App\Http\Controllers\Agent\AgentProfileController;
use App\Http\Controllers\Agent\AgentListingController;
use App\Http\Controllers\Agent\AgentLoginActivityController;
use App\Http\Controllers\Agent\AgentEmailBuyerController;
use App\Http\Controllers\Agent\AgentReportController;

//Controller for buyer
use App\Http\Controllers\Buyer\BuyerAuthController;

//Controller for frontend
use App\Http\Controllers\RegisterWithEbbController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\BrokersController;
use App\Http\Controllers\BusinessListingController;
use App\Http\Controllers\BuyerCommentController;






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
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [SearchController::class, 'index'])->name('search.index');
Route::get('/business/listing/search', [SearchController::class, 'searchBusinessListing'])->name('business.listing.search');
Route::get('/all/brokers', [BrokersController::class, 'index'])->name('all.brokers');
Route::get('view/broker/profile/{id}', [BrokersController::class, 'brokerProfile'])->name('view.broker.profile');
Route::get('/business/listings', [BusinessListingController::class, 'index'])->name('business.listings');
Route::get('view/business/listing/{id}', [BusinessListingController::class, 'viewBusinessListing'])->name('view.business.listing');
Route::post('/buyer/comment/{id}', [BuyerCommentController::class, 'buyerComment'])->name('buyer.comment');
Route::get('/buyers', function () {
  $breadcrumbs = [
    ['title' => 'Home', 'url' => url('/')],
    ['title' => 'Buy a Business', 'url' => url('#')],
    ['title' => 'Buyers', 'url' => url("/buyers")],
  ];
  return view('frontend.buyers', compact('breadcrumbs'));
})->name('ebb.buyers');
Route::get('/buyer/tools', function () {
  return view('frontend.buyer-tools');
})->name('buyer.tools');
Route::get('/seller/tools', function () {
  return view('frontend.seller-tools');
})->name('seller.tools');
Route::get('/seller', function () {
  return view('frontend.sellers');
})->name('seller');
Route::get('/services', function () {
  return view('frontend.our-services');
})->name('services');
Route::get('/list-with-ebb', function () {
  return view('frontend.list-with-ebb');
})->name('list.with.ebb');
Route::get('/open-list-with-ebb', function () {
  return view('frontend.open-list-with-ebb');
})->name('open-list.with.ebb');
Route::get('/faqs', function () {
  return view('frontend.faqs');
})->name('faqs');
Route::get('/terms-of-use', function () {
  return view('frontend.terms-of-use');
})->name('terms.of.use');
Route::get('/contact-us', function () {
  return view('frontend.contact-us');
})->name('contact.us');
Route::get('/seller-register-with-ebb', function () {
  return view('frontend.seller-register-with-ebb');
})->name('seller.register.with.ebb');
Route::get('/privacy-policy', function () {
  return view('frontend.privacy-policy');
})->name('privacy.policy');
Route::get('/about-us', function () {
  return view('frontend.about-us');
})->name('about.us');
Route::get('/management', function () {
  return view('frontend.management');
})->name('management');
Route::get('/why-ebb', function () {
  return view('frontend.why-ebb');
})->name('why.ebb');
Route::get('/join-ebb', function () {
  return view('frontend.join-ebb');
})->name('join.ebb');
Route::get('/strategic-alliances', function () {
  return view('frontend.strategic-alliances');
})->name('strategic.alliances');
Route::get('/financing', function () {
  return view('frontend.financing');
})->name('financing');
Route::get('/consulting', function () {
  return view('frontend.consulting');
})->name('consulting');
Route::get('/preferred-buyers-program', function () {
  return view('frontend.preferred-buyers-program');
})->name('preferred.buyers.program');
Route::get('/mergers-and-acquisitions', function () {
  return view('frontend.mergers-and-acquisitions');
})->name('mergers.and.acquisitions');
Route::get('/business-valuation', function () {
  return view('frontend.business-valuation');
})->name('business.valuation');
Route::get('/success-stories', function () {
  return view('frontend.success-stories');
})->name('success.stories');
Route::get('register/ebb/buyer', [RegisterWithEbbController::class, 'register'])->name('register.ebb.buyer');
Route::get('/register/with/ebb', [RegisterWithEbbController::class, 'registerWithEbb'])->name('register.with.ebb');
Route::post('/register/with/ebb',  [RegisterWithEbbController::class, 'storeRegisterWithEbb'])->name('store.register.with.ebb');
Route::get('/get/business/type/{id}', [RegisterWithEbbController::class, 'getBusType'])->name('get.business.type');
Route::group(['middleware' => 'authcheck', 'prefix' => 'admin'], function () {
  Route::get('/', [AdminAuthController::class, 'dashboard']);
  Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])->name('admin.dashboard');
  Route::get('login-activities', [LoginActivityController::class, 'index'])->name('login.activities');
  //Route for criteria rank start
  Route::get('criteria-rank', [CriteriaRankController::class, 'index'])->name('criteriarank');
  Route::get('create/criteria-rank', [CriteriaRankController::class, 'create'])->name('create.criteriarank');
  Route::post('store/criteria-rank', [CriteriaRankController::class, 'store'])->name('store.criteriarank');
  Route::get('edit/criteria-rank/{id}', [CriteriaRankController::class, 'edit'])->name('edit.criteriarank');
  Route::put('update/criteria-rank/{id}', [CriteriaRankController::class, 'update'])->name('update.criteriarank');
  Route::delete('/criteria-rank/{id}', [CriteriaRankController::class, 'destroy'])->name('criteriarank.destroy');
  //end Route for criteria rank
  //Route for prob match start
  Route::get('probmatch', [ProbMatchController::class, 'index'])->name('probmatch');
  Route::get('create/probmatch', [ProbMatchController::class, 'create'])->name('create.probmatch');
  Route::post('store/probmatch', [ProbMatchController::class, 'store'])->name('store.probmatch');
  Route::get('edit/probmatch/{id}', [ProbMatchController::class, 'edit'])->name('edit.probmatch');
  Route::put('update/probmatch/{id}', [ProbMatchController::class, 'update'])->name('update.probmatch');
  Route::delete('/probmatch/{id}', [ProbMatchController::class, 'destroy'])->name('probmatch.destroy');
  //end Route for prob match
  //Route for contact type start
  Route::get('contact-type', [ContactTypeController::class, 'index'])->name('contact-type');
  Route::get('create/contact-type', [ContactTypeController::class, 'create'])->name('create.contact-type');
  Route::post('store/contact-type', [ContactTypeController::class, 'store'])->name('store.contact-type');
  Route::get('edit/contact-type/{id}', [ContactTypeController::class, 'editContactType'])->name('edit.contact-type');
  Route::put('update/contact-type/{id}', [ContactTypeController::class, 'updateContactType'])->name('update.contact-type');
  Route::delete('/contact-type/{id}', [ContactTypeController::class, 'destroy'])->name('contact-type.destroy');
  //Route for contact type end
  //Route for referral type start
  Route::get('referral-type', [ReferralTypeController::class, 'index'])->name('referral-type');
  Route::get('create/referral-type', [ReferralTypeController::class, 'create'])->name('create.referral-type');
  Route::post('store/referral-type', [ReferralTypeController::class, 'store'])->name('store.referral-type');
  Route::get('edit/referral-type/{id}', [ReferralTypeController::class, 'editReferralType'])->name('edit.referral-type');
  Route::put('update/referral-type/{id}', [ReferralTypeController::class, 'updateReferralType'])->name('update.referral-type');
  Route::delete('/referral-type/{id}', [ReferralTypeController::class, 'destroy'])->name('referral-type.destroy');
  //Route for referral type end
  //Route for category start
  Route::get('categories', [CategoriesController::class, 'index'])->name('categories');
  Route::get('create/categories', [CategoriesController::class, 'create'])->name('create.category');
  Route::post('store/categories', [CategoriesController::class, 'store'])->name('store.category');
  Route::get('edit/categories/{id}', [CategoriesController::class, 'editCategory'])->name('edit.categories');
  Route::put('update/categories/{id}', [CategoriesController::class, 'updateCategory'])->name('update.categories');
  Route::delete('/categories/{id}', [CategoriesController::class, 'destroy'])->name('category.destroy');
  //Route for category end
  //Route for agents start
  Route::get('/agent/list', [AgentController::class, 'index'])->name('list.agent');
  Route::get('create/agent', [AgentController::class, 'create'])->name('create.agent');
  Route::post('save/agent', [AgentController::class, 'store'])->name('register.agent');
  Route::get('edit/agent/{id}', [AgentController::class, 'edit'])->name('edit.agent');
  Route::put('update/agent/{id}', [AgentController::class, 'update'])->name('update.agent');
  Route::put('upload/agent/avatar/{id}', [AgentController::class, 'updateImage'])->name('upload.agent.avatar');
  Route::get('view/agent/{id}', [AgentController::class, 'show'])->name('show.agent');
  Route::delete('/agents/{id}', [AgentController::class, 'destroy'])->name('agents.destroy');
  //End Route for agent

  //Route for user reset password
  Route::get('reset/password', [ResetPasswordController::class, 'index'])->name('reset.password');
  Route::post('reset/password/link', [ResetPasswordController::class, 'resetpasswordlink'])->name('reset.password.link');
  //End route for reset password

  //Route for user profile
  Route::get('profile', [AdminProfileController::class, 'showProfile'])->name('show.profile');
  Route::get('edit/profile/{id}', [AdminProfileController::class, 'editProfile'])->name('edit.profile');
  Route::put('update/profile/{id}', [AdminProfileController::class, 'updateProfile'])->name('update.profile');
  //end route for user profile

  //Route for user listing
  Route::get('/listing/all', [ListingController::class, 'index'])->name('all.listing');
  Route::get('view/listing/{id}', [ListingController::class, 'show'])->name('show.listing');
  Route::delete('/listing/{id}', [ListingController::class, 'destroy'])->name('listing.destroy');
  Route::put('upload/listing/avatar/{id}', [ListingController::class, 'updateImage'])->name('upload.listing.avatar');
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
  Route::post('/listing/bulkAction', [ListingController::class, 'bulkAction'])->name('listing.bulkAction');
  //End route for listing
  //route for import/export
  Route::get('get/options/{id}', [ListingController::class, 'getOptions'])->name('get.options');
  Route::get('data/import', [ListingController::class, 'getImportFile'])->name('data.import.view');
  Route::post('data/import', [ListingController::class, 'importCsv'])->name('data.import');
  //end route for import/export
  //start route for leads
  Route::get('/lead/all', [LeadController::class, 'index'])->name('all.lead');
  Route::get('create/lead', [LeadController::class, 'create'])->name('create.lead');
  Route::post('store/lead', [LeadController::class, 'store'])->name('store.lead');
  Route::get('edit/lead/{id}', [LeadController::class, 'edit'])->name('edit.lead');
  Route::put('update/lead/{id}', [LeadController::class, 'update'])->name('update.lead');
  Route::get('view/lead/{id}', [LeadController::class, 'show'])->name('show.lead');
  Route::delete('/lead/destroy/{id}', [LeadController::class, 'destroy'])->name('lead.destroy');
  //end route for leads

  //routes for buyers
  Route::get('/buyer', [BuyerController::class, 'showForm'])->name('buyerForm');
  Route::post('/buyer',  [BuyerController::class, 'processForm'])->name('buyerForm.process');
  Route::get('/buyer/edit/{id}', [BuyerController::class, 'editForm'])->name('edit.buyer.form');
  Route::post('/buyer/edit/{id}', [BuyerController::class, 'editProcessForm'])->name('edit.buyer.form.process');
  Route::get('/buyer/list', [BuyerController::class, 'index'])->name('list.buyer');
  Route::get('view/buyer/{id}', [BuyerController::class, 'show'])->name('show.buyer');
  Route::delete('/buyer/{id}', [BuyerController::class, 'destroy'])->name('buyer.destroy');
  Route::post('/buyer/bulkAction', [BuyerController::class, 'bulkAction'])->name('buyer.bulkAction');
  //end route for buyers

  //routes for offers
  Route::get('/offer/all', [OfferController::class, 'index'])->name('all.offer');
  Route::get('create/offer', [OfferController::class, 'create'])->name('create.offer');
  Route::get('/offer', [OfferController::class, 'showForm'])->name('offer.form');
  Route::post('/offer', [OfferController::class, 'processForm'])->name('offer.form.process');
  Route::delete('/offer/destroy/{id}', [OfferController::class, 'destroy'])->name('offer.destroy');
  Route::get('/offer/{id}', [OfferController::class, 'editForm'])->name('edit.offer.form');
  Route::post('/offer/{id}', [OfferController::class, 'editProcessForm'])->name('edit.offer.form.process');
  Route::get('/offer/next/prev/{id}', [OfferController::class, 'prevNext'])->name('edit.prev.next');
  Route::get('view/offer/{id}', [OfferController::class, 'show'])->name('show.offer');
  //end route for offers
  //routes for Contacts
  Route::get('/contact/all', [ContactController::class, 'index'])->name('all.contact');
  Route::get('create/contact', [ContactController::class, 'create'])->name('create.contact');
  Route::post('/contact', [ContactController::class, 'processForm'])->name('contact.form.process');
  Route::delete('/contact/destroy/{id}', [ContactController::class, 'destroy'])->name('contact.destroy');
  Route::get('/contact/{id}', [ContactController::class, 'editContact'])->name('edit.contact.form');
  Route::put('update/contact/{id}', [ContactController::class, 'editProcessForm'])->name('edit.contact.form.process');
  Route::get('view/contact/{id}', [ContactController::class, 'show'])->name('show.contact');
  //end route for Contacts

  //routes for referrals
  Route::get('referral/all', [ReferralController::class, 'index'])->name('all.referral');
  Route::get('create/referral', [ReferralController::class, 'create'])->name('create.referral');
  Route::post('store/referral', [ReferralController::class, 'store'])->name('store.referral');
  Route::get('edit/referral/{id}', [ReferralController::class, 'editReferral'])->name('edit.referral');
  Route::put('update/referral/{id}', [ReferralController::class, 'updateReferral'])->name('update.referral');
  Route::get('view/referral/{id}', [ReferralController::class, 'show'])->name('show.referral');
  Route::delete('referral/destroy/{id}', [ReferralController::class, 'destroy'])->name('referral.destroy');
  //end route for Referrals
  //routes for Showing
  Route::get('showing/all', [ShowingController::class, 'index'])->name('all.showing');
  Route::get('create/showing', [ShowingController::class, 'create'])->name('create.showing');
  Route::post('store/showing', [ShowingController::class, 'store'])->name('store.showing');
  Route::get('edit/showing/{id}', [ShowingController::class, 'editShowing'])->name('edit.showing');
  Route::put('update/showing/{id}', [ShowingController::class, 'updateShowing'])->name('update.showing');
  Route::get('view/showing/{id}', [ShowingController::class, 'show'])->name('show.showing');
  Route::delete('showing/destroy/{id}', [ShowingController::class, 'destroy'])->name('showing.destroy');
  //end route for showing
  //Route for send email to buyers
  Route::get('email/buyer', [EmailBuyerController::class, 'index'])->name('email.buyer');
  Route::post('/email/buyer/send', [EmailBuyerController::class, 'sendEmail'])->name('email.buyer.send');
  //End route for send email to buyers
  //Route for admin reports
  Route::get('reports', [ReportsController::class, 'index'])->name('reports');
  Route::post('/export/reports', [ReportsController::class, 'export'])->name('export.reports');
  //End route for admin reports

});
Route::group(['middleware' => 'agentcheck', 'prefix' => 'agent', 'as' => 'agent.'], function () {
  Route::get('/dashboard', [AgentAuthController::class, 'agentDashboard'])->name('dashboard');
  Route::get('login-activities', [AgentLoginActivityController::class, 'index'])->name('login.activities');
  //routes for buyers
  Route::get('buyer/list', [AgentBuyerController::class, 'index'])->name('list.buyer');
  Route::get('view/buyer/{id}', [AgentBuyerController::class, 'show'])->name('show.buyer');
  Route::delete('/buyer/{id}', [AgentBuyerController::class, 'destroy'])->name('buyer.destroy');
  //end route for buyers
  //Route for user reset password
  Route::get('reset/password', [AgentResetPasswordController::class, 'index'])->name('reset.password');
  Route::post('reset/password/link', [AgentResetPasswordController::class, 'resetpasswordlink'])->name('reset.password.link');
  //End route for reset password
  //Route for user profile
  Route::get('profile', [AgentProfileController::class, 'showProfile'])->name('show.profile');
  Route::get('edit/profile/{id}', [AgentProfileController::class, 'editProfile'])->name('edit.profile');
  Route::put('update/profile/{id}', [AgentProfileController::class, 'updateProfile'])->name('update.profile');
  Route::put('upload/agent/avatar/{id}', [AgentProfileController::class, 'updateImage'])->name('upload.agent.avatar');
  //end route for user profile

  Route::get('listing/all', [AgentListingController::class, 'index'])->name('all.listing');
  Route::get('create/listing', [AgentListingController::class, 'create'])->name('create.listing');
  Route::get('view/listing/{id}', [AgentListingController::class, 'show'])->name('show.listing');
  Route::get('/listing', [AgentListingController::class, 'showForm'])->name('listing.form');
  Route::post('/listing', [AgentListingController::class, 'processForm'])->name('listing.form.process');
  Route::get('/listing/{id}', [AgentListingController::class, 'editForm'])->name('edit.listing.form');
  Route::post('/listing/{id}', [AgentListingController::class, 'editProcessForm'])->name('edit.listing.form.process');
  Route::get('get/options/{id}', [AgentListingController::class, 'getOptions'])->name('get.options');
  Route::get('/listing/next/prev/{id}', [AgentListingController::class, 'prevNext'])->name('edit.prev.next');
  Route::delete('/listing/destroy/{id}', [AgentListingController::class, 'destroy'])->name('listing.destroy');

  //Route for send email to buyers
  Route::get('email/buyer', [AgentEmailBuyerController::class, 'index'])->name('email.buyer');
  Route::post('/email/buyer/send', [AgentEmailBuyerController::class, 'sendEmail'])->name('email.buyer.send');
  //End route for send email to buyers
  //Route for admin reports
  Route::get('reports', [AgentReportController::class, 'index'])->name('reports');
  Route::post('/export/reports', [AgentReportController::class, 'export'])->name('export.reports');
  //End route for admin reports

});

Route::group(['middleware' => 'buyercheck', 'prefix' => 'buyer', 'as' => 'buyer.'], function () {
  Route::get('/dashboard', [BuyerAuthController::class, 'buyerDashboard'])->name('dashboard');
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
