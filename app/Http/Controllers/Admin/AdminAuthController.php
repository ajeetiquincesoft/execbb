<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Listing;
use App\Models\Agent;
use App\Models\Buyer;
use App\Models\Showing;
use App\Models\Offer;
use App\Models\AgentListingViewByBuyer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AdminAuthController extends Controller
{
    public function index(){
        return view('Auth.login');

    }
    public function customLogin(Request $request)
    {
     
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
       
        if ($validator->fails()) { 
            return redirect()->back()->withErrors($validator)->withInput();
         }
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $userrole = Auth::user()->role_name;
            //logActivity('login', 'Admin user logged in successfully');
            if($userrole == 'admin'){
                return redirect()->intended('admin/dashboard')
                        ->withSuccess('Signed in');
            }
            if($userrole == 'agent'){
                return redirect()->intended('agent/dashboard')
                        ->withSuccess('Signed in');
            }
            if($userrole == 'buyer'){
                return redirect()->intended('buyer/dashboard')
                        ->withSuccess('Signed in');
            }
            
        }
        return redirect()->back()->withErrors(['emailPassword' => 'Email address or password is incorrect.'])->withInput();
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
            $listings = Listing::count();
            $closeListings = Listing::where('Status', 'close')->count();
            $assignListings = Listing::whereNotNull('RefAgentID')->count();
            $validActiveListingsCount = Listing::where('Active',1)->where('Status', 'valid')->count();
            $activeListingsCount = Listing::where('Active',1)->count();
            $inactiveListingsCount = Listing::where('Active',0)->count();
            $validActiveListingsPercentage = $listings > 0 ? ($validActiveListingsCount / $listings) * 100 : 0;
            $activeListingsPercentage = $listings > 0 ? ($activeListingsCount / $listings) * 100 : 0;
            $inactiveListingsPercentage = $listings > 0 ? ($inactiveListingsCount / $listings) * 100 : 0;
            $agents = Agent::count();
            $buyers = Buyer::count();
            $showings = Showing::count();
            $offers = Offer::count();
            $leads = DB::table('leads')->count();
            $buyerViewListingCountByMonth = AgentListingViewByBuyer::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->keyBy('month')
            ->toArray();
            //dd($buyerViewListingCountByMonth);

        // Default data for months (if no data for a particular month, set count to 0)
        $monthlyCounts = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyCounts[] = isset($buyerViewListingCountByMonth[$i]) ? $buyerViewListingCountByMonth[$i]['count'] : 0;
        }
                // Prepare data for the line chart
            $lineChartData = [
                'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                'datasets' => [
                    [
                        'label' => 'Buyer Views',
                        'data' => $monthlyCounts,  // Monthly counts of buyer views
                        'borderColor' => '#965a3e',
                        'fill' => false,
                        'tension' => 0.4,
                    ]
                ]
            ];
                // Prepare data for the donut chart (corrected)
            $donutChartData = [
                'labels' => [
                    number_format($validActiveListingsPercentage, 2) . '%', 
                    number_format($activeListingsPercentage, 2) . '%', 
                    number_format($inactiveListingsPercentage, 2) . '%'
                ], // The labels for each segment
                'datasets' => [
                    [
                        'data' => [$validActiveListingsCount,  $activeListingsCount, $inactiveListingsCount],  // The data for each segment
                        'backgroundColor' => ['#4b0a26', '#b0848c', '#e3c8cb'],  // The colors for each segment
                    ]
                ]
            ];
            return view('admin.dashboard',compact('listings','agents','buyers','showings','offers','leads','donutChartData','validActiveListingsPercentage','activeListingsPercentage','inactiveListingsPercentage','lineChartData','closeListings','assignListings'));
        }
  
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}
