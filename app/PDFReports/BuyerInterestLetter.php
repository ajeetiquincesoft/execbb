<?php

namespace App\PDFReports;

use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BuyerInterestLetter
{
    public function generate(Request $request)
    {
        // Example dynamic variables
        $date = date('n/j/Y');
        if (isset($request->buyer_id)) {
            $getBuyer = DB::table('buyers')->where('BuyerID', $request->buyer_id)->first();
        }
        $name = $getBuyer->FName . ' ' . $getBuyer->LName;
        $address1 = $getBuyer->Address1;
        $address2 = $getBuyer->Address2;

        $html = '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Business Letter</title>
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
            ' . $getBuyer->City . ' ' . $getBuyer->State . ' ' . $getBuyer->Zip . '<br>
            ' . $address2 . '
        </div>

        <p>Dear ' . $name . ',</p>

        <div class="content">
            <p>Thank you for calling Executive Business Brokers. To better serve you, we have recently installed a database that matches the businesses being offered with prospective buyers such as yourself.</p>

            <p>Attached please find a list of businesses currently being offered that best reflects the information you have previously provided. If you feel this list doesn\'t reflect your interests, please take a couple minutes of your time to fill out the information request form and we will send you a more appropriate list.</p>
        </div>

        <p>Very Truly Yours,</p>

        <div class="signature">
            Executive Business Brokers,<br>
            Commercial Associate,<br>
            Executive Business Brokers
        </div>

        </body>
        </html>
        ';
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
