<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Showing;
use App\Models\Agent;
use App\Models\Buyer;
use App\Models\Listing;
use Illuminate\Support\Facades\DB;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AgentShowingController extends Controller
{
    public function index(Request $request)
    {
        /*  $showings = Showing::orderBy('ShowingID','desc')->paginate(5); */
        $user = auth()->user();
        $AgentID = DB::table('agents')
            ->where('AgentUserRegisterId', $user->id)
            ->value('AgentID');
        $search_query = $request->input('query');
        $showings = DB::table('showings');
        $dbaName = Listing::pluck('DBA', 'ListingID');
        $buyerName = Buyer::pluck('FName', 'BuyerID');
        if ($search_query) {
            $showings = DB::table('showings')
                ->leftJoin('listings', 'showings.ListingID', '=', 'listings.ListingID')
                ->leftJoin('buyers', 'showings.BuyerID', '=', 'buyers.BuyerID')
                ->select('showings.*')
                ->where(function ($query) use ($search_query) {
                    $query->where('showings.ShowingID', 'LIKE', '%' . $search_query . '%')
                        ->orWhere('showings.AgentID', 'LIKE', '%' . $search_query . '%')
                        ->orWhere('showings.Date', 'LIKE', '%' . $search_query . '%')
                        ->orWhere('showings.OfferMade', 'LIKE', '%' . $search_query . '%')
                        ->orWhere('showings.FollowUp', 'LIKE', '%' . $search_query . '%')
                        ->orWhere('listings.SellerCorpName', 'LIKE', '%' . $search_query . '%')
                        ->orWhere('buyers.FName', 'LIKE', '%' . $search_query . '%');
                });
        }
        /* $showings = $showings->where('showings.AgentID', $AgentID)->orderBy('created_at', 'desc')->paginate(10); */
        $showings = $showings->orderBy('created_at', 'desc')->paginate(10);

        return view('agent-dashboard.showing.index', compact('showings', 'dbaName', 'buyerName'));
    }
    public function show($id)
    {
        $showing = Showing::where('ShowingID', $id)->first();
        if (!$showing) {
            return back()->with('error', 'Showing not found!');
        }
        $activities = Activity::latest()->paginate(10);
        // Get the previous showing ID
        $previous = Showing::where('ShowingID', '<', $id)->orderBy('ShowingID', 'desc')->first();
        // Get the next showing ID
        $next = Showing::where('ShowingID', '>', $id)->orderBy('ShowingID', 'asc')->first();
        $dbaName = Listing::pluck('DBA', 'ListingID');
        $buyerName = Buyer::pluck('FName', 'BuyerID');
        return view('agent-dashboard.showing.show', compact('showing', 'previous', 'next', 'dbaName', 'buyerName', 'activities'));
    }
}
