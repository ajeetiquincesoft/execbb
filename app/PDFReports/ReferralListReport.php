<?php

namespace App\PDFReports;

use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ReferralListReport
{
    public function generate(Request $request)
    {
        $referrals = DB::table('referrals')
            ->where('RefType', $request->referral_status)
            ->limit(100)
            ->get();

        $html = '
        <style>
            body {
                font-family: Arial, sans-serif;
                font-size: 10pt;
            }
            .header-container {
                width: 100%;
                display: flex;
                justify-content: space-between;
                margin-bottom: 10px;
            }
            .header {
                font-weight: bold;
                font-size: 12pt;
            }
            .report-title {
                font-size: 12pt;
                font-weight: bold;
                margin: 10px 0;
                text-align: center;
            }
            table {
                border-collapse: collapse;
                width: 100%;
                font-size: 9pt;
            }
            th, td {
                border: 1px solid #000;
                padding: 4px 6px;
                text-align: left;
            }
            th {
                background-color: #f2f2f2;
                font-weight: bold;
            }
            .no-results {
                text-align: center; 
                margin-top: 50px; 
                font-size: 14pt;
                font-weight: bold;
            }
        </style>';

        // header
        $html .= '
        <div class="header-container">
            <div class="header">Executive Business Brokers</div>
            <div>As of: ' . now()->format('n/j/Y') . '</div>
        </div>
        <div class="report-title">Referrals List</div>';

        // results or no results
        if ($referrals->count() > 0) {
            $html .= '
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ref Comp Name</th>
                        <th>Ref Agent</th>
                        <th>Agent Phone</th>
                        <th>Ref Name</th>
                        <th>Ref Phone</th>
                        <th>Ref Interest</th>
                        <th>Ref DBA</th>
                        <th>Ref Fee</th>
                        <th>Fee %</th>
                        <th>Ref Amt</th>
                        <th>Flat Fee</th>
                    </tr>
                </thead>
                <tbody>';

            foreach ($referrals as $referral) {
                $html .= '<tr>
                    <td>' . e($referral->RefID) . '</td>
                    <td>' . e($referral->RefCompany) . '</td>
                    <td>' . e($referral->AgentName) . '</td>
                    <td>' . e($referral->Phone) . '</td>
                    <td>' . e($referral->ReferredName) . '</td>
                    <td>' . e($referral->ReferredPhone) . '</td>
                    <td>' . e($referral->ReferredInterest) . '</td>
                    <td>' . e($referral->ReferredDBA) . '</td>
                    <td>$' . e($referral->RefFee) . '</td>
                    <td>' . e($referral->RefFeePer) . '</td>
                    <td>$' . e($referral->RefAmt) . '</td>
                    <td>' . e($referral->FlatFee) . '</td>
                </tr>';
            }

            $html .= '</tbody></table>';
        } else {
            $html .= '<div class="no-results">No results found for the given filters.</div>';
        }

        // generate PDF
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        return $dompdf->output();
    }
}
