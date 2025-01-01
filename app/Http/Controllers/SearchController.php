<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Listing;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $listing_type = $request->input('industry');
        $state = $request->input('state');
        $listings = Listing::query();
        if ($listing_type || $state) {
            $listings = Listing::where('BusType', 'LIKE', '%' . $listing_type . '%')
            ->orWhere('State', '==', $state);
        }
        $listings = $listings->orderBy('created_at', 'desc')->paginate(9);
            //dd(count($listings));
           // dd($listings);
        /*   $listings =  Listing::orderBy('created_at', 'desc')->paginate(5); */
        return view('frontend.listing-search', compact('listings'));
    }
    public function searchBusinessListing(Request $request)
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
        return view('frontend.listing-search', compact('listings'));
    }
}
