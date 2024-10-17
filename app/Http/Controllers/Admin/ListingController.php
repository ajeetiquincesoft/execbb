<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index(){
        return view('admin.listing.index');
    }
    public function create(){
        return view('admin.listing.create');
    }
}
