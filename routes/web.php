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
use App\Http\Controllers\Admin\HotsheetController;
use App\Http\Controllers\Admin\SendListingController;
use App\Http\Controllers\Admin\DownloadActivityController;
use App\Http\Controllers\Admin\ImportCsvController;
use App\Http\Controllers\Admin\MessageController;


//Controller for agent
use App\Http\Controllers\Agent\AgentAuthController;
use App\Http\Controllers\Agent\AgentBuyerController;
use App\Http\Controllers\Auth\AgentResetPasswordController;
use App\Http\Controllers\Agent\AgentProfileController;
use App\Http\Controllers\Agent\AgentListingController;
use App\Http\Controllers\Agent\AgentLoginActivityController;
use App\Http\Controllers\Agent\AgentEmailBuyerController;
use App\Http\Controllers\Agent\AgentReportController;
use App\Http\Controllers\Agent\NotificationController;
use App\Http\Controllers\Agent\AgentLeadController;
use App\Http\Controllers\Agent\AgentMessageController;
use App\Http\Controllers\Agent\AgentHotsheetController;
use App\Http\Controllers\Agent\AgentListingViewByBuyerController;
use App\Http\Controllers\Agent\AgentreferralsController;


//Controller for buyer
use App\Http\Controllers\Buyer\BuyerAuthController;
use App\Http\Controllers\Buyer\BuyerProfileController;
use App\Http\Controllers\Buyer\BuyerChangePasswordController;
use App\Http\Controllers\Buyer\BuyerMessageController;
use App\Http\Controllers\Buyer\FavoriteController;
use App\Http\Controllers\Buyer\SaveSearchController;
use App\Http\Controllers\Buyer\BuyerShowingController;
use App\Http\Controllers\Buyer\BuyerOfferController;
use App\Http\Controllers\Buyer\ShareFactSheetNotificationController;


