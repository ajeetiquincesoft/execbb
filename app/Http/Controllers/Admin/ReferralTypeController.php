<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReferralTypeController extends Controller
{
    public function index(Request $request){
        $search_query = $request->input('query');
        $referral_types = DB::table('referral_types');
        if ($search_query) {
            $referral_types = DB::table('referral_types')
                    ->where('RefTypeDescript', 'LIKE', '%' . $search_query . '%');
            }
        $referral_types = $referral_types->orderBy('RefTypeID', 'asc')->paginate(5);
        return view('admin.referral_type.index',compact('referral_types'));
    }
    public function create()
    {
        return view('admin.referral_type.create');
    }
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'referralType' => 'required|string|max:255|unique:referral_types,RefTypeDescript',
        ]);

        // Create the category
       $create =  DB::table('referral_types')->insert([
            'RefTypeDescript' => $request->referralType,
            'created_at' => now(), 
            'updated_at' => now(),
        ]);

        if ($create) {
            return redirect()->route('referral-type')->with('success', 'Referral type create successfully!');
        } else {
            return redirect()->route('referral-type')->with('error', 'There are some error for create category.');
        }
    }
    public function editReferralType($id){
        $referral_type = DB::table('referral_types')->where('RefTypeID', $id)->first();
        if (!$referral_type) {
            return redirect()->route('referral-type')->with('error', 'Referral type not found');
        }
        return view('admin.referral_type.edit',compact('referral_type'));

    }
    public function updateReferralType(Request $request,$id){
        $validated = $request->validate([
            'referralType' => 'required|string|max:255',
        ]);
        $updated = DB::table('referral_types')
        ->where('RefTypeID', $id)
        ->update([
            'RefTypeDescript' => $validated['referralType'],
            'updated_at' => now()
        ]);

        if ($updated) {
            return redirect()->route('referral-type')->with('success', 'Referral type updated successfully!');
        } else {
            return redirect()->route('referral-type')->with('error', 'Referral type not found or no changes made.');
        }
    }
    public function destroy($id)
    {
        // Attempt to delete the category
        $deleted = DB::table('referral_types')->where('RefTypeID', $id)->delete();

        if ($deleted) {
            return redirect()->route('referral-type')->with('success', 'Referral type deleted successfully!');
        } else {
            return redirect()->route('referral-type')->with('error', 'Referral type not found.');
        }
    }
}
