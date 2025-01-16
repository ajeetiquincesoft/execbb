<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Listing;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $listing_type = $request->input('industry');
        $state = $request->input('state');
        $listings = Listing::query();
        if ($listing_type) {
            $listings = $listings->where(function ($queryBuilder) use ($listing_type) {
                $queryBuilder->where('BusType', 'LIKE', '%' . $listing_type . '%');
            });
        }
        // Apply industry filter if set
        if ($state) {
            $listings = $listings->where('State', $state);
        }
        $listings = $listings->where('Active', 1)->where('Status', 'valid')->orderBy('created_at', 'desc')->paginate(9);
            //dd(count($listings));
           // dd($listings);
        /*   $listings =  Listing::orderBy('created_at', 'desc')->paginate(5); */
        $states = DB::table('states')->get();
        $categoryData = DB::table('categories')->get();
        return view('frontend.listing-search', compact('listings','states','categoryData'));
    }
    public function searchBusinessListing(Request $request)
    {
        $query = $request->input('query');
        $industry = $request->input('industry');
        $state = $request->input('state');
        
        // Start the query
        $listings = Listing::query();
        
        // Apply search query filter
        if ($query) {
            $listings = $listings->where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('City', 'LIKE', '%' . $query . '%');
            });
        }
        
        // Apply industry filter if set
        if ($industry) {
            $listings = $listings->where('BusCategory', $industry);
        }
        
        // Apply state filter if set
        if ($state) {
            $listings = $listings->where('State', $state);
        }
        
        // Order by creation date and paginate the results
        $listings = $listings->where('Active', 1)->where('Status', 'valid')->orderBy('created_at', 'desc')->paginate(9);
        
        /*   $listings =  Listing::orderBy('created_at', 'desc')->paginate(5); */
        $states = DB::table('states')->get();
        $categoryData = DB::table('categories')->get();
        return view('frontend.listing-search', compact('listings','states','categoryData'));
    }
}
