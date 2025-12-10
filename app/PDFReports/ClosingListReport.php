<?php

namespace App\PDFReports;

use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ClosingListReport
{
    public function generate(Request $request)
    {
        $from = $request->from_date;
        $to = $request->to_date;
        // Base query
        $query = DB::table('offers');

        // Filters
        if ($request->buyer_id && $request->buyer_id != 'all') {
            $query->where('BuyerID', $request->buyer_id);
        }
        if ($request->dba_listing) {
            $query->where('ListingID', $request->dba_listing);
        }
        if ($request->agent) {
            $query->where(function ($q) use ($request) {
                $q->where('ListingAgent', $request->agent)
                    ->orWhere('SellingAgent', $request->agent);
            });
        }
        // Run query
        $closings = $query->whereNotNull('ClosingDate')->whereBetween('ClosingDate', [$from, $to])
            ->get();
        $html = '<style>
        body {
                font-family: Arial, sans-serif;
                font-size: 10pt;
            }
                .header {
            text-align: left;
            font-weight: bold;
            font-size: 14pt;
        }
        .sub-header {
            text-align: right;
            font-size: 10pt;
            margin-top: -20px;
        }
        .section-title {
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 10px;
        }
        .info-table {
            width: 100%;
            border: 1px solid #000;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .info-table th, 
        .info-table td {
            border: 1px solid #000;
            padding: 5px;
            vertical-align: top;
             width: 50%;
        }
        .info-table th {
            text-align: left;
            background: #f2f2f2;
        }
        .two-col {
            display: flex;
            justify-content: space-between;
            margin-top: 5px;
        }
        .col {
            width: 48%;
        }
        .label {
            font-weight: bold;
        }
              .no-results {
            text-align: center; 
            margin-top: 50px; 
            font-size: 12pt;
            font-weight: bold;
        }
            .header-container
            {
                padding-bottom: 20px
            }
            </style>';


        // Header
        $html .= '
        <div class="header-container">
            <div class="header">Executive Business Brokers</div>
            <div class="header">Closing Information</div>
            
            <div class="sub-header">As of: ' . now()->format('n/j/Y') . '</div>
        </div>';
        // If results
        if ($closings->count() > 0) {
            foreach ($closings as $closing) {
                $buyerInfo = DB::table('buyers')->where('BuyerID', $closing->BuyerID)->first();

                $html .= '<table class="info-table">
                            <tr>
                            <th>Buyer</th>
                            <th>Seller</th>
                            </tr>
                            <tr>
                                <td>
                                    <div><b>Name:</b> ' . e($buyerInfo->LName ?? '') . ' ' . e($buyerInfo->FName ?? '') . '</div>
                                    <div><b>Attorney:</b> ' . e($closing->BuyerAttorney) . '</div>
                                    <div><b>Address:</b> ' . e($buyerInfo->Address1 ?? '') . '</div>
                                    <div><b>City:</b> ' . e($buyerInfo->City ?? '') . ', ' . e($buyerInfo->State ?? '') . ' ' . e($buyerInfo->Zip ?? '') . '</div>
                                    <div><b>Phone:</b> ' . e($buyerInfo->HomePhone ?? '') . ' &nbsp;&nbsp; <b>Fax:</b> ' . e($buyerInfo->Fax ?? '') . '</div>
                                    <div><b>Selling Agent:</b> ' . e($closing->SellingAgent) . '</div>

                                    <br><b>Accountant</b><br>
                                    Address, City, Phone, Fax

                                    <br><br><b>Landlord</b><br>
                                    Address, City, Phone, Fax, Rep
                                </td>
                                <td>
                                    <div><b>Name:</b></div>
                                    <div><b>Attorney:</b> </div>
                                    <div><b>Address:</b> </div>
                                    <div><b>City:</b> </div>
                                    <div><b>Phone:</b> &nbsp;&nbsp; <b>Fax:</b></div>
                                    <div><b>Listing Agent:</b> ' . e($closing->ListingAgent) . '</div>

                                    <br><b>Accountant</b><br>
                                    Address, City, Phone, Fax

                                    <br><br><b>Referrer</b><br>
                                    Address, City, Phone, Fax
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Commission %:</b> ' . e($closing->CommissionPct) . '<br>
                                    <b>Commission Amt:</b> $' . e($closing->Commission ?? '0.00') . '<br>
                                    <b>Purchase Price:</b> $' . e($closing->PurchasePrice) . '<br>
                                    <b>Down Payment:</b> $' . e($closing->DownPaymnt) . '<br>
                                    <b>Balance Due:</b> $' . e($closing->BalanceDue) . '
                                </td>
                                <td>
                                    <b>Closing Date:</b> ' . (!empty($closing->ClosingDate) ? date("d/m/Y", strtotime($closing->ClosingDate)) : "") . '<br>
                                    <b>Comments:</b>' . e($closing->Comments) . '
                                </td>
                            </tr>
                    </table>';
            }
        } else {
            $html .= '<div class="no-results">No results found for the given filters.</div>';
        }

        // Generate PDF
        /* $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        return $dompdf->output(); */
        return $html;
    }
}
