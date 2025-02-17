<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SavedSearch;
use Illuminate\Support\Facades\Auth;

class SaveSearchController extends Controller
{
    public function index(){
        $saveSearch = SavedSearch::where('user_id', Auth::id())->orderBy('created_at', 'desc')->paginate(10);
        return view('frontend.buyer.save_search', compact('saveSearch'));

    }
}
