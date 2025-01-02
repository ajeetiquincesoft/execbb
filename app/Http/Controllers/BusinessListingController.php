<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class BusinessListingController extends Controller
{
    public function index(Request $request)
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
        $listings = $listings->orderBy('created_at', 'desc')->paginate(6);
        
        /*   $listings =  Listing::orderBy('created_at', 'desc')->paginate(5); */
        $states = DB::table('states')->get();
        $categoryData = DB::table('categories')->get();
        return view('frontend.business-listing', compact('listings','states','categoryData'));
    }
    public function viewBusinessListing($id){
        $listing = Listing::with('comments')->where('ListingID', $id)->first();
        if($listing){
            $user = User::where('id', $listing->CreatedBy)->first();
        $userName = $user->name;
        $comments = $listing->comments;
        $listings = Listing::where('ListingID', '!=', $id)->orderBy('created_at','desc')->limit(4)->get();
        return view('frontend.single-business-listing', compact('listing','listings','userName','comments'));

        }
        else{

            return redirect()->route('business.listings')->with('error', 'Listing not found.');
        }

    }
}
