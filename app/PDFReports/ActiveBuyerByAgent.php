<?php

namespace App\PDFReports;

use Dompdf\Dompdf;
use Dompdf\Options;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ActiveBuyerByAgent
{
    public function generate($buyerInfo, $agentInfo)
    {
        $date = now()->format('m/d/Y');
        $html = '<div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
                <div>
                    <strong>Executive Business Brokers</strong><br>
                    <strong>Buyer List</strong><br><br>
                    <strong>Agent</strong>  ' . $agentInfo->FName . ', ' . $agentInfo->LName . '
                </div>
                <div style="text-align: right;">
                    As of: ' . $date . '
                </div>
            </div>';
        foreach ($buyerInfo as $buyerData) {
            $busType1Name = DB::table('sub_categories')
                ->where('SubCatID', $buyerData->BusType1)
                ->value('SubCategory');
            $busType2Name = DB::table('sub_categories')
                ->where('SubCatID', $buyerData->BusType2)
                ->value('SubCategory');
            $busType3Name = DB::table('sub_categories')
                ->where('SubCatID', $buyerData->BusType3)
                ->value('SubCategory');
            $busType4Name = DB::table('sub_categories')
                ->where('SubCatID', $buyerData->BusType4)
                ->value('SubCategory');
            $html .= '<table border="1" cellspacing="0" cellpadding="4" width="100%">
            <tr>
                    <td><strong>ID</strong>: ' . $buyerData->BuyerID . '</td>
                    <td><strong>Date Profiled</strong>: ' . date('m/d/Y', strtotime($buyerData->DateEntered)) . '</td>
                    <td><strong>Signed</strong>: ' . $buyerData->Signed . '</td>
                    <td><strong>Bus Type 1</strong>: ' . $busType1Name . '</td>
                    <td><strong>County 1</strong>: ' . $buyerData->BusCounty1 . '</td>
                    <td><strong>Max Pur. Price</strong>: ' . $buyerData->PPMax . '</td>
                </tr>
                <tr>
                    <td><strong>Name</strong>: ' . $buyerData->FName . ', ' . $buyerData->LName . '</td>
                    <td><strong>Home Phone</strong>: ' . $buyerData->HomePhone . '</td>
                    <td><strong>Interest</strong>: ' . $buyerData->Interest . '</td>
                    <td><strong>Bus Type 2</strong>: ' . $busType2Name . '</td>
                    <td><strong>County 2</strong>: ' . $buyerData->BusCounty2 . '</td>
                    <td><strong>Max Down Pay</strong>: ' . $buyerData->DownPmtMax . '</td>
                </tr>
                <tr>
                    <td><strong>City</strong>: ' . $buyerData->City . '</td>
                    <td><strong>Bus. Phone</strong>: ' . $buyerData->BusPhone . '</td>
                    <td><strong>Location</strong>: ' . $buyerData->Location . '</td>
                    <td><strong>Bus Type 3</strong>: ' . $busType3Name . '</td>
                    <td><strong>County 3</strong>: ' . $buyerData->BusCounty3 . '</td>
                    <td><strong>Min Volume</strong>: ' . $buyerData->VolMin . '</td>
                </tr>
                <tr>
                    <td><strong>State</strong>: ' . $buyerData->State . '</td>
                    <td><strong>Call When</strong>: ' . $buyerData->CallWhen . '</td>
                    <td></td>
                    <td><strong>Bus Type 4</strong>: ' . $busType4Name . '</td>
                    <td><strong>County 4</strong>: ' . $buyerData->BusCounty4 . '</td>
                    <td><strong>Min Net Profit</strong>: ' . $buyerData->NetProfMin . '</td>
                </tr>
            </table><br><br>';
        }

        /*  $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        return $dompdf->output(); */
        return $html;
    }
}
