<?php

namespace App\PDFReports;

use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ListingExpLetter
{
    public function generate(Request $request)
    {
        // Example dynamic variables
        $date = date('n/j/Y');
        if (isset($request->dba_listing)) {
            $getListing = DB::table('listings')
                ->where('ListingID', $request->dba_listing)
                ->first();
        }
        $name = $getListing->SellerFName . ' ' . $getListing->SellerLName;
        $address1 = $getListing->Address1;
        $address2 = $getListing->Address2;
        $listDate = Carbon::parse($getListing->ListDate)->format('m/d/Y');
        $expDate  = Carbon::parse($getListing->ExpDate)->format('m/d/Y');

        $html = '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Business Expire Letter</title>
            <style>
                body {
                    font-family: sans-serif;
                    font-size: 8pt;
                    line-height: 1.5;
                }
                .date {
                    text-align: right;
                    margin-bottom: 30px;
                }
                .address {
                    margin-bottom: 20px;
                }
                .content {
                    text-align: justify;
                    margin-bottom: 40px;
                }
                .signature {
                    margin-top: 60px;
                }
            </style>
        </head>
        <body>

        <div class="date">' . $date . '</div>

        <div class="address">
            ' . $name . '<br>
            ' . $address1 . '<br>
            ' . $getListing->City . ' ' . $getListing->State . ' ' . $getListing->Zip . '<br>
            ' . $address2 . '
        </div>

        <p><strong>Re:</strong> Listing Agreement Between Igor Greenberg – New Dorp Wine and Liquor<br>
        and Executive Business Brokers</p>

        <p>List Date: ' . $listDate . ' &nbsp;&nbsp;&nbsp;&nbsp; Exp. Date: ' . $expDate . '</p>

        <p>Dear ' . $name . ',</p>

        <div class="content">
            <p>Enclosed, please find a list of prospective purchasers who have been introduced to your business either in person, by fax, by mail, electronically or otherwise. As per our Listing Agreement, please be advised that should any of these enclosed prospective buyers purchase your business directly or indirectly either as a sole proprietor, corporation, partnership, investor, stockholder, lender or otherwise have a financial interest therein, within (12) months of the expiration of our Listing Agreement, Executive Business Brokers will be due its full commission.</p>';

        $html .= "<p>Please be further advised that the enclosed purchasers names may also include nicknames and/or variations of a buyer's legal name as it may appear on a Purchase Contract. Therefore, should your business sell within the (12) months as outlined above, <strong>it is your responsibility to contact this office by certified mail with the names of all parties involved in the purchase</strong>, otherwise Executive Business Brokers reserves the right to exert a claim for commission.</p>

            <p>Thank you for allowing Executive Business Brokers an opportunity to be of service to you. We would like to continue marketing your business for sale. Please call me when you have a chance.</p>

            <p>Very Truly Yours,</p>
        </div>

        <p>Very Truly Yours,</p>";
        $html .= '<p><img src="signature.png" alt="Larry Bodner Signature" style="height:60px;"><br>';
        $html .= '<div class="signature">
            Executive Business Brokers,<br>
            Commercial Associate,<br>
            Executive Business Brokers
        </div>

        </body>
        </html>
        ';
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
