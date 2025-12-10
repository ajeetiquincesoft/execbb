<?php

namespace App\PDFReports;

use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BuyerInfoReports
{
  public function generate(Request $request)
  {
    //dd($request);
    $from = $request->from_date;
    $to = $request->to_date;
    $html = '';
    if (isset($request->buyer_id)) {
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
        $html .= '<div style="display: flex; justify-content: space-between; align-items: center;">
    <h2 style="text-align: center; text-decoration: underline; margin: 0;">Buyer Information</h2>
    <div style="text-align: right;">As Of: ' . now()->format('n/j/Y') . '</div>
  </div>
  <table style="width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 9pt;">
    <tr>
      <td style="padding: 4px 8px;"><strong>Buyer ID:</strong> ' . $singleBuyer->BuyerID . '</td>
      <td style="padding: 4px 8px;"><strong>Date:</strong> ' . (!empty($singleBuyer->BDate) && strtotime($singleBuyer->BDate) ? date('d/m/Y', strtotime($singleBuyer->BDate)) : '') . '</td>
      <td style="padding: 4px 8px;"><strong>Active:</strong> ' . (($singleBuyer->Active == 1) ? 'Yes' : 'No') . '</td>
    </tr>
    <tr>
      <td style="padding: 4px 8px;"><strong>Name:</strong> ' . $singleBuyer->FName . ', ' . $singleBuyer->LName . '</td>
      <td style="padding: 4px 8px;"><strong>Agent:</strong> ' . $singleBuyer->AgentID . '</td>
      <td style="padding: 4px 8px;"></td>
    </tr>
    <tr>
      <td style="padding: 4px 8px;"><strong>Nick Name:</strong> ' . $singleBuyer->NName . '</td>
      <td colspan="2" style="padding: 4px 8px;"><strong>Address:</strong> ' . $singleBuyer->Address1 . ', ' . $singleBuyer->City . ', ' . $singleBuyer->State . ' ' . $singleBuyer->Zip . '</td>
    </tr>
    <tr>
      <td style="padding: 4px 8px;"><strong>County:</strong> ' . $singleBuyer->County . '</td>
      <td style="padding: 4px 8px;"><strong>Signed:</strong>  ' . $singleBuyer->Signed . '</td>
    </tr>
    <tr>
      <td style="padding: 4px 8px;"><strong>Current Employment:</strong> ' . $singleBuyer->CurrentEmploy . '</td>
      <td colspan="2" style="padding: 4px 8px;"><strong>Bus Phone:</strong> ' . $singleBuyer->BusPhone . '</td>
    </tr>
    <tr>
      <td style="padding: 4px 8px;"><strong>Home Phone:</strong> ' . $singleBuyer->HomePhone . '</td>
      <td style="padding: 4px 8px;"><strong>Fax:</strong> ' . $singleBuyer->Fax . '</td>
      <td style="padding: 4px 8px;"><strong>Pager/Cell:</strong> ' . $singleBuyer->Pager . '</td>
    </tr>
    <tr>
      <td style="padding: 4px 8px;"><strong>Partner Name:</strong> ' . $singleBuyer->PartnerName . '</td>
      <td colspan="2" style="padding: 4px 8px;"><strong>Email:</strong> ' . $singleBuyer->Email . '</td>
    </tr>
    <tr>
      <td style="padding: 4px 8px;"><strong>Drivers License:</strong> ' . $singleBuyer->DLNo . '</td>
      <td colspan="2" style="padding: 4px 8px;"><strong>Social Security:</strong> ' . $singleBuyer->SocSecNo . '</td>
    </tr>
    <tr>
      <td style="padding: 4px 8px;"><strong>Best Time to Call:</strong> ' . $singleBuyer->CallWhen . '</td>
      <td colspan="2" style="padding: 4px 8px;"></td>
    </tr>
  </table>

  <div style="border: 1px solid black; padding: 8px; margin-top: 20px; font-size: 9pt;">
    <strong>Desired Business:</strong><br>
    1st Choice: ' . ($BusType1->SubCategory ?? '') . '<br>
    2nd Choice: ' . ($BusType2->SubCategory ?? '') . '<br>
    3rd Choice: ' . ($BusType3->SubCategory ?? '') . '<br>
    4th Choice: ' . ($BusType4->SubCategory ?? '') . '
  </div>

  <div style="border: 1px solid black; padding: 8px; margin-top: 20px; font-size: 9pt;">
    <strong>Desired Location:</strong><br>
    City:<br>
    1st Choice: ' . $singleBuyer->BusCounty1 . '<br>
    2nd Choice: ' . $singleBuyer->BusCounty2 . '<br>
    3rd Choice: ' . $singleBuyer->BusCounty3 . '<br>
    4th Choice: ' . $singleBuyer->BusCounty4 . '
  </div>

  <div style="border: 1px solid black; padding: 8px; margin-top: 20px; font-size: 9pt;">
    <strong>Desired Pricing and Income:</strong>
    <table style="width: 100%; margin-top: 10px;">
      <tr>
        <td style="padding: 4px 8px;"><strong>Purchase Price Minimum:</strong> $' . ($singleBuyer->PPMin ?? '0.00') . '</td>
        <td style="padding: 4px 8px;"><strong>Purchase Price Maximum:</strong> $' . ($singleBuyer->PPMax ?? '0.00') . '</td>
      </tr>
      <tr>
        <td style="padding: 4px 8px;"><strong>Down Payment Minimum:</strong> $' . ($singleBuyer->DownPmtMin ?? '0.00') . '</td>
        <td style="padding: 4px 8px;"><strong>Down Payment Maximum:</strong> $' . ($singleBuyer->DownPmtMax ?? '0.00') . '</td>
      </tr>
      <tr>
        <td style="padding: 4px 8px;"><strong>Annual Sales Minimum:</strong> $0.00</td>
        <td style="padding: 4px 8px;"><strong>Annual Sales Maximum:</strong> $0.00</td>
      </tr>
      <tr>
        <td style="padding: 4px 8px;"><strong>Net Profit Minimum:</strong> $' . ($singleBuyer->NetProfMin ?? '0.00') . '</td>
        <td style="padding: 4px 8px;"><strong>Net Profit Maximum:</strong> $' . ($singleBuyer->NetProfMax ?? '0.00') . '</td>
      </tr>
    </table>
  </div>

  <div style="padding: 8px; margin-top: 20px; font-size: 9pt;">
    <strong>Comments:</strong><br>
    <div>' . $singleBuyer->Comments . '</div>
  </div>';
      } else {
        $html .= '
                  <div style="text-align:center; margin-top:50px; font-size:14pt;">
                      <strong>No results found for the given criteria.</strong>
                  </div>';
      }
    }
    $html .= '</tbody></table>';
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
