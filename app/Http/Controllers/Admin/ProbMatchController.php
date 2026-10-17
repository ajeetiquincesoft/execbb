<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buyer;
use App\Models\Listing;
use App\Models\ProbMatch;
use Illuminate\Support\Facades\DB;

class ProbMatchController extends Controller
{
    /* public function index(Request $request)
    {
        $search_query = $request->input('query');
        $probMatchs = DB::table('prob_matchs')
            ->join('listings', 'prob_matchs.ListingId', '=', 'listings.ListingId')
            ->join('buyers', 'prob_matchs.BuyerId', '=', 'buyers.BuyerId');

        if ($search_query) {
            $probMatchs = $probMatchs->where(function ($query) use ($search_query) {
                $query->where('listings.CorpName', 'like', '%' . $search_query . '%')
                    ->orWhere('listings.DBA', 'like', '%' . $search_query . '%')
                    ->orWhere('buyers.FName', 'like', '%' . $search_query . '%')
                    ->orWhere('prob_matchs.BusInt', 'like', '%' . $search_query . '%')
                    ->orWhere('prob_matchs.Location', 'like', '%' . $search_query . '%')
                    ->orWhere('prob_matchs.Price', 'like', '%' . $search_query . '%')
                    ->orWhere('prob_matchs.DownPay', 'like', '%' . $search_query . '%')
                    ->orWhere('prob_matchs.Vol', 'like', '%' . $search_query . '%')
                    ->orWhere('prob_matchs.Profit', 'like', '%' . $search_query . '%')
                    ->orWhere('prob_matchs.Overall', 'like', '%' . $search_query . '%')
                    ->orWhere('prob_matchs.DateRank', 'like', '%' . $search_query . '%');
            });
        }

        $probMatchs = $probMatchs->select('prob_matchs.*')
            ->orderBy('prob_matchs.id', 'asc')
            ->paginate(20);
        $listing_name = Listing::selectRaw("ListingID, COALESCE(NULLIF(TRIM(CorpName), ''), DBA) AS name")
            ->pluck('name', 'ListingID');
        $buyer_name = Buyer::pluck('FName', 'BuyerID');
        return view('admin.probmatch.index', compact('listing_name', 'buyer_name', 'probMatchs'));
    } */

    public function index(Request $request)
    {
        $search_query = trim($request->input('query', ''));
        $listingId = $request->input('listing_id');
        $buyerId = $request->input('buyer_id');

        $probMatchs = DB::table('prob_matchs')
            ->join(
                'listings',
                'prob_matchs.ListingId',
                '=',
                'listings.ListingId'
            )
            ->join(
                'buyers',
                'prob_matchs.BuyerId',
                '=',
                'buyers.BuyerId'
            );

        // Filter by selected listing
        if (!empty($listingId)) {
            $probMatchs->where(
                'prob_matchs.ListingId',
                $listingId
            );
        }

        // Filter by selected buyer
        if (!empty($buyerId)) {
            $probMatchs->where(
                'prob_matchs.BuyerId',
                $buyerId
            );
        }

        // Search within the filtered results
        if (!empty($search_query)) {
            $search = '%' . $search_query . '%';

            $probMatchs->where(function ($query) use ($search) {
                $query->where('listings.CorpName', 'LIKE', $search)
                    ->orWhere('listings.DBA', 'LIKE', $search)
                    ->orWhere('buyers.FName', 'LIKE', $search)
                    ->orWhere('buyers.LName', 'LIKE', $search)
                    ->orWhere('prob_matchs.BusInt', 'LIKE', $search)
                    ->orWhere('prob_matchs.Location', 'LIKE', $search)
                    ->orWhere('prob_matchs.Price', 'LIKE', $search)
                    ->orWhere('prob_matchs.DownPay', 'LIKE', $search)
                    ->orWhere('prob_matchs.Vol', 'LIKE', $search)
                    ->orWhere('prob_matchs.Profit', 'LIKE', $search)
                    ->orWhere('prob_matchs.Overall', 'LIKE', $search)
                    ->orWhere('prob_matchs.DateRank', 'LIKE', $search);
            });
        }

        $probMatchs = $probMatchs
            ->select('prob_matchs.*')
            ->orderBy('prob_matchs.id', 'asc')
            ->paginate(20);

        // Preserve filters and search when changing pages
        $probMatchs->appends($request->query());

        $listing_name = Listing::selectRaw(
            "ListingID, COALESCE(NULLIF(TRIM(DBA), ''), CorpName) AS name"
        )->pluck('name', 'ListingID');

        $buyer_name = Buyer::pluck('FName', 'BuyerID');
        return view('admin.probmatch.index', compact(
            'listing_name',
            'buyer_name',
            'probMatchs',
            'listingId',
            'buyerId'
        ));
    }

