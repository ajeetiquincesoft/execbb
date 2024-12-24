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
        $listings = $listings->orderBy('created_at', 'desc')->paginate(3);
            //dd(count($listings));
           // dd($listings);
        /*   $listings =  Listing::orderBy('created_at', 'desc')->paginate(5); */
        return view('frontend.listing-search', compact('listings'));
    }
}
