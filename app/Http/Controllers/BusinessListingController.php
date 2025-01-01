<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\User;

class BusinessListingController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $listings = Listing::query();
        if ($query) {
            $listings = Listing::where('SellerFName', 'LIKE', '%' . $query . '%')
                ->orWhere('SellerLName', 'LIKE', '%' . $query . '%')
                ->orWhere('SellerCorpName', 'LIKE', '%' . $query . '%')
                ->orWhere('SHomeAdd1', 'LIKE', '%' . $query . '%')
                ->orWhere('SCity', 'LIKE', '%' . $query . '%')
                ->orWhere('SHomePh', 'LIKE', '%' . $query . '%')
                ->orWhere('Address1', 'LIKE', '%' . $query . '%')
                ->orWhere('City', 'LIKE', '%' . $query . '%')
                ->orWhere('Phone', 'LIKE', '%' . $query . '%')
                ->orWhere('Email', 'LIKE', '%' . $query . '%');
        }
        $listings = $listings->orderBy('created_at', 'desc')
            ->paginate(6);
        /*   $listings =  Listing::orderBy('created_at', 'desc')->paginate(5); */
        return view('frontend.business-listing', compact('listings'));
    }
    public function viewBusinessListing($id){
        $listing = Listing::where('ListingID', $id)->first();
        $user = User::where('id', $listing->CreatedBy)->first();
        $userName = $user->name;
        $listings = Listing::where('ListingID', '!=', $id)->orderBy('created_at','desc')->limit(4)->get();
        return view('frontend.single-business-listing',compact('listing','listings','userName'));

    }
}
