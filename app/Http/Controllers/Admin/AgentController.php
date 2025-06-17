<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Agent;
use App\Models\Offer;
use App\Models\Buyer;
use App\Models\Showing;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Throwable;
use Illuminate\Database\QueryException;
use App\Events\AgentRegister;
use App\Mail\AgentWelcome;
use Illuminate\Support\Facades\Mail;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use App\Models\Activity;
use App\Models\Listing;


class AgentController extends Controller
{
    public function index(Request $request)
    {
        try {
            /*  $agents = User::with('agent_info')->where('role_name','agent')->orderBy('created_at', 'desc')->paginate(2); */
            $query = $request->input('query');
            $agents = Agent::query();
            if ($query) {
                $agents = Agent::where('AgentID', 'LIKE', '%' . $query . '%')
                    ->orWhere('FName', 'LIKE', '%' . $query . '%')
                    ->orWhere('LName', 'LIKE', '%' . $query . '%')
                    ->orWhere('Address1', 'LIKE', '%' . $query . '%')
                    ->orWhere('Telephone', 'LIKE', '%' . $query . '%')
                    ->orWhere('Email', 'LIKE', '%' . $query . '%');
            }
            $agents = $agents->orderBy('created_at', 'desc')
                ->paginate(10);
            return view('admin.agent.index', compact('agents'));
        } catch (\Exception $e) {
            return redirect()->back()->with('err_message', $e->getMessage());
        }
    }
    public function create()
    {
        try {
            // event(new AgentRegister('santosh3257@gmail.com'));
            $states = DB::table('states')->get();
            return view('admin.agent.create', compact('states'));
        } catch (\Exception $e) {
            return redirect()->back()->with('err_message', $e->getMessage());
        }
    }
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'first_name' => 'required',
                'last_name' => 'required',
                'address' => 'required',
                'home_phone' => 'required',
                'email' => 'required|email|unique:users',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = $request->all();
            DB::beginTransaction();
            $check = $this->agentRegistration($data);
            //dd($check->id);
            $spouse = $request->has('spouse') ? 1 : 0;
            $display_on_web = $request->has('yearsEstablished') ? 1 : 0;
            $agent = new Agent;
            $agent->AgentID = strtoupper($request->agent_id);
            $agent->LName = $request->last_name;
            $agent->FName = $request->first_name;
            $agent->Address1 = $request->address;
            $agent->City = $request->city;
            $agent->State = $request->state;
            $agent->Zip = $request->zip_code;
            $agent->DOB = $request->dob;
            $agent->Telephone = $request->home_phone;
            $agent->Fax = $request->fax;
            $agent->Email = $request->email;
            $agent->Comments = $request->comment;
            $agent->Spouse = $spouse;
            $agent->SpFName = $request->spouse_first_name;
            $agent->SpLName = $request->spouse_last_name;
            $agent->SocSecNum = $request->ss_number;
            $agent->CellPhone = $request->cellular;
            $agent->Pager = $request->pager;
            $agent->HireDate = $request->hire_date;
            $agent->Termination = $request->terminate_date;
            $agent->Display = $display_on_web;
            $agent->AgentUserRegisterId =  $check->id;
            if ($request->hasFile('agent_image')) {
                $image = $request->file('agent_image');
                $path = public_path() . '/assets/uploads/images/';
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $image->move($path, $filename);

                $agent->image = $filename;
            }
            $agent->save();
            // call the event
            //Mail::to('santosh3257@gmail.com')->send(new AgentWelcome());
            event(new AgentRegister($request->all()));
            DB::commit();
            Activity::create([
                'action' => 'Agent registered',
                'user_id' => $check->id,
                'details' => 'registered agent with email: ' . $request->email,
            ]);
            return redirect('admin/agent/list')->with('success', 'Agent register successfully');
        } catch (QueryException $e) {
            DB::rollBack();

            // Handle duplicate entry error specifically
            if (isset($e->errorInfo[1]) && $e->errorInfo[1] == 1062) {
                return redirect()->back()->with('duplicate_error', 'Agent ID can not be duplicate.')->withInput();
            }

            // Handle other database errors
            return response()->json(['error' => 'Failed to create agent.'], 500);
        } catch (Throwable $e) {
            DB::rollBack();

            // Handle unexpected errors
            return response()->json(['error' => 'An unexpected error occurred.'], 500);
        }
    }
    public function agentRegistration(array $data)
    {
        $password = $data['first_name'] . '@123';
        return User::create([
            'name' => $data['first_name'],
            'email' => $data['email'],
            'role_name' => 'agent',
            'password' => Hash::make($password)
        ]);
    }
    public function edit($id)
    {
        try {
            $agent = User::with('agent_info')->find($id);
            $states = DB::table('states')->get();
            // Get the previous agent ID
            $previous = User::where('id', '<', $id)->where('role_name', 'agent')->orderBy('id', 'desc')->first();
            // Get the next agent ID
            $next = User::where('id', '>', $id)->where('role_name', 'agent')->orderBy('id', 'asc')->first();
            return view('admin.agent.edit', compact('agent', 'states', 'previous', 'next'));
        } catch (\Exception $e) {
            return redirect()->back()->with('err_message', $e->getMessage());
        }
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'home_phone' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($request->hasFile('agent_image')) {
            $model = Agent::where('AgentUserRegisterId', $id)->first();
            $oldImagePath = public_path('assets/uploads/images/' . $model->image);
            if (File::exists($oldImagePath)) {
                // Delete the old image from the directory
                File::delete($oldImagePath);
            }
            $image = $request->file('agent_image');
            $path = public_path() . '/assets/uploads/images/';
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move($path, $filename);
        } else {
            $data = Agent::where('AgentUserRegisterId', $id)->first();
            $filename = $data->image;
        }
        $agent = Agent::where('AgentUserRegisterId', $id)->update([
            'LName' => $request->last_name,
            'FName' => $request->first_name,
            'Address1' => $request->address,
            'City' => $request->city,
            'State' => $request->state,
            'Zip' => $request->zip_code,
            'DOB' => $request->dob,
            'Telephone' => $request->home_phone,
            'Fax' => $request->fax,
            'Comments' => $request->comment,
            'Spouse' => $request->spouse,
            'SpFName' => $request->spouse_first_name,
            'SpLName' => $request->spouse_last_name,
            'SocSecNum' => $request->ss_number,
            'CellPhone' => $request->cellular,
            'Pager' => $request->pager,
            'HireDate' => $request->hire_date,
            'Termination' => $request->terminate_date,
            'Display' => $request->display_on_web,
            'image' => $filename,

        ]);
        if ($agent) {
            $userId = Auth::id();
            Activity::create([
                'action' => 'Agent update',
                'user_id' => $userId,
                'details' => 'update agent information agent name:' . $request->first_name . ' ' . $request->last_name,
            ]);
            return redirect('admin/agent/list')->with('success', 'Agent update successfully');
        } else {
            return redirect()->back()->with('success_message', 'There are some error! can not be update.');
        }
    }
    public function show($id)
    {

        $agent = User::with('agent_info')->find($id);
        $activities = Activity::latest()->paginate(10);
        /* dd($agent->agent_info->AgentID);
            $agent_details = $agent->agent_info->get();
            dd($agent_details->FName); */
        // Get the previous post ID
        $previous = User::where('id', '<', $id)->where('role_name', '=', 'agent')->orderBy('id', 'desc')->first();
        // Get the next post ID
        $next = User::where('id', '>', $id)->where('role_name', '=', 'agent')->orderBy('id', 'asc')->first();
        return view('admin.agent.show', compact('agent', 'previous', 'next', 'activities'));
    }
    public function destroy(Request $request, $id)
    {
        try {
            $agent = User::find($id);
            Activity::create([
                'action' => 'Agent delete',
                'user_id' => Auth::id(),
                'details' =>  'deleted a agent. agent name: ' . $agent->FName . ' ' . $agent->LName,
            ]);
            $agent->delete();
            return redirect()->route('list.agent')
                ->with('success', 'Agent deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('err_message', $e->getMessage());
        }
    }
    public function updateImage(Request $request, $id)
    {
        if ($request->hasFile('avatar')) {
            $model = Agent::where('AgentUserRegisterId', $id)->first();
            $oldImagePath = public_path('assets/uploads/images/' . $model->image);
            if (File::exists($oldImagePath)) {
                // Delete the old image from the directory
                File::delete($oldImagePath);
            }
            $image = $request->file('avatar');
            $path = public_path() . '/assets/uploads/images/';
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move($path, $filename);
        } else {
            $data = Agent::where('AgentUserRegisterId', $id)->first();
            $filename = $data->image;
        }
        $agent = Agent::where('AgentUserRegisterId', $id)->update([
            'image' => $filename,
        ]);
        if ($agent) {
            $agentInfo = Agent::where('AgentUserRegisterId', $id)->first();
            Activity::create([
                'action' => 'Update agent profile image',
                'user_id' => Auth::id(),
                'details' =>  'update agent profile image. agent name: ' . $agentInfo->FName . ' ' . $agentInfo->LName,
            ]);
            return redirect()->back()->with('success_message', 'Agent profile image update successfully');
        } else {
            return redirect()->back()->with('success_message', 'There are some error! can not be update.');
        }
    }
    public function deactivate(Request $request)
    {
        $request->validate([
            'agent_id' => 'required|exists:agents,AgentUserRegisterId',
            'new_agent_id' => 'required|exists:agents,AgentUserRegisterId',
        ]);
        $oldAgent = Agent::where('AgentUserRegisterId', $request->agent_id)->first();
        $newAgent = Agent::where('AgentUserRegisterId', $request->new_agent_id)->first();
        $userAgent = User::where('id', $request->agent_id)->where('role_name', 'agent')->first();
        if ($oldAgent && $userAgent) {
            Listing::where('AgentID', $oldAgent->AgentID)->update(['AgentID' => $newAgent->AgentID]);
            DB::table('leads')->where('AgentID', $oldAgent->AgentID)->update(['AgentID' => $newAgent->AgentID]);
            Offer::where('ListingAgent', $oldAgent->AgentID)->update(['ListingAgent' => $newAgent->AgentID]);
            Offer::where('SellingAgent', $oldAgent->AgentID)->update(['SellingAgent' => $newAgent->AgentID]);
            Buyer::where('AgentID', $oldAgent->AgentID)->update(['AgentID' => $newAgent->AgentID]);
            Showing::where('AgentID', $oldAgent->AgentID)->update(['AgentID' => $newAgent->AgentID]);
            $oldAgent->delete();
            $userAgent->delete();
        }
        return redirect()->route('list.agent')->with('success', 'Agent deactivated and data reassigned successfully.');
    }
    public function search(Request $request)
    {
        $keyword = $request->get('keyword');

        $agents = Agent::where(function ($query) use ($keyword) {
            $query->where('FName', 'like', "%$keyword%")
                ->orWhere('LName', 'like', "%$keyword%")
                ->orWhere('AgentID', 'like', "%$keyword%");
        })->limit(20)->get();

        return response()->json($agents);
    }
}
