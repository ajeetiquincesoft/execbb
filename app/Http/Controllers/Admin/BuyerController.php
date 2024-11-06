<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buyer;

class BuyerController extends Controller
{
    public function index(Request $request)
    {
        try {
            $buyers = Buyer::orderBy('created_at', 'desc')->paginate(10);

            return view('admin.buyer.index', compact('buyers'));
        } catch (\Exception $e) {
            return redirect()->back()->with('err_message', $e->getMessage());
        }
    }
    public function show($id){
        
        $buyer = Buyer::where('BuyerID', $id)->first();
         // Get the previous post ID
         $previous = Buyer::where('BuyerID', '<', $id)->orderBy('BuyerID', 'desc')->first();
         // Get the next post ID
         $next = Buyer::where('BuyerID', '>', $id)->orderBy('BuyerID', 'asc')->first();
        return view('admin.buyer.show', compact('buyer', 'previous', 'next'));
    }
    public function destroy(Request $request, $id){
        try{
        $buyer = Buyer::find($id);
        $buyer->delete();
        return redirect()->route('list.buyer')
        ->with('success', 'Buyer deleted successfully');
        }
        catch(\Exception $e){
            return redirect()->back()->with('err_message',$e->getMessage());
        }

    }
   
}
