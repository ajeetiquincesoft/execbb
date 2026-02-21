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
        $states = DB::table('states')->orderByRaw("
        CASE 
            WHEN State = 'nj' THEN 1
            WHEN State = 'ny' THEN 2
            WHEN State = 'ct' THEN 3
            ELSE 4
        END
    ")->get();
        $categories = DB::table('categories')->get();
        $subCategories = DB::table('sub_categories')
            ->whereNotNull('CatID')
            ->limit(15)
            ->get();
        $businessTypes = DB::table('sub_categories')
            ->whereNotNull('CatID')
            ->orderBy('SubCategory', 'asc')
            ->get();
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
        $agents = Agent::where('Active', 1)->latest()->take(3)->get();
        return view('frontend.home', compact('listings', 'states', 'agents', 'categories', 'subCategories', 'businessTypes'));
    }
    public function getBusinessCategory($id)
    {
        // Fetch options based on the selected ID (e.g., from a database)
        $options = DB::table('sub_categories')->where('CatID', $id)->orderBy('SubCategory', 'asc')->get();

        return response()->json($options);
    }
}
