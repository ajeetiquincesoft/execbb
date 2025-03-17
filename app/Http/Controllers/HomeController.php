<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\Agent;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $states = DB::table('states')->get();
        /* $listings = Listing::where('Active', 1)->where('Status', 'valid')->latest()
                   ->take(5)
                   ->get(); */
                   $listings = Listing::where('listings.Active', 1)
                   ->where('listings.Status', 'valid')
                   ->whereDoesntHave('offers', function ($query) {
                       $query->whereIn('offers.Status', ['Accepted', 'Dead', 'Closed']);
                   })
                   ->orderBy('listings.created_at', 'desc')
                   ->take(5)
                   ->get();

        //dd($listings);
        $agents = Agent::latest()->take(3)->get();
        return view('frontend.home', compact('listings', 'states', 'agents'));
    }
}
