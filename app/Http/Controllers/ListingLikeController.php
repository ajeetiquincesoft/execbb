<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buyer;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;

class ListingLikeController extends Controller
{
    public function listingLike(request $request){
        $buyer = Buyer::where('user_id', Auth::id())->first();
        $like = Like::where('BuyerID', $buyer->BuyerID)
        ->where('ListingID', $request->listing_id)
        ->first();
        if ($like) {
            $like->liked = $like->liked == 1 ? 0 : 1;
            $like->save();
        }else{
            $like = new Like();
            $like->BuyerID = $buyer->BuyerID;
            $like->ListingID  = $request->listing_id;
            $like->liked  = $request->liked;
            $like->save();
        }
        $likeCount = Like::where('ListingID', $request->listing_id)->where('liked', 1)->count();
        return response()->json([
            'success' => true,
            'message' => 'Update successfully!',
            'liked' => $like->liked,
            'like_count'=> $likeCount
        ]);
    }
}
