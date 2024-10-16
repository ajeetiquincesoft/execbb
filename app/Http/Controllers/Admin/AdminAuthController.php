<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function index(){
        return view('Auth.login');

    }
    public function customLogin(Request $request)
    {
       $validator =  $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
    
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $userrole = Auth::user()->role_name;
            if($userrole == 'admin'){
                return redirect()->intended('admin/dashboard')
                        ->withSuccess('Signed in');
            }
            if($userrole == 'agent'){
                return redirect()->intended('agent/dashboard')
                        ->withSuccess('Signed in');
            }
            
        }
        $validator['emailPassword'] = 'Email address or password is incorrect.';
        return redirect("login")->withErrors($validator);
    }
    public function registration()
    {
        return view('Auth.registration');
    }
    public function customRegistration(Request $request)
    {  
        //dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect("admin/dashboard")->withSuccess('You have signed-in');
    }


    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'role_name' => $data['role_name'],
        'password' => Hash::make($data['password'])
      ]);
    }
    public function dashboard()
    {
        if(Auth::check()){
            return view('admin.dashboard');
        }
  
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}
