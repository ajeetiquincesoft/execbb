<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BuyerComment;
use App\Models\Buyer;
use Illuminate\Support\Facades\Auth;

class BuyerCommentController extends Controller
{
    public function buyerComment(request $request, $id){
        $buyer = Buyer::where('user_id', Auth::id())->first();
        $comment = new BuyerComment();
        $comment->Name = $request->input('user_name');
        $comment->Email = $request->input('user_email');
        $comment->Comment = $request->input('user_comment');
        $comment->CommentDate = now();
        $comment->BuyerID = $buyer->BuyerID;
        $comment->ListingID = $id;
        $comment->save();
        return redirect()->route('view.business.listing', $id);

    }
    
}
