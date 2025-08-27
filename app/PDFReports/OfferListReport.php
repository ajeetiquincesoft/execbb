<?php

namespace App\PDFReports;

use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OfferListReport
{
    public function generate(Request $request)
    {
        //dd($request);
        $from = $request->from_date;
        $to = $request->to_date;
        $html = '';
           $offers = DB::table('offers')
           ->leftJoin('listings', 'offers.ListingID', '=', 'listings.ListingID')
            ->when($request->buyer_id, function ($q) use ($request) {
                $q->where('offers.BuyerID', $request->buyer_id);
            })
            ->when($request->agent, function ($q) use ($request) {
                $q->where('offers.ListingAgent', $request->agent);
            })
            ->when($request->dba_listing, function ($q) use ($request) {
                $q->where('listings.DBA', $request->dba_listing);
            })
             ->when($request->offer_status, function ($q) use ($request) {
                $q->where('offers.Status', $request->offer_status);
            })
            ->whereBetween('offers.created_at', [$from, $to])
             ->select('offers.*', 'listings.DBA')
            ->limit(100)
            ->get();
            if ($offers) {
            $html .= '<style>
                *{
                    font-family: Arial, sans-serif;
                    font-size: 8pt;
                }
               .outer {
                    display: table;
                    width: 100%;
                    border: 1px solid #000;
                    border-collapse: collapse;
                    margin-bottom: 0px;
                }
                .outer > div {
                    display: table-cell;
                    vertical-align: top;
                    padding: 8px 0px;
                    border-right: 1px solid #000;
                }
                .outer > div:last-child {
                    border-right: none;
                    width: 66.68%;
                }
                .outer > div:nth-child(1),
                .outer > div:nth-child(2) {
                    width: 16.66%;
                }

                .outer > div {
                border-right: 1px solid #000;
                padding: 8px 0px;
            }

            /* Nested counter offer section: 4 columns */
            .offer_inner {
                display: table;
                width: 100%;
                table-layout: fixed;
                border-collapse: collapse;
            }
            .offer_inner > div {
                display: table-cell;
                width: 25%; /* 4 equal columns */
                padding: 0px 0px;
                vertical-align: top;
                /* border-right: 1px solid #000; */
            }
                .offer_inner_heade > div {
                border-right: 1px solid #000;
            }
            .offer_inner > div:last-child {
                border-right: none;
            }
            .offer_inner_heade {
                border-bottom: 1px solid #000;
            }

            /* Second row: 6 columns */
            .row2 {
                display: table;
                width: 100%;
                border-left: 1px solid #000;
                border-right: 1px solid #000;
                border-bottom: 1px solid #000;
                table-layout: fixed;
                border-collapse: collapse;
            }
            .row2 > div {
                display: table-cell;
                width: 16.66%; /* 6 equal columns */
                padding: 8px;
                vertical-align: top;
            }
            .row2 > div:last-child {
                border-right: none;
            }

                span.label {
                    font-weight: bold;
                    color: #333;
                    display: inline-block;
                    min-width: 80px;
                }
               .header {
                    width: 100%;
                    margin-bottom: 20px;
                }
                .header-left {
                    float: left;
                    text-align: left;
                }
                .header-right {
                    float: right;
                    text-align: right;
                }
                .clearfix {
                    clear: both;
                }
                .offer_container {
                    margin-bottom: 20px;
                }
               .offer_info {
                    display: inline-block;
                    margin-bottom: 6px;
                    font-size: 0; 
                }

                .offer_info > div {
                    display: inline-block;
                    font-size: 14px;
                    margin-right: 15px; 
                    vertical-align: middle;
                }

                .offer_dba {
                    font-size: 14px !important; 
                    font-weight: bold;
                }
                .offer_dba a {
                    text-decoration: none;
                    font-size: 14px !important; 
                    }
            </style>';
                $html .= '<div class="header">
                    <div class="header-left">
                        <h2>Executive Business Brokers</h2>
                        <p><strong>Offers List</strong></p>
                    </div>
                    <div class="header-right">
                        <p><strong>As Of:</strong> ' . now()->format('n/j/Y') . '</p>
                    </div>
                    <div class="clearfix"></div>
                </div>';
            foreach($offers as $offer)
            {
                $listAgent = DB::table('agents')->where('AgentID',$offer->ListingAgent)->first();
                $BuyerInfo = DB::table('buyers')->where('BuyerID',$offer->BuyerID)->first();
                $DBAInfo = DB::table('listings')->where('ListingID',$offer->ListingID)->first();
                $html .='<div class="offer_container">
                <div class="offer_info">
                    <div class="offer_id">'.$offer->OfferID.'</div>
                    <div class="offer_dba"><a href="#">'.($DBAInfo->DBA ?? '').'</a></div>
                </div>
                <div class="outer">
                    <div>
                    <span class="label">List Agent</span> '. $offer->ListingAgent .'<br>
                        <span class="label">Seller</span> <br>
                        <span class="label">Home</span> <br>
                        <span class="label">Bus</span><br>
                    </div>

                    <div>
                    <span class="label">Buy Agent</span> '. ($BuyerInfo->AgentID ?? '') .'<br>
                    <span class="label">Buyer</span> '. ($BuyerInfo->LName ?? '') .' '. ($BuyerInfo->FName ?? '').'<br>
                    <span class="label">Home</span> '. ($BuyerInfo->HomePhone ?? '') .'<br>
                    <span class="label">Bus</span>'. ($BuyerInfo->BusPhone ?? '') .'<br>
                    </div>

                    <div>
                        <div class="offer_inner offer_inner_heade">
                            <div><strong>Offer Info</strong></div>
                            <div><strong>Counter Offer Info</strong></div>
                            <div><strong>Real State</strong></div>
                            <div><strong>Option to Buy</strong></div>
                        </div>
                        <div class="offer_inner offer_inner_content">
                        <div><br>
                        <span class="label">Price</span> $'.$offer->OfferPrice.'<br>
                        <span class="label">Down Pay</span> $'.$offer->OffDownPay.'
                        </div>
                        <div><br>
                        <span class="label">Price</span> $'.$offer->COfferPrice.'<br>
                        <span class="label">Down Pay</span> $'.$offer->COffDownPay.'
                        </div>
                        <div>
                        <span class="label">RE Inc</span> '.$offer->RealEstateInc.'<br>
                        <span class="label">Price</span> $'.$offer->REPrice.'<br>
                        <span class="label">Down Pay</span> $'.$offer->REDownPay.'
                        </div>
                        <div>
                        <span class="label">Op To Buy</span> '.$offer->OpToBuy.'<br>
                        <span class="label">Price</span> $'.$offer->OpPrice.'<br>
                        <span class="label">Down Pay</span> $'.$offer->OpDownPay.'
                        </div>
                        </div>
                    </div>
                </div>

                <!-- Second row -->
                <div class="row2">
                <div><strong>Status</strong> '.$offer->Status.'</div>
                <div><strong>Comm</strong> $'.$offer->Commission.'</div>
                <div><strong>Offer Date</strong>'.(!empty($offer->DateOfOffer) && strtotime($offer->DateOfOffer) ? date('d/m/Y', strtotime($offer->DateOfOffer)) : '').'</div>
                <div><strong>Exp Date</strong> '.(!empty($offer->ExpDate) && strtotime($offer->ExpDate) ? date('d/m/Y', strtotime($offer->ExpDate)) : '').'</div>
                <div><strong>Acc Date</strong> '.(!empty($offer->AccDate) && strtotime($offer->AccDate) ? date('d/m/Y', strtotime($offer->AccDate)) : '').'</div>
                <div><strong>Close Date</strong> '. (!empty($offer->CloseDate) && strtotime($offer->CloseDate) ? date('d/m/Y', strtotime($offer->CloseDate)) : '') .'</div>
                </div></div>';
            }
            
        }else{
            $html .= '
                <div style="text-align:center; margin-top:50px; font-size:14pt;">
                    <strong>No results found for the given filters.</strong>
                </div>';
}
        
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
