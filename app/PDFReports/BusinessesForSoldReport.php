<?php

namespace App\PDFReports;

use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BusinessesForSoldReport
{
    public function generate(Request $request)
    {
        $from = $request->from_date;
        $to = $request->to_date;

        $listings = DB::table('listings')
            ->when($request->franchise == '1', fn($q) => $q->where('Franchise', 1))
            ->when($request->real_estate_inc == '1', fn($q) => $q->where('RealEstate', 1))
            ->when($request->best_buy == '1', fn($q) => $q->where('BestBuy', 1))
            ->when($request->category, fn($q) => $q->where('BusCategory', $request->category))
            ->when($request->subcategory, fn($q) => $q->where('SubCat', $request->subcategory))
            ->when($request->agent, fn($q) => $q->where('AgentID', $request->agent))
            ->when($request->status, fn($q) => $q->where('Status', $request->status))
            ->where('SoldEBB', 1)
            ->whereBetween('DateEntered', [$from, $to])
            ->get();
        $html = '
        <div style="text-align:center; font-family:sans-serif;">
            <h2 style="margin-bottom: 5px;">Executive Business Brokers</h2>
            <h3 style="margin-top: 0;">Businesses For Sale</h3>
            <p style="margin: 5px 0;">
                As of: <b>' . now()->format('n/j/Y') . '</b><br>
                Number of Listings: <b>' . count($listings) . '</b>
            </p>
        </div>';
        $html .= '
        <table border="1" cellpadding="3" cellspacing="0" style="width:100%; font-size: 10px; font-family: sans-serif; border-collapse: collapse;">
            <thead style="background-color: #F2F2F2; text-align:center;">
                <tr>
                    <th>ID</th>
                    <th>Agent</th>
                    <th>Type</th>
                    <th>Yrs Est.</th>
                    <th>County</th>
                    <th>Pur. Price</th>
                    <th>Down Pay</th>
                    <th>Rev</th>
                    <th>Ann. Sales</th>
                    <th>Ann. Net</th>
                    <th>Inv. In Price</th>
                    <th>Inv. Net</th>
                </tr>
            </thead>
            <tbody>';
        foreach ($listings as $listing) {
            $html .= '<tr style="text-align:center;">';
            $html .= '<td>' . htmlspecialchars($listing->ListingID) . '</td>';
            $html .= '<td>' . htmlspecialchars($listing->AgentID) . '</td>';
            $html .= '<td>' . htmlspecialchars($listing->BusType) . '</td>';
            $html .= '<td>' . htmlspecialchars($listing->YrsEstablished) . '</td>';
            $html .= '<td>' . htmlspecialchars($listing->County) . '</td>';
            $html .= '<td>$' . number_format($listing->PurPrice, 0) . '</td>';
            $html .= '<td>$' . number_format($listing->DownPay, 0) . '</td>';
            $html .= '<td>$' . number_format($listing->REAskingPrice, 0) . '</td>';
            $html .= '<td>$' . number_format($listing->AnnualSales, 0) . '</td>';
            $html .= '<td>$' . number_format($listing->AnnualNetProfit, 0) . '</td>';
            $html .= '<td>$' . number_format($listing->InvInPrice, 0) . '</td>';
            $html .= '<td>$' . number_format($listing->InvNot, 0) . '</td>';
            $html .= '</tr>';
        }
        $html .= '</tbody></table>';
        /*  $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        return $dompdf->output(); */
        return $html;
    }
}
