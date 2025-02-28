<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buyer;
use App\Models\Agent;
use Illuminate\Support\Facades\Auth;

class AgentBuyerController extends Controller
{
    public function index(Request $request)
    {
        try {
            $agent = Agent::where('AgentUserRegisterId', Auth::id())->first();
            $query = $request->input('query');
            $words = explode(' ', $query);
            $buyers = Buyer::query();
            if ($query) {
                foreach ($words as $word) {
                    $buyers = $buyers->where(function ($query) use ($word) {
                        $query->orWhere('BuyerID', 'LIKE', '%' . $word . '%')
                            ->orWhere('FName', 'LIKE', '%' . $word . '%')
                            ->orWhere('LName', 'LIKE', '%' . $word . '%')
                            ->orWhere('Address1', 'LIKE', '%' . $word . '%')
                            ->orWhere('HomePhone', 'LIKE', '%' . $word . '%')
                            ->orWhere('BusPhone', 'LIKE', '%' . $word . '%')
                            ->orWhere('Email', 'LIKE', '%' . $word . '%');
                    });
                }
            }

            $buyers = $buyers->where('AgentID', $agent->AgentID)->whereNotNull('user_id')->orderBy('created_at', 'desc')->paginate(10);
            //dd($buyers);
            return view('agent-dashboard.buyer.index', compact('buyers'));
        } catch (\Exception $e) {
            return redirect()->back()->with('err_message', $e->getMessage());
        }
    }
    public function show($id)
    {

        $buyer = Buyer::where('BuyerID', $id)->first();
        // Get the previous buyer ID
        $previous = Buyer::where('BuyerID', '<', $id)->orderBy('BuyerID', 'desc')->first();
        // Get the next buyer ID
        $next = Buyer::where('BuyerID', '>', $id)->orderBy('BuyerID', 'asc')->first();
        return view('agent-dashboard.buyer.show', compact('buyer', 'previous', 'next'));
    }
    public function destroy(Request $request, $id)
    {
        try {
            $buyer = Buyer::find($id);
            $buyer->delete();
            return redirect()->route('list.buyer')
                ->with('success', 'Buyer deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('err_message', $e->getMessage());
        }
    }
}
