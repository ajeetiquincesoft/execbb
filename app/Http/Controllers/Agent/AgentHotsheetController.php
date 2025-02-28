<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Offer;
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;
use Dompdf\Options;

class AgentHotsheetController extends Controller
{
    public function index()
    {
        // Fetch the offers from the database
        $offers = DB::table('offers')
            ->join('listings', 'offers.ListingID', '=', 'listings.ListingID')
            ->join('buyers', 'offers.BuyerID', '=', 'buyers.BuyerID')
            ->join('agents', 'offers.ListingAgent', '=', 'agents.AgentID')
            ->whereIn('offers.Status', ['Pending', 'Accepted'])  // Fetching both statuses
            ->select('offers.*', 'listings.SellerCorpName as SellerCorpName', 'buyers.FName as BuyerFName', 'buyers.LName as BuyerLName', 'agents.AgentUserRegisterId as AgentUserRegisterId')
            ->get();

        // Create HTML content for the PDF
        $html = '<div class="hotsheet-content">';
        $html .= '<h1 style="font-size: 18px; text-align: center;">Executive Business Brokers</h1>';
        $html .= '<p class="sub-heading" style="font-size: 14px; text-align: center;">Hot Sheet Offers</p>';
        $html .= '<span class="mb-2" style="font-size: 12px; display: block; text-align: center;">As of: ' . \Carbon\Carbon::now()->format('m/d/Y') . '</span>';
        $html .= '</div>';

        $html .= '<table border="1" cellpadding="5" cellspacing="0" style="width: 100%; border-collapse: collapse;">';
        $html .= '<thead>';
        $html .= '<tr style="height: 40px;">';
        $html .= '<th style="width: 7%; text-align: center; font-size: 12px; font-weight: bold;">Date of Offer</th>';
        $html .= '<th style="width: 5%; text-align: center; font-size: 12px; font-weight: bold;">No Show</th>';
        $html .= '<th style="width: 15%; text-align: center; font-size: 12px; font-weight: bold;">Business Name</th>';
        $html .= '<th style="width: 7%; text-align: center; font-size: 12px; font-weight: bold;">ID #</th>';
        $html .= '<th style="width: 7%; text-align: center; font-size: 12px; font-weight: bold;">L.Agent</th>';
        $html .= '<th style="width: 7%; text-align: center; font-size: 12px; font-weight: bold;">S.Agent</th>';
        $html .= '<th style="width: 10%; text-align: center; font-size: 12px; font-weight: bold;">Buyer Name/ID</th>';
        $html .= '<th style="width: 8%; text-align: center; font-size: 12px; font-weight: bold;">Price</th>';
        $html .= '<th style="width: 8%; text-align: center; font-size: 12px; font-weight: bold;">Down Pay</th>';
        $html .= '<th style="width: 7%; text-align: center; font-size: 12px; font-weight: bold;">Accepted</th>';
        $html .= '<th style="width: 7%; text-align: center; font-size: 12px; font-weight: bold;">Under Contract</th>';
        $html .= '<th style="width: 7%; text-align: center; font-size: 12px; font-weight: bold;">Check Deposited</th>';
        $html .= '<th style="width: 7%; text-align: center; font-size: 12px; font-weight: bold;">Offer #</th>';
        $html .= '<th style="width: 7%; text-align: center; font-size: 12px; font-weight: bold;">Closing Date</th>';
        $html .= '<th style="width: 10%; text-align: center; font-size: 12px; font-weight: bold;">Closing Place</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';

        // Loop through each offer and display it in the table
        foreach ($offers as $offer) {
            $html .= '<tr>';
            $html .= '<td style="text-align: center; font-size: 10px;">' . $offer->DateOfOffer . '</td>';
            $html .= '<td style="text-align: center; font-size: 10px;">' . ($offer->Status == 'Accepted' ? '✓' : '') . '</td>';
            $html .= '<td style="text-align: left; font-size: 10px;">' . $offer->SellerCorpName . '</td>';
            $html .= '<td style="text-align: center; font-size: 10px;">' . $offer->AgentUserRegisterId . '</td>';
            $html .= '<td style="text-align: center; font-size: 10px;">' . $offer->ListingAgent . '</td>';
            $html .= '<td style="text-align: center; font-size: 10px;">' . $offer->SellingAgent . '</td>';
            $html .= '<td style="text-align: left; font-size: 10px;">' . $offer->BuyerFName . ' ' . $offer->BuyerLName . ' ' . $offer->BuyerID . '</td>';
            $html .= '<td style="text-align: right; font-size: 10px;">' . $offer->PurchasePrice . '</td>';
            $html .= '<td style="text-align: right; font-size: 10px;">' . $offer->DownPaymnt . '</td>';
            $html .= '<td style="text-align: center; font-size: 10px;">' . ($offer->Status == 'Accepted' ? 'Yes' : '') . '</td>';
            $html .= '<td style="text-align: center; font-size: 10px;">No</td>';
            $html .= '<td style="text-align: center; font-size: 10px;">' . $offer->DepositCheckNumber . '</td>';
            $html .= '<td style="text-align: center; font-size: 10px;">' . $offer->OfferID . '</td>';
            $html .= '<td style="text-align: center; font-size: 10px;">' . $offer->SchedCloseDate . '</td>';
            $html .= '<td style="text-align: left; font-size: 10px;">' . $offer->SchedClosePlace . '</td>';
            $html .= '</tr>';
        }

        $html .= '</tbody>';
        $html .= '</table>';

        // Create PDF options
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('isHtml5ParserEnabled', true); // Ensure modern HTML5 features are supported

        $dompdf = new Dompdf($options);

        // Load HTML content
        $dompdf->loadHtml($html);

        // Set paper size (optional)
        $dompdf->setPaper('A4', 'landscape'); // Changed to landscape to fit the data better

        // Render PDF (first pass, no streaming)
        $dompdf->render();

        // Stream the generated PDF (force download)
        return $dompdf->stream('hotsheet-offers.pdf');
    }
}
