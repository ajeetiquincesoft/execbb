<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Agent;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Events\AgentRegister;
use App\Mail\AgentWelcome;
use Illuminate\Support\Facades\Mail;


class AgentController extends Controller
{
    public function index(){
        try{
        $agents = User::with('agent_info')->where('role_name','agent')->get();
        return view('admin.agent.index',compact('agents'));
        }
        catch(\Exception $e){
            return redirect()->back()->with('err_message',$e->getMessage());
        }
    }
    public function create(){
        try{
            //event(new AgentRegister('santosh3257@gmail.com'));
        return view('admin.agent.create');
        }
        catch(\Exception $e){
            return redirect()->back()->with('err_message',$e->getMessage());
        }
    }
    public function store(Request $request){
        try{
        //dd($request->all());
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
        $check = $this->agentRegistration($data);
        //dd($check->id);
        $agent = new Agent;
        $agent->AgentID = $request->agent_id;
        $agent->LName = $request->last_name;
        $agent->FName = $request->first_name;
        $agent->Address1 = $request->address;
        $agent->City = $request->city;
        $agent->State = $request->state;
        $agent->DOB = $request->dob;
        $agent->Telephone = $request->home_phone;
        $agent->Fax = $request->fax;
        $agent->Email = $request->email;
        $agent->Comments = $request->comment;
        $agent->Spouse = $request->spouse;
        $agent->SocSecNum = $request->ss_number;
        $agent->CellPhone = $request->cellular;
        $agent->Pager = $request->pager;
        $agent->HireDate = $request->hire_date;
        $agent->Termination = $request->terminate_date;
        $agent->AgentUserRegisterId =  $check->id;
        $agent->save();
         // call the event
         //Mail::to('santosh3257@gmail.com')->send(new AgentWelcome());
        //event(new AgentRegistered($data));
        return redirect('admin/create/agent')->with('success_message','Agent register successfully');
        }
        catch(\Exception $e){
            return redirect()->back()->with('err_message',$e->getMessage());
        }
    }
    public function agentRegistration(array $data)
    {
    $password = $data['first_name'].'@123';
      return User::create([
        'name' => $data['first_name'],
        'email' => $data['email'],
        'role_name' => 'agent',
        'password' => Hash::make($password)
      ]);
    }
    public function edit($id){
        try{
        $agent = User::find($id);
        return view('admin.agent.edit', compact('agent'));
        }
        catch(\Exception $e){
            return redirect()->back()->with('err_message',$e->getMessage());
        }
   

    }
    public function update(Request $request,$id){
        try{
        $agent = User::find($id);
        $agent->name = $request->name;
        $agent->email = $request->email;
        $agent->save();
        return redirect()->route('agent')
        ->with('success', 'Agent update successfully');
        }
        catch(\Exception $e){
            return redirect()->back()->with('err_message',$e->getMessage());
        }
   

    }
    public function show($id){
        
        $agent = User::with('agent_info')->find($id);
         /* dd($agent->agent_info->AgentID);
        $agent_details = $agent->agent_info->get();
        dd($agent_details->FName); */
        return view('admin.agent.show', compact('agent'));
       
   

    }
    public function destroy(Request $request, $id){
        try{
        $agent = User::find($id);
        $agent->delete();
        return redirect()->route('list.agent')
        ->with('success', 'Agent deleted successfully');
        }
        catch(\Exception $e){
            return redirect()->back()->with('err_message',$e->getMessage());
        }

    }
}
