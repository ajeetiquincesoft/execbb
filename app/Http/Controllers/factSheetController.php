<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Listing;
use Illuminate\Support\Facades\DB;

class factSheetController extends Controller
{
    public function index($id){
        $listing_id = base64_decode($id);
        $listingData = Listing::where('ListingID',$listing_id)
        ->where('Status','valid')
        ->where('Active',1)
        ->first();
        if (!$listingData) {
            abort(404, 'Factsheet not found');
        }
        $categories = DB::table('categories')->pluck('BusinessCategory', 'CategoryID');
        $subCategories = DB::table('sub_categories')->pluck('SubCategory', 'SubCatID');
        return view('frontend.factsheet.index',compact('listingData','categories','subCategories'));
    }
}
