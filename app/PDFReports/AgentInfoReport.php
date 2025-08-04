<?php

namespace App\PDFReports;

use Dompdf\Dompdf;
use Dompdf\Options;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AgentInfoReport
{
    public function generate($agentInfo)
    {
        $from = Carbon::now()->subYear()->startOfDay();
        $to = Carbon::now()->endOfDay();
        $monthFrom = Carbon::now()->subDays(30)->startOfDay();
        $monthTo = Carbon::now()->endOfDay();
        $agentId = $agentInfo->AgentID;

        $stats = [];
        $monthlyStats = [];

        // Buyers
        $stats['buyers'] = DB::table('buyers')
            ->where('AgentID', $agentId)
            ->whereBetween('created_at', [$from, $to])
            ->count();

        // Listings
        $stats['listings'] = DB::table('listings')
            ->where('AgentID', $agentId)
            ->whereBetween('created_at', [$from, $to])
            ->count();

        // Listings by status
        $stats['listings_sole'] = DB::table('listings')
            ->where('AgentID', $agentId)
            ->where('ListType', 1)
            ->whereBetween('created_at', [$from, $to])
            ->count();

        $stats['listings_excl'] = DB::table('listings')
            ->where('AgentID', $agentId)
            ->where('ListType', 2)
            ->whereBetween('created_at', [$from, $to])
            ->count();

        $stats['listings_valid'] = DB::table('listings')
            ->where('AgentID', $agentId)
            ->where('Status', 'Valid')
            ->whereBetween('created_at', [$from, $to])
            ->count();

        // Offers
        $stats['offers'] = DB::table('offers')
            ->where(function ($query) use ($agentId) {
                $query->where('ListingAgent', $agentId)
                    ->orWhere('SellingAgent', $agentId);
            })
            ->whereBetween('created_at', [$from, $to])
            ->count();
        // Open Offers
        $stats['offers_open'] = DB::table('offers')
            ->where(function ($query) use ($agentId) {
                $query->where('ListingAgent', $agentId)
                    ->orWhere('SellingAgent', $agentId);
            })
            ->where('Status', 'Open')
            ->whereBetween('created_at', [$from, $to])
            ->count();

        // Pending Offers
        $stats['offers_pending'] = DB::table('offers')
            ->where(function ($query) use ($agentId) {
                $query->where('ListingAgent', $agentId)
                    ->orWhere('SellingAgent', $agentId);
            })
            ->where('Status', 'Pending')
            ->whereBetween('created_at', [$from, $to])
            ->count();
        // Showings
        $stats['showings'] = DB::table('showings')
            ->where('AgentID', $agentId)
            ->whereBetween('created_at', [$from, $to])
            ->count();



        // Buyers (Monthly)
        $monthlyStats['buyers'] = DB::table('buyers')
            ->where('AgentID', $agentId)
            ->whereBetween('created_at', [$monthFrom, $monthTo])
            ->count();

        // Listings (Monthly)
        $monthlyStats['listings'] = DB::table('listings')
            ->where('AgentID', $agentId)
            ->whereBetween('created_at', [$monthFrom, $monthTo])
            ->count();

        // Listings by status (Monthly)
        $monthlyStats['listings_sole'] = DB::table('listings')
            ->where('AgentID', $agentId)
            ->where('ListType', 1)
            ->whereBetween('created_at', [$monthFrom, $monthTo])
            ->count();

        $monthlyStats['listings_excl'] = DB::table('listings')
            ->where('AgentID', $agentId)
            ->where('ListType', 2)
            ->whereBetween('created_at', [$monthFrom, $monthTo])
            ->count();

        $monthlyStats['listings_valid'] = DB::table('listings')
            ->where('AgentID', $agentId)
            ->where('Status', 'Valid')
            ->whereBetween('created_at', [$monthFrom, $monthTo])
            ->count();

        // Offers (Monthly)
        $monthlyStats['offers'] = DB::table('offers')
            ->where(function ($query) use ($agentId) {
                $query->where('ListingAgent', $agentId)
                    ->orWhere('SellingAgent', $agentId);
            })
            ->whereBetween('created_at', [$monthFrom, $monthTo])
            ->count();
        // Open Offers
        $monthlyStats['offers_open'] = DB::table('offers')
            ->where(function ($query) use ($agentId) {
                $query->where('ListingAgent', $agentId)
                    ->orWhere('SellingAgent', $agentId);
            })
            ->where('Status', 'Open')
            ->whereBetween('created_at', [$from, $to])
            ->count();

        // Pending Offers
        $monthlyStats['offers_pending'] = DB::table('offers')
            ->where(function ($query) use ($agentId) {
                $query->where('ListingAgent', $agentId)
                    ->orWhere('SellingAgent', $agentId);
            })
            ->where('Status', 'Pending')
            ->whereBetween('created_at', [$from, $to])
            ->count();
        // Showings (Monthly)
        $monthlyStats['showings'] = DB::table('showings')
            ->where('AgentID', $agentId)
            ->whereBetween('created_at', [$monthFrom, $monthTo])
            ->count();
        //get offer data based on listing agents
        $listingAgents = DB::table('offers')
            ->where('ListingAgent', $agentId)
            ->whereIn('Status', ['Accepted', 'Pending'])
            ->get();
        //get offer data based on selling agents
        $sellingAgents = DB::table('offers')
            ->where('SellingAgent', $agentId)
            ->whereIn('Status', ['Accepted', 'Pending'])
            ->get();
        $date = now()->format('m/d/Y');
        $spouse = $agentInfo->Spouse == 1 ? 'Yes' : 'No';
        $license = $agentInfo->License == 1 ? 'Yes' : 'No';
        $html = '<div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
                <div>
                    <strong>Executive Business Brokers</strong><br>
                    Agent Information
                </div>
                <div style="text-align: right;">
                    As of: ' . $date . '
                </div>
            </div>';
        $html .= '<table border="0" cellspacing="0" cellpadding="4" style="width:100%; font-size: 12px;">';
        $html .= '<tr><td colspan="2"><strong style="font-size: 18px;">' . $agentInfo->FName . ' ' . $agentInfo->LName . '</strong><br><strong>Agent:</strong> ' . $agentInfo->AgentID . '-' . $agentInfo->FName . ' ' . $agentInfo->LName . '<br><strong>Address:</strong> ' . $agentInfo->Address1 . '<br><strong>City:</strong> ' . $agentInfo->City . ', ' . $agentInfo->State . ' ' . $agentInfo->Zip . '</td>';
        $html .= '<td colspan="2" style="text-align:right;"><strong>Licensed:</strong>' . $license . '<br><strong>Active:</strong> Yes<br><strong>Spouse:</strong> ' . $spouse . '<br><strong>Spouse Name:</strong> ' . $agentInfo->SpFName . ' ' . $agentInfo->SpLName . '</td></tr>';
        $html .= '<tr><td colspan="2"><strong>Date of Birth:</strong> ' . $agentInfo->DOB . '<br><strong>Home Phone:</strong> ' . $agentInfo->Telephone . '<br><strong>Fax:</strong> ' . $agentInfo->Fax . '<br><strong>Email:</strong> ' . $agentInfo->Email . '</td>';
        $html .= '<td colspan="2" style="text-align:right;"><strong>SS Number:</strong> ' . $agentInfo->SocSecNum . '<br><strong>Cell:</strong> ' . $agentInfo->CellPhone . '<br><strong>Pager:</strong> ' . $agentInfo->Pager . '<br> <strong>Date Hired:</strong> ' . $agentInfo->HireDate . '</td></tr>';
        $html .= '</table><br>';
        // Statistics
        $html .= '<table style="width: 100%; table-layout: fixed; font-size: 12px;">
                    <tr>
                        <!-- Left Table -->
                        <td style="width: 50%; vertical-align: top;">
                            <table style="width: 100%; border: 1px solid #000; border-collapse: separate;">
                                <thead>
                                    <tr style="background-color: #F2F2F2;">
                                        <th colspan="2" style="text-align: center; padding: 6px;">Past Year (365 days) Statistics</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><td>Buyers</td><td>' . $stats['buyers'] . '</td></tr>

                                    <tr><td>Listings</td><td>' . $stats['listings'] . '</td></tr>
                                    <tr><td style="padding-left: 20px;">&nbsp;&nbsp;&nbsp;Sole</td><td>' . $stats['listings_sole'] . '</td></tr>
                                    <tr><td style="padding-left: 20px;">&nbsp;&nbsp;&nbsp;Excl.</td><td>' . $stats['listings_excl'] . '</td></tr>
                                    <tr><td style="padding-left: 20px;">&nbsp;&nbsp;&nbsp;Valid</td><td>' . $stats['listings_valid'] . '</td></tr>

                                    <tr><td>All Offers</td><td>' . $stats['offers'] . '</td></tr>
                                    <tr><td style="padding-left: 20px;">&nbsp;&nbsp;&nbsp;Open</td><td>' . $stats['offers_open'] . '</td></tr>
                                    <tr><td style="padding-left: 20px;">&nbsp;&nbsp;&nbsp;Pending Offers</td><td>' . $stats['offers_pending'] . '</td></tr>

                                    <tr><td>Showings</td><td>' . $stats['showings'] . '</td></tr>
                                    <tr><td>Closings</td><td>1</td></tr>
                                </tbody>
                            </table>
                        </td>

                        <!-- Right Table -->
                        <td style="width: 50%; vertical-align: top;">
                            <table style="width: 100%; border: 1px solid #000; border-collapse: separate;">
                                <thead>
                                    <tr style="background-color: #F2F2F2;">
                                        <th colspan="2" style="text-align: center; padding: 6px;">Monthly (30 days) Statistics</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <tr><td>Buyers</td><td>' . $monthlyStats['buyers'] . '</td></tr>

                                    <tr><td>Listings</td><td>' . $monthlyStats['listings'] . '</td></tr>
                                    <tr><td style="padding-left: 20px;">&nbsp;&nbsp;&nbsp;Sole</td><td>' . $monthlyStats['listings_sole'] . '</td></tr>
                                    <tr><td style="padding-left: 20px;">&nbsp;&nbsp;&nbsp;Excl.</td><td>' . $monthlyStats['listings_excl'] . '</td></tr>
                                    <tr><td style="padding-left: 20px;">&nbsp;&nbsp;&nbsp;Valid</td><td>' . $monthlyStats['listings_valid'] . '</td></tr>

                                    <tr><td>All Offers</td><td>' . $monthlyStats['offers'] . '</td></tr>
                                    <tr><td style="padding-left: 20px;">&nbsp;&nbsp;&nbsp;Open</td><td>' . $monthlyStats['offers_open'] . '</td></tr>
                                    <tr><td style="padding-left: 20px;">&nbsp;&nbsp;&nbsp;Pending Offers</td><td>' . $monthlyStats['offers_pending'] . '</td></tr>

                                    <tr><td>Showings</td><td>' . $monthlyStats['showings'] . '</td></tr>
                                    <tr><td>Closings</td><td>1</td></tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </table><br>';
        // Pending and Accepted Offers Table*
        $html .= '<h3 style="font-size: 14px;">Pending and Accepted Offers as Listing Agent</h3>';
        $html .= '<table border="1" cellpadding="4" cellspacing="0" style="width: 100%; border-collapse: collapse; font-size: 12px;">';
        $html .= '<thead><tr style="background-color: #F2F2F2;"><th>DBA</th><th>Seller</th><th>Buyer</th><th>Selling Agent</th><th>Status</th></tr></thead>';
        $html .= '<tbody>';
        foreach ($listingAgents as $listingAgent) {
            // Get Buyer Info
            $buyer = DB::table('buyers')->where('BuyerID', $listingAgent->BuyerID)->first();
            $listingAgent->buyer_name = $buyer ? $buyer->FName . ' ' . $buyer->LName : 'Unknown';

            // Get Agent Info
            $agent = DB::table('agents')->where('AgentID', $listingAgent->SellingAgent)->first();
            $listingAgent->seller_name = $agent ? $agent->FName . ' ' . $agent->LName : 'Unknown';

            // Get DBA (either from offers or fallback to listings)
            $dba = $listingAgent->DBA;
            if (empty($dba)) {
                $listing = DB::table('listings')->where('ListingID', $listingAgent->ListingID)->first();
                $dba = $listing ? $listing->DBA : 'N/A';
            }
            $html .= '<tr><td>' . $dba . '</td><td>' . $listingAgent->seller_name . '</td><td>' . $listingAgent->buyer_name . '</td><td>' . $listingAgent->SellingAgent . '</td><td>' . $listingAgent->Status . '</td></tr>';
        }
        $html .= '</tbody></table>';

        // Pending and Accepted Offers Table*

        $html .= '<h3 style="font-size: 14px;">Pending and Accepted Offers as Selling Agent</h3>';
        $html .= '<table border="1" cellpadding="4" cellspacing="0" style="width: 100%; border-collapse: collapse; font-size: 12px;">';
        $html .= '<thead><tr style="background-color: #F2F2F2;"><th>DBA</th><th>Seller</th><th>Buyer</th><th>Listing Agent</th><th>Status</th></tr></thead>';
        $html .= '<tbody>';
        foreach ($sellingAgents as $sellingAgent) {
            // Get Buyer Info
            $buyer = DB::table('buyers')->where('BuyerID', $sellingAgent->BuyerID)->first();
            $sellingAgent->buyer_name = $buyer ? $buyer->FName . ' ' . $buyer->LName : 'Unknown';

            // Get Agent Info
            $agent = DB::table('agents')->where('AgentID', $sellingAgent->ListingAgent)->first();
            $sellingAgent->seller_name = $agent ? $agent->FName . ' ' . $agent->LName : 'Unknown';

            // Get DBA (either from offers or fallback to listings)
            $dba = $sellingAgent->DBA;
            if (empty($dba)) {
                $listing = DB::table('listings')->where('ListingID', $sellingAgent->ListingID)->first();
                $dba = $listing ? $listing->DBA : 'N/A';
            }
            $html .= '<tr><td>' . $dba . '</td><td>' . $sellingAgent->seller_name . '</td><td>' . $sellingAgent->buyer_name . '</td><td>' . $sellingAgent->ListingAgent . '</td><td>' . $sellingAgent->Status . '</td></tr>';
        }
        $html .= '</tbody></table>';
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        return $dompdf->output();
    }
}
