<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Listing;
use App\Models\User;

class AgentListingController extends Controller
{
    public function index(Request $request){
        $user = auth()->user();
        $query = $request->input('query');
        $listings = Listing::where('RefAgentID', $user->id);

        if ($query) {
            $listings = $listings->where(function($queryBuilder) use ($query) {
                $queryBuilder->where('SellerFName', 'LIKE', '%' . $query . '%')
                    ->orWhere('SellerLName', 'LIKE', '%' . $query . '%')
                    ->orWhere('SellerCorpName', 'LIKE', '%' . $query . '%')
                    ->orWhere('SHomeAdd1', 'LIKE', '%' . $query . '%')
                    ->orWhere('SCity', 'LIKE', '%' . $query . '%')
                    ->orWhere('SHomePh', 'LIKE', '%' . $query . '%')
                    ->orWhere('Email', 'LIKE', '%' . $query . '%')
                    ->orWhere('Status', 'LIKE', '%' . $query . '%');
            });
        }
        $listings = $listings->orderBy('created_at', 'desc')->paginate(10);
      /*   $listings =  Listing::orderBy('created_at', 'desc')->paginate(5); */
        return view('agent-dashboard.listing.index', compact('listings'));
    }
    public function show($id){
        $user = auth()->user();
        $listing = Listing::where('ListingID', $id)->where('RefAgentID', $user->id)->first();
        return view('agent-dashboard.listing.show', compact('listing'));
    }
}
