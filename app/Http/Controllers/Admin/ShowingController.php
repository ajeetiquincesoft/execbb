<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Showing;
use App\Models\Agent;
use App\Models\Buyer;
use App\Models\Listing;
use Illuminate\Support\Facades\DB;
class ShowingController extends Controller
{
    public function index(Request $request){
       /*  $showings = Showing::orderBy('ShowingID','desc')->paginate(5); */
        $search_query = $request->input('query');
        $showings = DB::table('showings');
        $dbaName = Listing::pluck('SellerCorpName', 'ListingID');
        $buyerName = Buyer::pluck('FName', 'BuyerID');
        if ($search_query) {
            $showings = DB::table('showings')
            ->leftJoin('listings', 'showings.ListingID', '=', 'listings.ListingID')
            ->leftJoin('buyers', 'showings.BuyerID', '=', 'buyers.BuyerID')
            ->select('showings.*')
            ->where(function($query) use ($search_query) {
                $query->where('showings.ShowingID', 'LIKE', '%' . $search_query . '%')
                    ->orWhere('showings.AgentID', 'LIKE', '%' . $search_query . '%')
                    ->orWhere('showings.Date', 'LIKE', '%' . $search_query . '%')
                    ->orWhere('showings.OfferMade', 'LIKE', '%' . $search_query . '%')
                    ->orWhere('showings.FollowUp', 'LIKE', '%' . $search_query . '%')
                    ->orWhere('listings.SellerCorpName', 'LIKE', '%' . $search_query . '%')
                    ->orWhere('buyers.FName', 'LIKE', '%' . $search_query . '%');
            });
        }
        
        $showings = $showings->orderBy('created_at', 'desc')->paginate(5);
        
         return view('admin.showing.index', compact('showings','dbaName','buyerName'));
    }
    public function create(){
        $agents = Agent::orderBy('AgentTableID','desc')->get();
        $buyers = Buyer::orderBy('BuyerID','desc')->get();
        $listings = Listing::orderBy('ListingID','desc')->get();
       return view('admin.showing.create',compact('agents','buyers','listings'));  
    }
    public function store(Request $request){
     // dd($request->all());
        $request->validate([
            'showingDate.0' => 'required',
            'listing.0' => 'required',
            'follow_up.0' => 'required|string|max:255',
        ], [
            'showingDate.0.required' => 'Date field is required.',
            'listing.0.required' => 'DBA field is required.',
            'follow_up.0.required' => 'follow-up field is required.',
            'follow_up.0.string' => 'follow-up field must be a string.',
            'follow_up.0.max' => 'follow-up field must not exceed 255 characters.',
        ]);
        foreach ($request->showingDate as $key => $showingDate) {
            if(!empty($showingDate)){
                $showing = new Showing;
                $showing->AgentID =$request->agent_id;
                $showing->Date  = $showingDate;
                $showing->BuyerID = $request->buyer_id;
                $showing->ListingID = $request->listing[$key];
                $showing->OfferMade = isset($request->offer_made[$key]) ? 1 : 0;
                $showing->FollowUp = $request->follow_up[$key];
                $showing->save();
            }
            
        }
     
        return redirect()->route('all.showing')->with('success', 'Your showing create successful!');

    }
    public function editShowing(Request $request,$id){
        $showing = Showing::where('ShowingID',$id)->first();
        if (!$showing) {
            return redirect()->route('all.referral')
                ->with('err_message', 'Referral not found.');
        }
        $agents = Agent::orderBy('AgentTableID','desc')->get();
        $buyers = Buyer::orderBy('BuyerID','desc')->get();
        $listings = Listing::orderBy('ListingID','desc')->get();
         // Get the previous showing ID
         $previous = Showing::where('ShowingID', '<', $id)->orderBy('ShowingID', 'desc')->first();
         // Get the next showing ID
         $next = Showing::where('ShowingID', '>', $id)->orderBy('ShowingID', 'asc')->first();
       return view('admin.showing.edit',compact('showing','agents','buyers','listings','previous','next'));
    }
    public function updateShowing(Request $request,$id){
        $request->validate([
            'follow_up' => 'required',
            'agent_id' => 'required',
            'buyer_id' => 'required',
            'listing' => 'required',
            'showingDate' => 'required',
        ]);
        $showing = Showing::where('ShowingID',$id)->first();
        $showing->AgentID = $request->agent_id;
        $showing->Date  = $request->showingDate;
        $showing->BuyerID = $request->buyer_id;
        $showing->ListingID = $request->listing;
        $showing->OfferMade =  isset($request->offer_made) ? 1 : 0;
        $showing->FollowUp = $request->follow_up;
        $showing->save();
        return redirect()->route('all.showing')->with('success', 'Your showing update successful!');

    }
    public function show($id)
    {
        $showing = Showing::where('ShowingID',$id)->first();
        if (!$showing) {
            return back()->with('error', 'Showing not found!');
        }
        // Get the previous showing ID
        $previous = Showing::where('ShowingID', '<', $id)->orderBy('ShowingID', 'desc')->first();
        // Get the next showing ID
        $next = Showing::where('ShowingID', '>', $id)->orderBy('ShowingID', 'asc')->first();
        $dbaName = Listing::pluck('SellerCorpName', 'ListingID');
        $buyerName = Buyer::pluck('FName', 'BuyerID');
       return view('admin.showing.show', compact('showing', 'previous', 'next','dbaName','buyerName'));

    }
    public function destroy(Request $request, $id)
    {
       
            // Find the contact ID
            $referral = Showing::where('ShowingID',$id)->first();
            // Check if the contact exists
            if (!$referral) {
                return redirect()->route('all.showing')
                    ->with('err_message', 'Showing not found.');
            }

            // Delete the contact
            Showing::where('ShowingID', $id)->delete();

            return redirect()->route('all.showing')
                ->with('success', 'Showing deleted successfully.');
      
    }
}
