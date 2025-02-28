<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AgentListingViewByBuyer;

class AgentListingViewByBuyerController extends Controller
{
    public function index(Request $request){
        //$buyerVisitLists = AgentListingViewByBuyer::with(['listing', 'buyer', 'agent'])->paginate(10);
        // Get the search term from the request
    $searchTerm = $request->input('query');

    // Start the query for AgentListingViewByBuyer with related models
    $query = AgentListingViewByBuyer::with(['listing', 'buyer', 'agent']);

    if ($searchTerm) {
        $query->where(function ($q) use ($searchTerm) {
            // Search in the 'listing_id'
            $q->orWhere('listing_id', 'like', '%' . $searchTerm . '%')
              // Search in the 'buyer_name' (assuming 'name' is the field in the 'buyers' table)
              ->orWhereHas('buyer', function($q) use ($searchTerm) {
                  $q->where('FName', 'like', '%' . $searchTerm . '%');
              })
              ->orWhereHas('buyer', function($q) use ($searchTerm) {
                $q->where('LName', 'like', '%' . $searchTerm . '%');
            })
              // Search in the 'buyer_email' (assuming 'email' is the field in the 'buyers' table)
              ->orWhereHas('buyer', function($q) use ($searchTerm) {
                  $q->where('Email', 'like', '%' . $searchTerm . '%');
              })
              // Search in the 'listing_name' (assuming 'name' is the field in the 'listings' table)
              ->orWhereHas('listing', function($q) use ($searchTerm) {
                  $q->where('SellerCorpName', 'like', '%' . $searchTerm . '%');
              });
        });
    }

    // Apply pagination to the query
    $buyerVisitLists = $query->paginate(10);
        return view('agent-dashboard.view-listing.index',compact('buyerVisitLists'));
    }
}