//Controller for frontend
use App\Http\Controllers\RegisterWithEbbController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\BrokersController;
use App\Http\Controllers\BusinessListingController;
use App\Http\Controllers\BuyerCommentController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ListingLikeController;
use App\Http\Controllers\MortgageCalculatorController;
use App\Http\Controllers\GlossaryController;
use App\Http\Controllers\factSheetController;
use App\Http\Controllers\DownloadNDAFormController;







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
Route::get('/load-more-comments', [BusinessListingController::class, 'loadMoreComments'])->name('load.more.comments');
Route::post('/buyer/comment/{id}', [BuyerCommentController::class, 'buyerComment'])->name('buyer.comment');
Route::get('/contact-us', [ContactUsController::class, 'index'])->name('contact.us');
Route::post('/contact/submit', [ContactUsController::class, 'sendEmail'])->name('contact.submit');
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribeNewsletter'])->name('newsletter.subscribe');
Route::post('/listing/like', [ListingLikeController::class, 'listingLike'])->name('listing.like');
Route::get('/calculate-mortgage-form', [MortgageCalculatorController::class, 'showForm'])->name('calculate.mortgage.form');
Route::post('/calculate-mortgage', [MortgageCalculatorController::class, 'calculateMortgage'])->name('calculate.mortgage');
Route::get('factsheet/{id}', [factSheetController::class, 'index'])->name('listing-factsheet');
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
Route::get('/seller-register-with-ebb', function () {
  return view('frontend.seller-register-with-ebb');
})->name('seller.register.with.ebb');
Route::get('/privacy-policy', function () {
  return view('frontend.privacy-policy');
})->name('privacy.policy');
Route::get('/company', function () {
  return view('frontend.company');
})->name('company');
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
Route::get('/buyer-resource', function () {
  return view('frontend.buyer_resource');
})->name('buyer.resource');
Route::get('/seller-resource', function () {
  return view('frontend.seller_resource');
})->name('seller.resource');
Route::get('/busbuyphase', function () {
  return view('frontend.busbuyphase');
})->name('busbuyphase');
Route::get('/considerations', function () {
  return view('frontend.considerations');
})->name('considerations');
Route::get('/open-consider-pdf', function () {
  return response()->file(public_path('pdfs/w1_what_to_consider.pdf'));
})->name('open.consider.pdf');
Route::get('/duediligence', function () {
  return view('frontend.duediligence');
})->name('duediligence');
Route::get('/organization', function () {
  return view('frontend.organization');
})->name('organization');
Route::get('/proprietor', function () {
  return view('frontend.proprietor');
})->name('proprietor');
Route::get('/partnership', function () {
  return view('frontend.partnership');
})->name('partnership');
Route::get('/corp', function () {
  return view('frontend.corp');
})->name('corp');
Route::get('/ccorp', function () {
  return view('frontend.ccorp');
})->name('ccorp');
Route::get('/scorp', function () {
  return view('frontend.scorp');
})->name('scorp');
Route::get('/llccomp', function () {
  return view('frontend.llccomp');
})->name('llccomp');
Route::get('/qsss', function () {
  return view('frontend.qsss');
})->name('qsss');
Route::get('/anxiety', function () {
  return view('frontend.anxiety');
})->name('anxiety');
Route::get('/salesprep', function () {
  return view('frontend.salesprep');
})->name('salesprep');
Route::get('/twelvepoints', function () {
  return view('frontend.twelvepoints');
})->name('twelvepoints');
Route::get('/questions', function () {
  return view('frontend.questions');
})->name('questions');
Route::get('/multimarketing', function () {
  return view('frontend.multimarketing');
})->name('multimarketing');
Route::get('/sellerinfo', function () {
  return view('frontend.sellerinfo');
})->name('sellerinfo');
Route::get('/fivemistakes', function () {
  return view('frontend.fivemistakes');
})->name('fivemistakes');
Route::get('/factsheet', function () {
  return view('frontend.factsheet');
})->name('factsheet');
Route::get('/valuationmeth', function () {
  return view('frontend.valuationmeth');
})->name('valuationmeth');
Route::get('/valuationfactors', function () {
  return view('frontend.valuationfactors');
})->name('valuationfactors');
Route::get('/job-description', function () {
  return view('frontend.job_description');
})->name('job_description');
Route::get('/compensation', function () {
  return view('frontend.compensation');
})->name('compensation');
Route::get('/qualifications', function () {
  return view('frontend.qualifications');
})->name('qualifications');
Route::get('/training', function () {
  return view('frontend.training');
})->name('training');
Route::get('/message', function () {
  return view('frontend.message');
})->name('message');
Route::get('/glossary', [GlossaryController::class, 'index'])->name('glossary');
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
  Route::post('/agents/deactivate', [AgentController::class, 'deactivate'])->name('agent.deactivate');
  Route::get('/agents/search', [AgentController::class, 'search'])->name('assign.agent.search');
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
  Route::get('data/import', [ImportCsvController::class, 'getImportFile'])->name('data.import.view');
  Route::post('data/import', [ImportCsvController::class, 'agentImportCsv'])->name('data.import');
  //end route for import/export
  //start route for leads
  Route::get('/lead/all', [LeadController::class, 'index'])->name('all.lead');
  Route::get('create/lead', [LeadController::class, 'create'])->name('create.lead');
  Route::post('store/lead', [LeadController::class, 'store'])->name('store.lead');
  Route::get('edit/lead/{id}', [LeadController::class, 'edit'])->name('edit.lead');
  Route::put('update/lead/{id}', [LeadController::class, 'update'])->name('update.lead');
  Route::get('view/lead/{id}', [LeadController::class, 'show'])->name('show.lead');
  Route::delete('/lead/destroy/{id}', [LeadController::class, 'destroy'])->name('lead.destroy');
  Route::post('/lead/bulkAction', [LeadController::class, 'bulkAction'])->name('lead.bulkAction');
  Route::post('/lead/assign', [LeadController::class, 'leadAssign'])->name('lead.assign');
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
  Route::post('/offer/bulkAction/process', [OfferController::class, 'offerBulkAction'])->name('offer.bulkAction.process');
  Route::get('/ajax/load-buyers', [OfferController::class, 'loadMoreBuyers'])->name('buyers.ajax.load');

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
  Route::get('/ajax/load-buyers-showings', [OfferController::class, 'loadMoreBuyers'])->name('showings.buyers.ajax.load');
  //end route for showing
  //Route for send email to buyers
  Route::get('email/buyer/ajax', [EmailBuyerController::class, 'ajax'])->name('buyers.email.ajax');
  Route::get('email/buyer', [EmailBuyerController::class, 'index'])->name('email.buyer');
  Route::post('/email/buyer/send', [EmailBuyerController::class, 'sendEmail'])->name('email.buyer.send');
  //End route for send email to buyers

  //Route for admin reports
  Route::get('reports', [ReportsController::class, 'index'])->name('reports');
  Route::post('/export/reports', [ReportsController::class, 'export'])->name('export.reports');
  //End route for admin reports

  //Route for admin Hotsheets
  Route::get('hotsheets', [HotsheetController::class, 'index'])->name('hotsheets');
  //End route for admin Hotsheets
  //Route for admin send listing to buyer
  Route::get('/ajax/buyers', [SendListingController::class, 'ajax'])->name('buyers.ajax');
  Route::get('share-listing', [SendListingController::class, 'index'])->name('share.listing');
  Route::post('share-listing-with-buyer', [SendListingController::class, 'shareListing'])->name('share.listing.with.buyer');
  //End route for admin send listing to buyer
  //Route for download activity by admin
  Route::get('download-activities', [DownloadActivityController::class, 'index'])->name('download.activities');
  //End route for download activity by admin
  //route for admin message
  Route::get('send-message', [MessageController::class, 'index'])->name('send.message');
  Route::get('chat/users/{role}', [MessageController::class, 'getUsers'])->name('admin.chat.users');
  Route::get('/active-users/{role}', [MessageController::class, 'getActiveUsers'])->name('admin.active.users');


  //end route for message

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
  Route::post('/agent/listing/bulkAction', [AgentListingController::class, 'bulkAction'])->name('listing.bulkAction');

  //Route for send email to buyers
  Route::get('email/buyer', [AgentEmailBuyerController::class, 'index'])->name('email.buyer');
  Route::post('/email/buyer/send', [AgentEmailBuyerController::class, 'sendEmail'])->name('email.buyer.send');
  Route::get('email/buyer/ajax/agent', [AgentEmailBuyerController::class, 'ajax'])->name('email.ajax');
  //End route for send email to buyers
  //Route for admin reports
  Route::get('reports', [AgentReportController::class, 'index'])->name('reports');
  Route::post('/export/reports', [AgentReportController::class, 'export'])->name('export.reports');
  //End route for admin reports
  Route::post('notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllRead');
  //Route for lead 
  Route::get('all/leads', [AgentLeadController::class, 'index'])->name('all.leads');
  Route::get('view/lead/{id}', [AgentLeadController::class, 'show'])->name('show.lead');
  //end route for lead
  Route::get('/all-message-info', [AgentMessageController::class, 'index'])->name('all.message.info');
  Route::post('/send-message', [AgentMessageController::class, 'sendMessage'])->name('send.message');
  Route::get('/get-messages', [AgentMessageController::class, 'getMessages'])->name('get.message');
  Route::get('users/chat/{role}', [AgentMessageController::class, 'ajaxAgent'])->name('chat.users');
  Route::get('/active-users/{role}', [AgentMessageController::class, 'getActiveUsers'])->name('active.users');
  Route::get('/download-hotsheet', [AgentHotsheetController::class, 'index'])->name('download.hotsheet');
  Route::get('/buyer-listing-visit', [AgentListingViewByBuyerController::class, 'index'])->name('buyer.listing.visit');
  Route::get('/buyer-referrals-list', [AgentreferralsController::class, 'index'])->name('buyer.referrals.list');
});

