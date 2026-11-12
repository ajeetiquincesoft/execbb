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
        $date = date('n/j/Y');

        // Get listings based on selected DBA or expiration date range
        $query = DB::table('listings')
            ->whereNotNull('ExpDate')
            ->whereDate('ExpDate', '>=', $request->from_date)
            ->whereDate('ExpDate', '<=', $request->to_date);

        // If a particular listing is selected
        if (!empty($request->dba_listing)) {
            $query->where('ListingID', $request->dba_listing);
        }

        $listings = $query->get();

        if ($listings->isEmpty()) {
            return '
                <div style="text-align:center; margin-top:50px; font-size:14pt;">
                    <strong>No records found for the selected listing and date range.</strong>
                </div>
            ';
        }

        $html = '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Business Expiration Letters and Listing Showings</title>

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

                .signature img {
                    height: 60px;
                }
                .showing-page {
                    font-size: 8pt;
                    margin-top:40px !important;
                }

                .showing-header {
                    text-align: center;
                    margin-bottom: 8px;
                    font-size: 8pt;
                }

                .showing-title {
                    font-size: 13pt;
                    font-weight: bold;
                    line-height: 1.2;
                    margin-bottom: 12px;
                }

                .showing-info {
                    margin-bottom: 5px;
                }

                .showing-table {
                    width: 100%;
                    border-collapse: collapse;
                    font-size: 8pt;
                }

                .showing-table th,
                .showing-table td {
                    border: 1px solid #000;
                    padding: 2px 4px;
                    text-align: left;
                }

                .showing-table th {
                    text-align: center;
                    font-weight: bold;
                }

                .showing-footer {
                    text-align: center;
                    margin-top: 5px;
                }
              
            </style>
        </head>
        <body>
        ';
        $signaturePath = public_path('assets/images/signature.jpg');

        $signatureImage = '';

        if (file_exists($signaturePath)) {
            $signatureImage = 'data:image/jpeg;base64,' .
                base64_encode(file_get_contents($signaturePath));
        }
        foreach ($listings as $getListing) {

            // Listing information
            $name = trim(
                ($getListing->SellerFName ?? '') . ' ' .
                    ($getListing->SellerLName ?? '')
            );

            $address1 = $getListing->Address1 ?? '';
            $address2 = $getListing->Address2 ?? '';

            $city = $getListing->City ?? '';
            $state = $getListing->State ?? '';
            $zip = $getListing->Zip ?? '';

            $listDate = !empty($getListing->ListDate)
                ? Carbon::parse($getListing->ListDate)->format('m/d/Y')
                : '';

            $expDate = !empty($getListing->ExpDate)
                ? Carbon::parse($getListing->ExpDate)->format('m/d/Y')
                : '';

            $dba = $getListing->DBA ?? '';
            // Format listing phone number
            $phone = trim((string) ($getListing->Phone ?? ''));

            $digits = preg_replace('/\D/', '', $phone);

            // Remove US country code if present
            if (strlen($digits) === 11 && substr($digits, 0, 1) === '1') {
                $digits = substr($digits, 1);
            }

            // Format 10-digit US phone number
            if (strlen($digits) === 10) {
                $phone = '(' . substr($digits, 0, 3) . ') ' .
                    substr($digits, 3, 3) . '-' .
                    substr($digits, 6, 4);
            }
            // Fetch showings for the current listing only
            $showings = DB::table('showings')
                ->leftJoin(
                    'buyers',
                    'showings.BuyerID',
                    '=',
                    'buyers.user_id'
                )
                ->where('showings.ListingID', $getListing->ListingID)
                ->select(
                    'showings.*',
                    'buyers.FName',
                    'buyers.LName',
                    'buyers.City as BuyerCity',
                    'buyers.State as BuyerState'
                )
                ->orderBy('showings.Date', 'ASC')
                ->get();


            /*
            |--------------------------------------------------------------------------
            | 1. BUSINESS EXPIRATION LETTER
            |--------------------------------------------------------------------------
            */

            $html .= '
            <div class="letter-page">

                <div class="date">' . $date . '</div>

                <div class="address">
                    ' . e($name) . '<br>
                    ' . e($address1) . '<br>
                    ' . e($city) . ' ' . e($state) . ' ' . e($zip) . '<br>
                    ' . e($address2) . '
                </div>

                <p>
                    <strong>Re:</strong>
                    Listing Agreement Between ' . e($name) . '
                    -- ' . e($getListing->ListingID) . '
                    -- ' . e($dba) . '<br>
                    and Executive Business Brokers
                </p>

                <p>
                    List Date: ' . $listDate . '
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    Exp. Date: ' . $expDate . '
                </p>

                <p>Dear ' . e($name) . ',</p>

                <div class="content">

                    <p>
                        Enclosed, please find a list of prospective purchasers who have been introduced to your business either in person, by fax, by mail, electronically or otherwise. As per our Listing Agreement, please be advised that should any of these enclosed prospective buyers purchase your business directly or indirectly either as a sole proprietor, corporation, partnership, investor, stockholder, lender or otherwise have a financial interest therein, within (12) months of the expiration of our Listing Agreement, Executive Business Brokers will be due its full commission.
                    </p>

                    <p>
                        Please be further advised that the enclosed purchasers names may also include nicknames and/or variations of a buyer\'s legal name as it may appear on a Purchase Contract. Therefore, should your business sell within the (12) months as outlined above, <strong>it is your responsibility to contact this office by certified mail with the names of all parties involved in the purchase</strong>, otherwise Executive Business Brokers reserves the right to exert a claim for commission.
                    </p>

                    <p>
                        Thank you for allowing Executive Business Brokers an opportunity to be of service to you. We would like to continue marketing your business for sale. Please call me when you have a chance.
                    </p>

                </div>

                <p>Very Truly Yours,</p>

                <div class="signature">
                    ' . (!empty($signatureImage) ? '
                        <img src="' . $signatureImage . '"
                            style="height:60px; width:auto;"
                            alt="Larry Bodner Signature">
                        <br>
                    ' : '') . '

                    Executive Business Brokers,<br>
                    Commercial Associate,<br>
                    Executive Business Brokers
                </div>

            </div>
            ';


            /*
            |--------------------------------------------------------------------------
            | 2. LISTING SHOWINGS REPORT
            |--------------------------------------------------------------------------
            */
            if ($showings->isNotEmpty()) {
                $html .= '
            <div class="showing-page">

                <div class="showing-header">
                    2583 Morris Ave Union, NJ 07083
                    Phone: (908)851-9040
                    Fax: (908)851-9066
                    Email: sales@execbb.com
                </div>

                <div class="showing-title">
                    Executive Business Brokerage<br>
                    Listings Showings
                </div>

                <div class="showing-info">
                    <strong>DBA:</strong> ' . e($dba) . '

                    &nbsp;&nbsp;&nbsp;&nbsp;

                    <strong>Seller:</strong> ' . e($name) . '

                    &nbsp;&nbsp;&nbsp;&nbsp;

                    <strong>Phone:</strong> ' . e($phone) . '

                    &nbsp;&nbsp;&nbsp;&nbsp;
                </div>

                <table class="showing-table">

                    <thead>
                        <tr>
                            <th width="10%">Date</th>
                            <th width="22%">Buyer</th>
                            <th width="21%">City, State</th>
                            <th width="7%">Agent</th>
                            <th width="8%">Offer</th>
                            <th width="8%">Verbal</th>
                            <th width="24%">Notes</th>
                        </tr>
                    </thead>

                    <tbody>
            ';



                foreach ($showings as $showing) {

                    $buyerName = trim(
                        ($showing->FName ?? '') . ' ' .
                            ($showing->LName ?? '')
                    );

                    $showingDate = !empty($showing->Date)
                        ? Carbon::parse($showing->Date)->format('n/j/Y')
                        : '';

                    $buyerCity = $showing->BuyerCity ?? '';
                    $buyerState = $showing->BuyerState ?? '';

                    $agent = $showing->AgentID ?? '';

                    $offer = ((int) $showing->OfferMade === 1) ? 'Yes' : 'No';
                    $verbal = ((int) $showing->Verbal === 1) ? 'Yes' : 'No';

                    $notes = $showing->Notes ?? '';

                    $html .= '
                        <tr>
                            <td>' . e($showingDate) . '</td>
                            <td>' . e($buyerName) . '</td>
                            <td>' . e(trim($buyerCity . ', ' . $buyerState, ', ')) . '</td>
                            <td>' . e($agent) . '</td>
                            <td>' . e($offer) . '</td>
                            <td>' . e($verbal) . '</td>
                            <td>' . e($notes) . '</td>
                        </tr>
                    ';
                }


                $html .= '
                    </tbody>
                </table>

                <div class="showing-footer">
                    2583 Morris Ave Union, NJ 07083
                    Phone: (908)851-9040
                    Fax: (908)851-9066
                    Email: sales@execbb.com
                </div>

            </div>
            ';
            }


            $html .= '
        </body>
        </html>
        ';
        }

        return $html;
    }
}
