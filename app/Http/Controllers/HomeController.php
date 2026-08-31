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
        /* $subCategories = DB::table('sub_categories')
            ->whereNotNull('CatID')
            ->limit(15)
            ->get(); */
        $subCategories = DB::table('sub_categories')
            ->whereNotNull('CatID')
            ->whereNotIn('SubCategory', [
                'Auto Repairs/Car Wash',
                'Liquor Store',
                'Bagel',
                'Restaurant',
                'Fast Food'
            ])
            ->limit(15)
            ->get();
        /* $hotSubCategories = DB::table('sub_categories')
            ->whereIn('SubCategory', [
                'Auto Repairs/Car Wash',
                'Liquor Store',
                'Bagel',
                'Restaurant',
                'Fast Food'
            ])
            ->orderBy('SubCategory')
            ->get(); */
        // Business categories displayed in Top Business Categories
        $topBusinessCategories = [
            'Manufacturing / Distribution',
            'Cannabis',
            'Laundromats',
            'SBA Financeable',
            'Liquor Licenses C & D',
            'Merger & Acquisitions',
            'Service Businesses',
            'Day Care',
            'Franchises',
            'Dry Cleaners',
            'Health Care',
            'Pizza',
            'Commercial Real Estate',
            'Business & Real Estate',
            'Gas Stations'
        ];

        $hotSubCategories = DB::table('sub_categories')
            ->whereIn('SubCategory', $topBusinessCategories)
            ->orderByRaw("
            CASE 
                WHEN SubCategory = 'Manufacturing / Distribution' THEN 1
                WHEN SubCategory = 'Cannabis' THEN 2
                WHEN SubCategory = 'Laundromats' THEN 3
                WHEN SubCategory = 'SBA Financeable' THEN 4
                WHEN SubCategory = 'Liquor Licenses C & D' THEN 5
                WHEN SubCategory = 'Merger & Acquisitions' THEN 6
                WHEN SubCategory = 'Service Businesses' THEN 7
                WHEN SubCategory = 'Day Care' THEN 8
                WHEN SubCategory = 'Franchises' THEN 9
                WHEN SubCategory = 'Dry Cleaners' THEN 10
                WHEN SubCategory = 'Health Care' THEN 11
                WHEN SubCategory = 'Pizza' THEN 12
                WHEN SubCategory = 'Commercial Real Estate' THEN 13
                WHEN SubCategory = 'Business & Real Estate' THEN 14
                WHEN SubCategory = 'Gas Stations' THEN 15
                ELSE 16
            END
        ")
            ->get();
        $businessTypes = DB::table('sub_categories')
            /* ->whereNotNull('CatID') */
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
        return view('frontend.home', compact('listings', 'states', 'agents', 'categories', 'subCategories', 'businessTypes', 'hotSubCategories'));
    }
    public function getBusinessCategory($id)
    {
        // Fetch options based on the selected ID (e.g., from a database)
        $options = DB::table('sub_categories')->where('CatID', $id)->orderBy('SubCategory', 'asc')->get();

        return response()->json($options);
    }
}
