<?php

namespace App\PDFReports;

use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EscrowListReport
{
    public function generate(Request $request)
    {
        // Base query
        $query = DB::table('offers');
        // Filters
        if ($request->buyer_id && $request->buyer_id != 'all') {
            $query->where('BuyerID', $request->buyer_id);
        }

        // Run query
        $escrows = $query->limit(100)->get();
        $html = '<style>
        body {
                font-family: Arial, sans-serif;
                font-size: 10pt;
            }
            .header-container {
                width: 100%;
                margin-bottom: 10px;
                text-align: left;
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
            .no-results {
            text-align: center; 
            margin-top: 50px; 
            font-size: 14pt;
            font-weight: bold;
        }
            </style>';


        // Header
        $html .= '
        <div class="header-container">
            <div class="header">Executive Business Brokers</div>
            <div>As of: ' . now()->format('n/j/Y') . '</div>
        </div>
        <div class="report-title">Escrows Report</div>';

        // If results
        if ($escrows->count() > 0) {
            // If filters applied (single layout)
            if ($request->buyer_id && $request->buyer_id != 'all') {
                $escrow = $escrows->first();
                $buyerInfo = DB::table('buyers')->where('BuyerID', $escrow->BuyerID)->first();
                $html .= '<table border="0" cellpadding="4" cellspacing="0" style="width: 100%; font-size: 12px; margin-bottom: 30px;">';
                $html .= '<tr>';
                $html .= '<td><strong>ID:</strong> ' . e($escrow->OfferID) . '</td>';
                $html .= '<td><strong>Buyer:</strong> ' . e($buyerInfo->LName ?? "") . ' ' . e($buyerInfo->FName ?? "") . '</td>';
                $html .= '<td><strong>Amount:</strong> $' . e($escrow->PurchasePrice) . '</td>';
                $html .= '</tr>';
                $html .= '<tr>';
                $html .= '<td><strong>Listing Agent:</strong>' . e($escrow->ListingAgent) . '</td>';
                $html .= '<td><strong>Buyer Attorney:</strong> ' . e($escrow->BuyerAttorney) . '</td>';
                $html .= '<td><strong>Real Estate:</strong> ' . e($escrow->RealEstateInc) . '</td>';
                $html .= '</tr>';
                $html .= '<tr>
                <td><strong>Selling Agent:</strong> ' . htmlspecialchars($escrow->ListingAgent ?? '') . '</td>
                <td><strong>Seller Attorney :</strong> ' . htmlspecialchars($escrow->SellingAgent ?? '') . '</td>
                </tr>';
                $html .= '<tr>';
                $html .= '<td><strong>Deposit Check #:</strong> ' . htmlspecialchars($escrow->DepositCheckNumber ?? '') . '</td>';
                $html .= '<td><strong>Return Check #:</strong> ' . htmlspecialchars($escrow->CheckEBBReturnNumber ?? '') . '</td>';
                $html .= '<td><strong>Returned To #:</strong> ' . htmlspecialchars($escrow->CheckReturnedTo ?? '') . '</td>';
                $html .= '</tr>';
                $html .= '<tr>';
                $html .= '<td><strong>Deposited:</strong> ' . (!empty($escrow->DateDeposited) ? date("d/m/Y", strtotime($escrow->DateDeposited)) : "") . '</td>';
                $html .= '<td><strong>Returned:</strong> ' . (!empty($escrow->CheckReturned) ? date("d/m/Y", strtotime($escrow->CheckReturned)) : "") . '</td>';
                $html .= '<td><strong>Relationship:</strong> ' . htmlspecialchars($escrow->ReturneeRelationship ?? '') . '</td>';
                $html .= '</tr>';
                $html .= '<tr><td><strong>Bank Draw:</strong> ' . htmlspecialchars($escrow->BankDraw ?? '') . '</td></tr>';
                $html .= '<tr><td><strong>Check Amount:</strong> $' . htmlspecialchars($escrow->CheckAmt ?? '') . '</td></tr>';
                $html .= '</table>';
            } else {
                // Styles
                $html .= '
        <style>
            
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
            
            .single-layout {
                width: 100%;
                border: 1px solid #000;
                margin-top: 20px;
                border-collapse: collapse;
            }
            .single-layout td {
                border: 1px solid #000;
                padding: 6px;
                font-size: 10pt;
            }
            .single-label {
                font-weight: bold;
                background: #f2f2f2;
                width: 20%;
            }
        </style>';
                // List layout
                $html .= '<table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Buyer</th>
                            <th>Amount</th>
                            <th>List Agent</th>
                            <th>Sell Agent</th>
                            <th>B Attorney</th>
                            <th>S Attorney</th>
                            <th>RE Inc?</th>
                            <th>Check #</th>
                            <th>Bank</th>
                            <th>Deposited</th>
                            <th>Amount</th>
                            <th>Ret. Date</th>
                            <th>Ret. Check #</th>
                            <th>Returned To</th>
                            <th>Relationship</th>
                        </tr>
                    </thead>
                    <tbody>';

                foreach ($escrows as $escrow) {
                    $buyerInfo = DB::table('buyers')->where('BuyerID', $escrow->BuyerID)->first();

                    $html .= '<tr>
                        <td>' . e($escrow->OfferID) . '</td>
                        <td>' . e($buyerInfo->LName ?? '') . ' ' . e($buyerInfo->FName ?? '') . '</td>
                        <td>$' . e($escrow->PurchasePrice) . '</td>
                        <td>' . e($escrow->ListingAgent) . '</td>
                        <td>' . e($escrow->SellingAgent) . '</td>
                        <td>' . e($escrow->BuyerAttorney) . '</td>
                        <td>' . e($escrow->SellerAttorney) . '</td>
                        <td>' . e($escrow->RealEstateInc) . '</td>
                        <td>' . e($escrow->DepositCheckNumber) . '</td>
                        <td>' . e($escrow->BankDraw) . '</td>
                        <td>' . (!empty($escrow->DateDeposited) ? date("d/m/Y", strtotime($escrow->DateDeposited)) : "") . '</td>
                        <td>$' . e($escrow->CheckAmt) . '</td>
                        <td>' . (!empty($escrow->CheckReturned) ? date("d/m/Y", strtotime($escrow->CheckReturned)) : "") . '</td>
                        <td>' . e($escrow->CheckEBBReturnNumber) . '</td>
                        <td>' . e($escrow->CheckReturnedTo) . '</td>
                        <td>' . e($escrow->ReturneeRelationship) . '</td>
                    </tr>';
                }

                $html .= '</tbody></table>';
            }
        } else {
            $html .= '<div class="no-results">No results found for the given filters.</div>';
        }

        // Generate PDF
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
