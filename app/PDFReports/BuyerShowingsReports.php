<?php

namespace App\PDFReports;

use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BuyerShowingsReports
{
    public function generate(Request $request)
    {
        $html = '';
        $fname = '';
        $lname = '';

        if (!empty($request->agent)) {
            $agentInfo = DB::table('agents')->where('AgentID', $request->agent)->first();
            if ($agentInfo) {
                $fname = $agentInfo->FName;
                $lname = $agentInfo->LName;
            }
        }

        $showings = DB::table('showings')
            ->leftJoin('listings', 'showings.ListingID', '=', 'listings.ListingID')
            ->select(
                'showings.*',
                'listings.DBA',
                'listings.City',
                'listings.State'
            )
            ->when(!empty($request->buyer_id) && $request->buyer_id !== "all", function ($q) use ($request) {
                $q->where('showings.BuyerID', $request->buyer_id);
            })
            ->when(!empty($request->agent), function ($q) use ($request) {
                $q->where('showings.AgentID', $request->agent);
            })
            ->when(!empty($request->from_date) && !empty($request->to_date), function ($q) use ($request) {

                $from = date('Y-m-d', strtotime($request->from_date));
                $to   = date('Y-m-d', strtotime($request->to_date));
                $q->whereBetween('showings.Date', [$from, $to]);
            })
            ->orderBy('showings.Date', 'DESC')
            ->limit(1000)
            ->get();
        $html .= '<style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            margin: 20px;
            color: #000;
        }
        .header {
            width: 100%;
            margin-bottom: 20px;
        }
        .header-left {
            float: left;
            text-align: left;
        }
        .header-right {
            float: right;
            text-align: right;
        }
        .clearfix {
            clear: both;
        }
        h2 {
            margin: 0;
            padding: 0;
            font-size: 16px;
        }
        p {
            margin: 2px 0;
            padding: 0;
        }
         table {
            width: 100%;
            border-collapse: collapse;
            font-size: 8px; /* shrink table text */
            table-layout: fixed; /* important to fit */
            word-wrap: break-word; /* wrap text */
        }
        th, td {
            border: 1px solid #000;
            padding: 2px; /* smaller padding */
            text-align: center;
            vertical-align: middle;
        }
        th {
            background: #f2f2f2;
        }
        .no-results {
            text-align: left;
            margin-top: 10px;
            font-weight: bold;
        }
    </style>
    <!-- Header -->
    <div class="header">
        <div class="header-left">
            <h2>Executive Business Brokers</h2>
            <p><strong>Showings List</strong></p>
        </div>
        <div class="header-right">
            <p><strong>As Of:</strong>' . now()->format('n/j/Y') . '</p>
        </div>
        <div class="clearfix"></div>
    </div>

    <!-- Agent -->
    <div class="section">
        <p><strong>Agent:</strong> ' . $fname . ', ' . $lname . '</p>
    </div>
    <!-- Data Table -->
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>DBA</th>
                <th>City,State</th>
                <th>Agent</th>
                <th>Offer</th>
                <th>Verbal</th>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>';
        foreach ($showings as $showing) {
            $cityState = trim(($showing->City ?? '') . ', ' . ($showing->State ?? ''), ', ');
            $showingDate = Carbon::parse($showing->Date)->format('m/d/Y');
            $html .= '<tr>
                        <td>' . ($showingDate ?? '') . '</td>
                        <td>' . ($showing->DBA ?? '') . '</td>
                        <td>' . $cityState . '</td>
                        <td>' . ($showing->AgentID ?? '') . '</td>
                        <td>' . ((isset($showing->OfferMade) && $showing->OfferMade == 1) ? 'Yes' : 'No') . '</td>
                        <td>' . ($showing->Verbal ?? '') . '</td>
                        <td>' . ($showing->Notes ?? '') . '</td>
                    </tr>';
        }
        $html .= '</tbody>
    </table>';
        return $html;
    }
}
