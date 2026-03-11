<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class factSheetController extends Controller
{
    public function index($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $listing_id = base64_decode($id);
        if (!$listing_id || !is_numeric($listing_id)) {
            abort(404);
        }
        $listingData = Listing::where('ListingID', $listing_id)
            ->where('Status', 'valid')
            ->where('Active', 1)
            ->first();
        if (!$listingData) {
            abort(404, 'Factsheet not found');
        }
        // Role based access
        if ($user->role_name == 'buyer') {
            $buyerDetails = $user->buyer;

            if (!$buyerDetails) {
                abort(403, 'Buyer profile not found.');
            }
            // check if listing shared with this buyer
            $isShared = DB::table('showings')
                ->where('ListingID', $listing_id)
                ->where('BuyerID', $buyerDetails->BuyerID)
                ->exists();

            if (!$isShared) {
                abort(403, 'You are not allowed to view this factsheet.');
            }
        }
        $annualSaleAmount = $listingData->AnnualSales;
        $categories = DB::table('categories')->pluck('BusinessCategory', 'CategoryID');
        $subCategories = DB::table('sub_categories')->pluck('SubCategory', 'SubCatID');
        return view('frontend.factsheet.index', compact('listingData', 'categories', 'subCategories', 'annualSaleAmount'));
    }
}
