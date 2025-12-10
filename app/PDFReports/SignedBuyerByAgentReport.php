<?php

namespace App\PDFReports;

use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SignedBuyerByAgentReport
{
    public function generate(Request $request)
    {
        $from = $request->from_date;
        $to = $request->to_date;
        $agentInfo = DB::table('agents')->where('AgentID', $request->agent)->first();
        $fname = '';
        $lname = '';
        if ($agentInfo) {
            $fname = $agentInfo->FName;
            $lname = $agentInfo->LName;
        }
        $html = '';
        $Buyers = DB::table('buyers')
            ->when($request->agent, function ($q) use ($request) {
                $q->where('AgentID', $request->agent);
            })
            ->where('Signed', 1)
            ->whereBetween('DateEntered', [$from, $to])
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
            <p><strong>As Of:</strong> 8/19/2025</p>
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
                <th>ID</th>
                <th>Name</th>
                <th>City</th>
                <th>State</th>
                <th>Date</th>
                <th>Home</th>
                <th>Bus</th>
                <th>Call When</th>
                <th>Signed</th>
                <th>Interest</th>
                <th>Location</th>
                <th>Type1</th>
                <th>Type2</th>
                <th>Type3</th>
                <th>Type4</th>
                <th>County1</th>
                <th>County2</th>
                <th>County3</th>
                <th>County4</th>
                <th>Max Pur Price</th>
                <th>Down Pay</th>
                <th>Annual Sales</th>
                <th>Net Profit</th>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>';
        foreach ($Buyers as $buyer) {
            $BusType1 = DB::table('sub_categories')
                ->where('SubCatID', $buyer->BusType1)
                ->first();
            $BusType2 = DB::table('sub_categories')
                ->where('SubCatID', $buyer->BusType2)
                ->first();
            $BusType3 = DB::table('sub_categories')
                ->where('SubCatID', $buyer->BusType3)
                ->first();
            $BusType4 = DB::table('sub_categories')
                ->where('SubCatID', $buyer->BusType4)
                ->first();
            $html .= '<tr>
                        <td>' . $buyer->BuyerID . '</td>
                        <td>' . $buyer->FName . ' ' . $buyer->LName . '</td>
                        <td>' . $buyer->City . '</td>
                        <td>' . $buyer->State . '</td>
                        <td>' . (!empty($buyer->BDate) && strtotime($buyer->BDate) ? date('d/m/Y', strtotime($buyer->BDate)) : '') . '</td>
                        <td>' . $buyer->HomePhone . '</td>
                        <td>' . $buyer->BusPhone . '</td>
                        <td>' . $buyer->CallWhen . '</td>
                        <td>' . $buyer->Signed . '</td>
                        <td>' . $buyer->Interest . '</td>
                        <td>' . $buyer->BusLocation . '</td>
                        <td>' . ($BusType1->SubCategory ?? '') . '</td>
                        <td>' . ($BusType2->SubCategory ?? '') . '</td>
                        <td>' . ($BusType3->SubCategory ?? '') . '</td>
                        <td>' . ($BusType4->SubCategory ?? '') . '</td>
                        <td>' . $buyer->BusCounty1 . '</td>
                        <td>' . $buyer->BusCounty2 . '</td>
                        <td>' . $buyer->BusCounty3 . '</td>
                        <td>' . $buyer->BusCounty4 . '</td>
                        <td>' . $buyer->PPMax . '</td>
                        <td>' . $buyer->DownPmtMax . '</td>
                        <td>' . $buyer->VolMax . '</td>
                        <td>' . $buyer->NetProfMax . '</td>
                        <td>' . $buyer->Comments . '</td>
                    </tr>';
        }
        $html .= '</tbody>
    </table>';
        /* $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        return $dompdf->output(); */
        return $html;
    }
}
