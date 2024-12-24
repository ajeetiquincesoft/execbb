<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Listing;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        $states = DB::table('states')->get();
        $listings = Listing::orderBy('created_at','desc')->get();
        return view('frontend.home',compact('listings','states'));
    }
}
