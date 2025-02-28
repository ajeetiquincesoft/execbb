<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Offer;
use Illuminate\Support\Facades\DB;

class HotsheetController extends Controller
{
    public function index()
    {
        $offers = DB::table('offers')
            ->join('listings', 'offers.ListingID', '=', 'listings.ListingID')
            ->join('buyers', 'offers.BuyerID', '=', 'buyers.BuyerID')
            ->join('agents', 'offers.ListingAgent', '=', 'agents.AgentID')
            ->whereIn('offers.Status', ['Pending', 'Accepted'])  // Fetching both statuses
            ->select('offers.*', 'listings.SellerCorpName as SellerCorpName', 'buyers.FName as BuyerFName', 'buyers.LName as BuyerLName', 'agents.AgentUserRegisterId as AgentUserRegisterId')
            ->get();
        dd($offers);
        return view('admin.hotsheet.index', compact('offers'));
    }
}
