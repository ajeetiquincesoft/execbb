<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\User;
use App\Models\Like;
use App\Models\Buyer;
use App\Models\BuyerComment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BusinessListingController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $industry = $request->input('industry');
        $state = $request->input('state');
        
        // Start the query
        $listings = Listing::query();
        
        // Apply search query filter
        if ($query) {
            $listings = $listings->where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('City', 'LIKE', '%' . $query . '%');
            });
        }
        
        // Apply industry filter if set
        if ($industry) {
            $listings = $listings->where('BusCategory', $industry);
        }
        
        // Apply state filter if set
        if ($state) {
            $listings = $listings->where('State', $state);
        }
        
        // Order by creation date and paginate the results
        $listings = $listings->where('Active', 1)->where('Status', 'valid')->orderBy('created_at', 'desc')->paginate(6);
        
        /*   $listings =  Listing::orderBy('created_at', 'desc')->paginate(5); */
        $states = DB::table('states')->get();
        $categoryData = DB::table('categories')->get();
        return view('frontend.business-listing', compact('listings','states','categoryData'));
    }
    public function viewBusinessListing($id){
        $buyer = Buyer::where('user_id', Auth::id())->first();
        $buyer_id = 0;
        if($buyer){
            $buyer_id = $buyer->BuyerID;
        }
        $listing = Listing::with('comments')->where('ListingID', $id)->first();
        if($listing){
            $user = User::where('id', $listing->CreatedBy)->first();
            $subCatName = DB::table('sub_categories')->where('SubCatID', $listing->SubCat)->value('SubCategory');
        $userName = $user->name;
        $comments = $listing->comments;
        $listings = Listing::where('ListingID', '!=', $id)->orderBy('created_at','desc')->limit(4)->get();
        $likeVal = 1;
        $activeClass = '';
        $likeStatus = Like::where('ListingID', $id)->where('BuyerID', $buyer_id)->first();
        if($likeStatus){
            $likeVal = $likeStatus->liked;
            $activeClass = $likeStatus->liked == 1 ? 'active' : '';
        }
        $likeCount = Like::where('ListingID', $id)->where('liked', 1)->count();
        $buyerComments = BuyerComment::where('ListingID', $id)->orderBy('created_at', 'desc')->paginate(5);
        $buyerCommentsCount = BuyerComment::where('ListingID', $id)->orderBy('created_at', 'desc')->count();
        return view('frontend.single-business-listing', compact('listing','listings','userName','comments','subCatName','likeVal','activeClass','likeCount','buyerComments','buyerCommentsCount'));

        }
        else{

            return redirect()->route('business.listings')->with('error', 'Listing not found.');
        }

    }
    public function loadMoreComments(Request $request)
    {
        if ($request->ajax()) {
            $listing_id = $request->listing_id;
            $page = $request->page;

            // Load comments for this post, starting from the given page
            $comments = BuyerComment::where('ListingID', $listing_id)
                ->orderBy('created_at', 'desc')
                ->paginate(5, ['*'], 'page', $page);
                $comments->getCollection()->transform(function ($comment) {
                    // Format the CommentDate field with Carbon
                    $comment->formatted_date = Carbon::parse($comment->CommentDate)->format('F d, Y');
                    return $comment;
                });
            // Return the comments as JSON
            return response()->json([
                'comments' => $comments->items(),
                'next_page_url' => $comments->nextPageUrl(),
            ]);
        }
    }
}
