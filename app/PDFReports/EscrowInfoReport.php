<?php

namespace App\PDFReports;

use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EscrowInfoReport
{
    public function generate(Request $request)
    {
        // Base query
        $query = DB::table('offers');

        // Filters
        if ($request->buyer_id && $request->buyer_id !='all') {
            $query->where('BuyerID', $request->buyer_id);
        }else {
            // Get last offer buyer_id
            $lastBuyerId = DB::table('offers')->latest('OfferID')->value('BuyerID');

            if ($lastBuyerId) {
                $query->where('BuyerID', $lastBuyerId);
            }
        }

        // Run query
        $escrow = $query->first();
        $html ='<style>
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
        <div class="report-title">Escrows Info Report</div>';

        // If results
        if ($escrow) {
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
