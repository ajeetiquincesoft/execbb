<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CriteriaRank;
use Illuminate\Support\Facades\DB;

class CriteriaRankController extends Controller
{
    public function index(Request $request){
        $search_query = $request->input('query');
        $criterias = DB::table('criteria_ranks');

        if ($search_query) {
            $criterias = $criterias->where('BusInt', 'like', '%' . $search_query . '%')
                    ->orWhere('Location', 'like', '%' . $search_query . '%')
                    ->orWhere('Price', 'like', '%' . $search_query . '%')
                    ->orWhere('DownPay', 'like', '%' . $search_query . '%')
                    ->orWhere('Vol', 'like', '%' . $search_query . '%')
                    ->orWhere('Profit', 'like', '%' . $search_query . '%');
            
        }

        $criterias = $criterias->orderBy('id', 'asc')->paginate(5);
        return view('admin.criteria_rank.index',compact('criterias'));
    }
    public function create(){
        return view('admin.criteria_rank.create');
    }
    public function store(Request $request){
        // Validate the incoming request data
        $validated = $request->validate([
            'BusInt' => 'required',
        ]);
        $criteria = new CriteriaRank;
        $criteria->BusInt = $request->BusInt;
        $criteria->Location = $request->location;
        $criteria->Price = $request->price;
        $criteria->DownPay = $request->downPay;
        $criteria->Vol = $request->Vol;
        $criteria->Profit = $request->profit;
        $criteria->save();
        return redirect()->route('criteriarank')->with('success', 'Criteria rank create successfully!');

    }
    public function edit($id){
        $criteria = CriteriaRank::find($id);
        if (!$criteria) {
            return redirect()->route('criteriarank')->with('error', 'Criteria not found!');
        }
        return view('admin.criteria_rank.edit',compact('criteria'));

    }
    public function update(Request $request,$id){
        // Validate the incoming request data
        $validated = $request->validate([
            'BusInt' => 'required',
        ]);
        $criteria = CriteriaRank::find($id);
        if (!$criteria) {
            return redirect()->route('criteriarank')->with('error', 'Criteria not found!');
        }
        
        $criteria->BusInt = $request->BusInt;
        $criteria->Location = $request->location;
        $criteria->Price = $request->price;
        $criteria->DownPay = $request->downPay;
        $criteria->Vol = $request->Vol;
        $criteria->Profit = $request->profit;
        $criteria->save();
        return redirect()->route('criteriarank')->with('success', 'Criteria update successfully!');

    }
    public function destroy(Request $request, $id)
    {
            $criteria = CriteriaRank::where('id', $id)->first();
            if (!$criteria) {
                return redirect()->route('criteriarank')->with('error', 'Criteria not found!');
            }

            $criteria->delete();
            return redirect()->route('criteriarank')->with('success', 'Criteria delete successfully!');
    }
}