Route::group(['middleware' => 'buyercheck', 'prefix' => 'buyer', 'as' => 'buyer.'], function () {
  Route::get('/dashboard', [BuyerAuthController::class, 'buyerDashboard'])->name('dashboard');
  Route::get('/profile', [BuyerProfileController::class, 'buyerProfile'])->name('profile');
  Route::get('/bus/sub-category/{id}', [BuyerProfileController::class, 'getBusCategory'])->name('bus.sub.category');
  Route::post('update/buyer/info/{id}', [BuyerProfileController::class, 'updateBuyerInfo'])->name('update.info');
  Route::get('/buyer/change/password', [BuyerChangePasswordController::class, 'index'])->name('change.password');
  Route::post('/buyer/change/password', [BuyerChangePasswordController::class, 'buyerChangePassword'])->name('modify.password');
  Route::get('/all-message', [BuyerMessageController::class, 'index'])->name('all.message');
  Route::post('/send-message', [BuyerMessageController::class, 'sendMessage'])->name('send.message');
  Route::get('/get-messages', [BuyerMessageController::class, 'getMessages'])->name('get.message');
  Route::get('users/chat/{role}', [BuyerMessageController::class, 'ajaxBuyer'])->name('chat.users');
  Route::get('/active-users/{role}', [BuyerMessageController::class, 'getActiveUsers'])->name('active.users');
  Route::post('/favourites/add/{listingId}', [FavoriteController::class, 'addFavorite'])->name('favorites.add');
  Route::post('/favourites/remove/{listingId}', [FavoriteController::class, 'removeFavorite'])->name('favorites.remove');
  Route::get('/favourites', [FavoriteController::class, 'showFavorites'])->name('favorite.listings');
  Route::get('/save-search', [SaveSearchController::class, 'index'])->name('save.search');
  Route::get('/create-showing', [BuyerShowingController::class, 'create'])->name('create.showing');
  Route::post('/store-showing', [BuyerShowingController::class, 'store'])->name('store.showing');
  Route::get('/all-showing', [BuyerShowingController::class, 'index'])->name('all.showing');
  Route::delete('/showing-destroy/{id}', [BuyerShowingController::class, 'destroy'])->name('showing.destroy');
  Route::get('edit-showing/{id}', [BuyerShowingController::class, 'editShowing'])->name('edit.showing');
  Route::put('update-showing/{id}', [BuyerShowingController::class, 'updateShowing'])->name('update.showing');
  Route::get('view-showing/{id}', [BuyerShowingController::class, 'show'])->name('show.showing');
  Route::get('/all-offer', [BuyerOfferController::class, 'index'])->name('all.offer');
  Route::get('create-offer', [BuyerOfferController::class, 'create'])->name('create.offer');
  Route::get('/offer', [BuyerOfferController::class, 'showForm'])->name('offer.form');
  Route::post('/offer', [BuyerOfferController::class, 'processForm'])->name('offer.form.process');
  Route::delete('/offer-destroy/{id}', [BuyerOfferController::class, 'destroy'])->name('offer.destroy');
  Route::get('/offer/{id}', [BuyerOfferController::class, 'editForm'])->name('edit.offer.form');
  Route::post('/offer/{id}', [BuyerOfferController::class, 'editProcessForm'])->name('edit.offer.form.process');
  Route::get('view-offer/{id}', [BuyerOfferController::class, 'show'])->name('show.offer');
  Route::get('share-factsheet-notification', [ShareFactSheetNotificationController::class, 'index'])->name('share.factsheet.notification');
});
Route::get('download-buyer-nda-form', [DownloadNDAFormController::class, 'downloadBuyerNda'])->name('download.buyer.nda.form');
Route::get('buyer-nda-form-download/{id}', [DownloadNDAFormController::class, 'downloadBuyerNdaForm'])->name('buyer.nda.form.download');
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
