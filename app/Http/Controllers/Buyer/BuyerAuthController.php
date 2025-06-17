<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;
use App\Models\SavedSearch;
use App\Models\SignNda;

class BuyerAuthController extends Controller
{
    public function buyerDashboard()
    {

        if (Auth::check()) {
            /* return view('buyer-dashboard.dashboard'); */
            $buyerId = Auth::id();
            $favourites = Favorite::where('buyer_id', $buyerId)->count();
            $saveSearch = SavedSearch::where('user_id', $buyerId)->count();
            $hasSignedNda = SignNda::where('user_id', $buyerId)->exists();

            return view('frontend.buyer.buyer_dashboard', compact('favourites', 'saveSearch', 'hasSignedNda'));
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }
}
