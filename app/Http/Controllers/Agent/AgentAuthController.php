<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Listing;
use App\Models\Buyer;
use App\Models\Agent;
use App\Models\AgentListingViewByBuyer;

class AgentAuthController extends Controller
{
    public function agentDashboard()
    {
        
        if(Auth::check()){
            $user = auth()->user();
            $agent = Agent::where('AgentUserRegisterId', $user->id)->first();
            $listingsCount = Listing::where('RefAgentID', $user->id)->count();
            $validActiveListingsCount = Listing::where('RefAgentID', $user->id)->where('Active',1)->where('Status', 'valid')->count();
            $activeListingsCount = Listing::where('RefAgentID', $user->id)->where('Active',1)->count();
            $inactiveListingsCount = Listing::where('RefAgentID', $user->id)->where('Active',0)->count();
            $validActiveListingsPercentage = $listingsCount > 0 ? ($validActiveListingsCount / $listingsCount) * 100 : 0;
            $activeListingsPercentage = $listingsCount > 0 ? ($activeListingsCount / $listingsCount) * 100 : 0;
            $inactiveListingsPercentage = $listingsCount > 0 ? ($inactiveListingsCount / $listingsCount) * 100 : 0;
            $buyersCount = Buyer::where('AgentID', $agent->AgentID)->whereNotNull('user_id')->count();
            $leadsCount = DB::table('leads')->where('AgentID', $agent->AgentID)->count();
            $buyerViewListingCount = AgentListingViewByBuyer::with(['listing', 'buyer', 'agent'])->where('agent_id', $user->id)->distinct('buyer_id')->count('buyer_id');
            $buyerViewListingCountByMonth = AgentListingViewByBuyer::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->where('agent_id', $user->id)
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
            //dd($buyerViewListingCount);
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
            return view('agent-dashboard.dashboard', compact('listingsCount','buyersCount','leadsCount','buyerViewListingCount','lineChartData','donutChartData','validActiveListingsPercentage','activeListingsPercentage','inactiveListingsPercentage'));
        }
  
        return redirect("login")->withSuccess('You are not allowed to access');
    }
}
