<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Agent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AgentProfileController extends Controller
{
    public function showProfile(){
        $user = auth()->user();
        return view('agent-dashboard.show-profile-agent',compact('user'));
    }
    public function editProfile($id){
        $agent = User::with('agent_info')->find($id);
        $states = DB::table('states')->get();
        return view('agent-dashboard.edit-profile-agent',compact('agent','states'));

    }
    public function updateProfile(Request $request, $id){
        $validator = Validator::make($request->all(), [ 
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'home_phone' => 'required'
        ]);
        if ($validator->fails()) { 
            return redirect()->back()->withErrors($validator)->withInput();
            }
        if( $request->hasFile('agent_image')) {
            $image = $request->file('agent_image');
            $path = public_path(). '/assets/uploads/images/';
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move($path, $filename);
        }
        else{
            $data =Agent::where('AgentUserRegisterId',$id)->first();
            $filename = $data->image;

        }
        $spouse = $request->has('spouse') ? 1 : 0;
        $display_on_web = $request->has('display_on_web') ? 1 : 0;
        $agent = Agent::where('AgentUserRegisterId',$id)->update([
        'LName' => $request->last_name,
        'FName' => $request->first_name,
        'Address1' => $request->address,
        'City' => $request->city,
        'State' =>$request->state,
        'Zip' => $request->zip_code,
        'DOB' => $request->dob,
        'Telephone' => $request->home_phone,
        'Fax' => $request->fax,
        'Comments' =>$request->comment,
        'Spouse' => $spouse,
        'SpFName' => $request->spouse_first_name,
        'SpLName' => $request->spouse_last_name,
        'SocSecNum' => $request->ss_number,
        'CellPhone' => $request->cellular,
        'Pager' => $request->pager,
        'HireDate' => $request->hire_date,
        'Termination' => $request->terminate_date,
        'Display' => $display_on_web,
        'image' => $filename,

    ]);
    if($agent){
        return redirect()->back()->with('success', 'Your profile update successfully.');
    }
    else{
        return redirect()->back()->with('error', 'There are some error! can not be update.');
    }

    }
    public function updateImage(Request $request, $id){
        if( $request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $path = public_path(). '/assets/uploads/images/';
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move($path, $filename);
        }
        else{
            $data =Agent::where('AgentUserRegisterId',$id)->first();
            $filename = $data->image;

        }
        $agent = Agent::where('AgentUserRegisterId',$id)->update([
            'image' => $filename,
        ]);
        if($agent){
            return redirect()->back()->with('success_message', 'Agent profile image update successfully');
        }
        else{
            return redirect()->back()->with('success_message', 'There are some error! can not be update.');
        }
    }
}
