
<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Agent\AgentAuthController;
use App\Http\Controllers\Agent\AgentBuyerController;

Route::group(['middleware' => 'agentcheck','prefix' => 'agent'], function () {
    Route::get('/dashboard', [AgentAuthController::class, 'agentDashboard']);
       //routes for buyers
   Route::get('buyer/list', [AgentBuyerController::class, 'index'])->name('agent.list.buyer');
   Route::get('view/buyer/{id}',[AgentBuyerController::class,'show'])->name('agent.show.buyer');
   Route::delete('/buyer/{id}',[AgentBuyerController::class,'destroy'])->name('agent.buyer.destroy');
     //end route for buyers
  
});