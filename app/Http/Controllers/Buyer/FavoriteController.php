<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Listing;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
     // Add a listing to favorites
     public function addFavorite($listingId)
     {
         $listing = Listing::findOrFail($listingId);
         $buyerId = Auth::id();
 
         // Check if already favorited
         if (Favorite::where('listing_id', $listing->ListingID)->where('buyer_id', $buyerId)->exists()) {
             return back()->with('message', 'This listing is already in your favorites.');
         }
 
         // Add to favorites
         Favorite::create([
            'listing_id' => $listing->ListingID,
            'buyer_id' => $buyerId,
        ]);
 
         return back()->with('message', 'Listing added to your favorites!');
     }
 
     // Remove a listing from favorites
     public function removeFavorite($listingId)
     {
         $listing = Listing::findOrFail($listingId);
         $buyerId = Auth::id();
 
         // Check if the listing is in the buyer's favorites
         $favorite = Favorite::where('listing_id', $listing->ListingID)->first();
 
         if ($favorite) {
             $favorite->delete();
             return back()->with('message', 'Listing removed from your favorites.');
         }
 
         return back()->with('message', 'This listing is not in your favorites.');
     }
 
     // View all favorites for the buyer
     public function showFavorites()
     {
         $buyer = Auth::user();
         $buyerId = Auth::id();
         $favorites = Favorite::with('favoriteListing')->where('buyer_id',$buyerId)->paginate(10);
         return view('frontend.buyer.favorite_listings', compact('favorites'));
     }
}
