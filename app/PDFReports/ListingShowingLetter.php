<?php

namespace App\PDFReports;

use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ListingShowingLetter
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

        <p><strong>Re:</strong> Listing Agreement Between ' . $name . ' -- ' . $getListing->ListingID . ' -- ' . $getListing->DBA . '<br>
        and Executive Business Brokers</p>

        <p>List Date: ' . $listDate . '</p>

        <p>Dear ' . $name . ',</p>';

        $html .= '<div class="content">
        <p>Enclosed, please find a list of prospective purchasers who have been introduced to your business thus far either in person, fax, mail electronically or otherwise.  It is my pleasure to continue to assist you in the sale of your business.  Upon expiration of our listing agreement I will send you  a final total accounting of all showings of your business by me and my associates.  I will keep you informed of our progress.  Should you have any questions or comments, please feel free to call.</p>
        <p>Very Truly Yours,</p>
        </div>';
        $html .= '<p><img src="' . asset('assets/images/signature2.jpg') . '" alt="Larry Bodner Signature" style="height:60px;"><br>';
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
