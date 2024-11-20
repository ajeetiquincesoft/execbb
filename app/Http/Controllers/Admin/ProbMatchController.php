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
    public function index(Request $request){
        $search_query = $request->input('query');
        $probMatchs = DB::table('prob_matchs')
                        ->join('listings', 'prob_matchs.ListingId', '=', 'listings.ListingId')
                        ->join('buyers', 'prob_matchs.BuyerId', '=', 'buyers.BuyerId');

        if ($search_query) {
            $probMatchs = $probMatchs->where(function ($query) use ($search_query) {
                $query->where('listings.SellerCorpName', 'like', '%' . $search_query . '%')
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
            ->paginate(5);
        $listing_name = Listing::pluck('SellerCorpName', 'ListingID');
        $buyer_name = Buyer::pluck('FName', 'BuyerID');
        return view('admin.probmatch.index',compact('listing_name','buyer_name','probMatchs'));
    }
    public function create(){
        $buyers = Buyer::orderBy('created_at', 'desc')->get();
        $listings = Listing::orderBy('created_at', 'desc')->get();
        return view('admin.probmatch.create',compact('buyers','listings'));
    }
    public function store(Request $request){
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
    public function edit($id){
        $probMatch = ProbMatch::find($id);
        if (!$probMatch) {
            return redirect()->route('probmatch')->with('error', 'ProbMatch not found!');
        }
        $buyers = Buyer::orderBy('created_at', 'desc')->get();
        $listings = Listing::orderBy('created_at', 'desc')->get();
        return view('admin.probmatch.edit',compact('buyers','listings','probMatch'));

    }
    public function update(Request $request,$id){
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
}
