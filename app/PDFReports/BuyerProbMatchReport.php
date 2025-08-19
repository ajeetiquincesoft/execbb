<?php

namespace App\PDFReports;

use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BuyerProbMatchReport
{
    public function generate(Request $request)
    {
        //dd($request);
        $from = $request->from_date;
        $to = $request->to_date;
        $html = '';
         if(isset($request->buyer_id)){
            $singleBuyer = DB::table('buyers')
            ->when($request->buyer_id, fn($q) => $q->where('BuyerID', $request->buyer_id))
            ->whereBetween('created_at', [$from, $to])
            ->first();
            if ($singleBuyer) {
             $BusType1 = DB::table('sub_categories')
            ->where('SubCatID', $singleBuyer->BusType1)
            ->first();  
            $BusType2 = DB::table('sub_categories')
            ->where('SubCatID', $singleBuyer->BusType2)
            ->first();
            $BusType3 = DB::table('sub_categories')
            ->where('SubCatID', $singleBuyer->BusType3)
            ->first();
            $BusType4 = DB::table('sub_categories')
            ->where('SubCatID', $singleBuyer->BusType4)
            ->first();
            $html .= '<style> 
             * {
                font-family: Arial, sans-serif;
                font-size: 10px;
            }
            h2, h3 {
            margin: 0;
            padding: 0;
        }
        .header {
            text-align: left;
            margin-bottom: 20px;
        }
        .header-left {
            float: left;
            width: 50%;
        }
        .header-right {
            float: right;
            width: 50%;
            text-align: right;
        }
        .clearfix {
            clear: both;
        }
        .section {
            margin-bottom: 15px;
        }
        .section p {
            margin: 4px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 6px;
            text-align: center;
        }
        th {
            background: #f2f2f2;
        }
            .no-border, 
        .no-border th, 
        .no-border td {
            border: none !important;
        }
    </style>';
            $html .= '<div class="header">
        <div class="header-left">
            <h2>Executive Business Brokers</h2>
            <p><strong>Probable Matches by Listing</strong></p>
        </div>
        <div class="header-right">
            <p><strong>For:</strong> '.$singleBuyer->BuyerID.' -- '.$singleBuyer->FName.' '.$singleBuyer->LName.'</p>
            <p><strong>Sent On:</strong> ' . now()->format('n/j/Y') . '</p>
        </div>
        <div class="clearfix"></div>
    </div>

    <!-- Report Info -->
    <div class="section">
         <table class="no-border" style="width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 9pt;">
    <tr>
      <td style="padding: 4px 8px;"><strong>Agent Contacted</strong> '.$singleBuyer->AgentID.'</td>
      <td style="padding: 4px 8px;"><strong>Date Rank</strong> ' . (!empty($singleBuyer->BDate) && strtotime($singleBuyer->BDate) ? date('d/m/Y', strtotime($singleBuyer->BDate)) : '') . '</td>
       <td style="padding: 4px 8px;"><strong>Location</strong></td>
        <td style="padding: 4px 8px;"><strong>Interest</strong></td>
    </tr>
    <tr>
      <td style="padding: 4px 8px;"><strong>Home Phone</strong> '.$singleBuyer->HomePhone.'</td>
      <td style="padding: 4px 8px;"><strong>Purchase Price Max</strong> '.$singleBuyer->PPMax.'</td>
      <td style="padding: 4px 8px;"><strong>1st Choice</strong> '.($BusType1->SubCategory ?? '').'</td>
      <td style="padding: 4px 8px;">'.$singleBuyer->BusCounty1.'</td>
    </tr>
    <tr>
      <td style="padding: 4px 8px;"><strong>Bus Phone</strong> '.$singleBuyer->BusPhone.'</td>
      <td style="padding: 4px 8px;"><strong>Down Pmt Max</strong> '.$singleBuyer->DownPmtMax.'</td>
      <td style="padding: 4px 8px;"><strong>2nd Choice</strong> '.($BusType2->SubCategory ?? '').'</td>
      <td style="padding: 4px 8px;">'.$singleBuyer->BusCounty2.'</td>
    </tr>
    <tr>
      <td style="padding: 4px 8px;"><strong>Fax:</strong> '.$singleBuyer->Fax.'</td>
      <td style="padding: 4px 8px;"><strong>Min. Annual Sales</strong></td>
      <td style="padding: 4px 8px;"><strong>3rd Choice</strong> '.($BusType3->SubCategory ?? '').'</td>
      <td style="padding: 4px 8px;">'.$singleBuyer->BusCounty3.'</td>
    </tr>
    <tr>
      <td style="padding: 4px 8px;"><strong>Begin Date</strong> ' . (!empty($singleBuyer->BDate) && strtotime($singleBuyer->BDate) ? date('d/m/Y', strtotime($singleBuyer->BDate)) : '') . '</td>
      <td style="padding: 4px 8px;"><strong>Min. Net Profits</strong> '.$singleBuyer->NetProfMin.'</td>
     <td style="padding: 4px 8px;"><strong>4th Choice</strong> '.($BusType4->SubCategory ?? '').'</td>
      <td style="padding: 4px 8px;">'.$singleBuyer->BusCounty4.'</td>
    </tr>
  </table>
    </div>

    <!-- Data Table -->
    <table>
        <thead>
            <tr>
                <th>List ID</th>
                <th>Agent</th>
                <th>Score</th>
                <th>Bus Sub Cat</th>
                <th>County</th>
                <th>Pur Price</th>
                <th>Down Pay</th>
                <th>RE Inc</th>
                <th>Ann Sales</th>
                <th>Ann Net Profit</th>
                <th>Inv Inc</th>
                <th>Inv not Inc</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="12" style="text-align:center;">No Records Found</td>
            </tr>
        </tbody>
    </table>';
            }else{
                  $html .= '
                  <div style="text-align:center; margin-top:50px; font-size:14pt;">
                      <strong>No results found for the given criteria.</strong>
                  </div>';
            }

         }
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        return $dompdf->output();
    }
}
