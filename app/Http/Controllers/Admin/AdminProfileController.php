<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AdminProfileController extends Controller
{
    public function showProfile(){
        $user = auth()->user();
        return view('admin.show-profile-admin',compact('user'));
    }
    public function editProfile($id){
        $user = User::find($id);
        return view('admin.edit-profile-admin',compact('user'));

    }
    public function updateProfile(Request $request, $id){
        $validator = Validator::make($request->all(), [ 
            'name' => 'required'
        ]);
        if ($validator->fails()) { 
            return redirect()->back()->withErrors($validator)->withInput();
         }
        $user = User::find($id);
        $user->name = $request->name;
        $user->save();
        return redirect()->back()->with('success_message','Profile updated successfully!');

    }
}
