<?php

namespace App\PDFReports;

use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BuyerLeadListReport
{
    public function generate(Request $request)
    {
        $agentInfo = DB::table('agents')->where('AgentID', $request->agent)->first();
        $fname = '';
        $lname = '';
        if ($agentInfo) {
            $fname = $agentInfo->FName;
            $lname = $agentInfo->LName;
        }
        $html = '';
        $leads = DB::table('leads')
            ->when($request->agent, function ($q) use ($request) {
                $q->where('AgentID', $request->agent);
            })
            ->limit(200)
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
            <p><strong>Buyer List</strong></p>
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
                <th>Site</th>
                <th>Date</th>
                <th>Name</th>
                <th>City</th>
                <th>State</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Listing ID</th>
                <th>DBA</th>
                <th>Details</th>
                <th>Comments</th>
            </tr>
        </thead>
        <tbody>';
        foreach ($leads as $lead) {
            $html .= '<tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>';
        }
        $html .= '</tbody>
    </table>';
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        return $dompdf->output();
    }
}