    public function create()
    {
        $buyers = Buyer::orderBy('created_at', 'desc')->get();
        $listings = Listing::orderBy('created_at', 'desc')->get();
        return view('admin.probmatch.create', compact('buyers', 'listings'));
    }
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'buyer' => 'required',
            'listingName' => 'required',
            'BusInt' => 'required',
        ]);
        $probMatch = new ProbMatch;
        $probMatch->BuyerID = $request->buyer;
        $probMatch->ListingID = $request->listingName;
        $probMatch->BusInt = $request->BusInt;
        $probMatch->Location = $request->location;
        $probMatch->Price = $request->price;
        $probMatch->DownPay = $request->downPay;
        $probMatch->Vol = $request->Vol;
        $probMatch->Profit = $request->profit;
        $probMatch->Overall = $request->overall;
        $probMatch->DateRank = $request->dateRank;
        $probMatch->save();
        return redirect()->route('probmatch')->with('success', 'Prob match create successfully!');
    }
    public function edit($id)
    {
        $probMatch = ProbMatch::find($id);
        if (!$probMatch) {
            return redirect()->route('probmatch')->with('error', 'ProbMatch not found!');
        }
        $buyers = Buyer::orderBy('created_at', 'desc')->get();
        $listings = Listing::orderBy('created_at', 'desc')->get();
        return view('admin.probmatch.edit', compact('buyers', 'listings', 'probMatch'));
    }
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'buyer' => 'required',
            'listingName' => 'required',
            'BusInt' => 'required',
        ]);
        $probMatch = ProbMatch::find($id);
        if (!$probMatch) {
            return redirect()->route('probmatch')->with('error', 'ProbMatch not found!');
        }
        $probMatch->BuyerID = $request->buyer;
        $probMatch->ListingID = $request->listingName;
        $probMatch->BusInt = $request->BusInt;
        $probMatch->Location = $request->location;
        $probMatch->Price = $request->price;
        $probMatch->DownPay = $request->downPay;
        $probMatch->Vol = $request->Vol;
        $probMatch->Profit = $request->profit;
        $probMatch->Overall = $request->overall;
        $probMatch->DateRank = $request->dateRank;
        $probMatch->save();
        return redirect()->route('probmatch')->with('success', 'Prob match update successfully!');
    }
    public function destroy(Request $request, $id)
    {
        $probmatch = ProbMatch::where('id', $id)->first();
        if (!$probmatch) {
            return redirect()->route('probmatch')->with('error', 'Prob match not found!');
        }

        $probmatch->delete();
        return redirect()->route('probmatch')->with('success', 'Prob match delete successfully!');
    }

    /**
     * Display all probability matches for a specific listing in print format.
     */
    public function printByListing($id)
    {
        $listing = Listing::where('ListingID', $id)->first();

        if (!$listing) {
            return back()->with('error', 'Listing not found.');
        }

        $probMatchs = DB::table('prob_matchs')
            ->leftJoin(
                'buyers',
                'prob_matchs.BuyerId',
                '=',
                'buyers.BuyerId'
            )
            ->leftJoin(
                'listings',
                'prob_matchs.ListingId',
                '=',
                'listings.ListingId'
            )
            ->where('prob_matchs.ListingId', $id)
            ->select(
                'prob_matchs.*',
                'buyers.FName as buyer_fname',
                'buyers.LName as buyer_lname',
                'listings.DBA as listing_dba',
                'listings.CorpName as listing_corpname'
            )
            ->orderBy('prob_matchs.id', 'asc')
            ->get(); // All matches, without pagination

        return view(
            'admin.probmatch.print-listing-probmatch',
            compact('probMatchs', 'listing')
        );
    }


    public function printByBuyer($id)
    {
        $buyer = Buyer::where('BuyerID', $id)->first();

        if (!$buyer) {
            return redirect()->back()->with('error', 'Buyer not found.');
        }

        $probMatchs = DB::table('prob_matchs')
            ->join(
                'listings',
                'prob_matchs.ListingId',
                '=',
                'listings.ListingId'
            )
            ->join(
                'buyers',
                'prob_matchs.BuyerId',
                '=',
                'buyers.BuyerId'
            )
            ->where('prob_matchs.BuyerId', $id)
            ->select([
                'prob_matchs.*',
                'buyers.FName as buyer_fname',
                'buyers.LName as buyer_lname',
                'listings.CorpName as listing_corpname',
                'listings.DBA as listing_dba',
            ])
            ->orderBy('prob_matchs.id', 'asc')
            ->get();

        return view('admin.probmatch.print-buyer-probmatch', compact(
            'buyer',
            'probMatchs'
        ));
    }
}
