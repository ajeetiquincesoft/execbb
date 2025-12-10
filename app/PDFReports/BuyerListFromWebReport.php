<?php

namespace App\PDFReports;

use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BuyerListFromWebReport
{
  public function generate(Request $request)
  {
    //dd($request);
    $from = $request->from_date;
    $to = $request->to_date;
    $html = '';
    if (isset($request->buyer_id) && ($request->buyer_id != 'all')) {
      $singleBuyer = DB::table('buyers')
        ->when($request->buyer_id, function ($q) use ($request) {
          $q->where('BuyerID', $request->buyer_id);
        })
        ->when($request->subcategory, function ($q) use ($request) {
          $q->where(function ($sub) use ($request) {
            $sub->where('BusType1', $request->subcategory)
              ->orWhere('BusType2', $request->subcategory)
              ->orWhere('BusType3', $request->subcategory)
              ->orWhere('BusType4', $request->subcategory);
          });
        })
        ->when($request->buyer_status, function ($q) use ($request) {
          $q->where('Interest', $request->buyer_status);
        })
        ->when($request->location, function ($q) use ($request) {
          $q->where('County', $request->location);
        })
        ->where('Signed', 3)
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
    } else {
      $buyers = DB::table('buyers')
        ->when($request->agent, fn($q) => $q->where('AgentID', $request->agent))
        ->when($request->buyer_status, fn($q) => $q->where('Interest', $request->buyer_status))
        ->when($request->location, fn($q) => $q->where('County', $request->location))
        ->whereBetween('DateEntered', [$from, $to])
        ->get();
      if ($buyers->isNotEmpty()) {
        $html .= '
        <div style="text-align:center; font-family:sans-serif;">
            <h2 style="margin-bottom: 5px;">Executive Business Brokers</h2>
            <h3 style="margin-top: 0;">Buyer List</h3>
            <p style="margin: 5px 0;">
                As of: <b>' . now()->format('n/j/Y') . '</b><br>
            </p>
        </div>';
        $html .= '<table style="width: 850px; border-collapse: collapse; font-family: Arial; font-size: 9pt;" cellspacing="0" cellpadding="4">
         <tbody>';
        foreach ($buyers as $buyer) {
          $BusType1 = DB::table('sub_categories')
            ->where('SubCatID', $buyer->BusType1)
            ->first();
          $BusType2 = DB::table('sub_categories')
            ->where('SubCatID', $buyer->BusType2)
            ->first();
          $BusType3 = DB::table('sub_categories')
            ->where('SubCatID', $buyer->BusType3)
            ->first();
          $BusType4 = DB::table('sub_categories')
            ->where('SubCatID', $buyer->BusType4)
            ->first();
          $interestMap = [
            1 => 'Hot',
            2 => 'Medium',
            3 => 'Cool'
          ];

          $interestLabel = $interestMap[$buyer->Interest] ?? 'n/a';
          $html .= '<tr>
            <td font-weight: bold;">' . $buyer->BuyerID . ' - ' . $buyer->AgentID . '</td>
            <td style="text-align: right; font-weight: bold; border: 1px solid #000;">H</td>
            <td style="border: 1px solid #000;">' . $buyer->HomePhone . '</td>
            <td style="text-align: center; font-weight: bold; border: 1px solid #000;">Pur Price</td>
            <td style="border: 1px solid #000;">$' . ($buyer->Price ?? '0') . '</td>
            <td style="text-align: center; font-weight: bold;border: 1px solid #000;">Bus Interest</td>
            <td style="font-weight: bold; border: 1px solid #000;">Location</td>
        </tr>
        <tr>
            <td>' . $buyer->FName . ' ' . $buyer->LName . '</td>
            <td style="text-align: right; font-weight: bold; border: 1px solid #000;">B</td>
            <td style="border: 1px solid #000;">' . $buyer->BusPhone . '</td>
            <td style="text-align: right; font-weight: bold; border: 1px solid #000;">DP</td>
            <td style="border: 1px solid #000;">$' . ($buyer->DownPay ?? '0') . '</td>
            <td style="border: 1px solid #000;">' . ($BusType1->SubCategory ?? '') . '</td>
            <td style="border: 1px solid #000;">' . $buyer->BusCounty1 . '</td>
        </tr>
        <tr>
            <td>' . $buyer->City . ', ' . $buyer->City . '</td>
            <td style="text-align: right; font-weight: bold; border: 1px solid #000;">Bus Loc</td>
            <td style="border: 1px solid #000;">' . $buyer->BusLocation . '</td>
            <td style="text-align: right; font-weight: bold; border: 1px solid #000;">Sales</td>
            <td style="border: 1px solid #000;">$' . ($BusType2->SalesVol ?? '0') . '</td>
            <td style="border: 1px solid #000;">' . ($BusType2->SubCategory ?? '') . '</td>
            <td style="border: 1px solid #000;">' . $buyer->BusCounty2 . '</td>
        </tr>
        <tr>
            <td></td>
            <td style="text-align: right; font-weight: bold; border: 1px solid #000;">Interest</td>
            <td style="border: 1px solid #000;">' . $interestLabel . '</td>
            <td style="text-align: right; font-weight: bold; border: 1px solid #000;">Net Prof</td>
            <td style="border: 1px solid #000;">$' . ($buyer->Profit ?? '0') . '</td>
            <td style="border: 1px solid #000;">' . ($BusType3->SubCategory ?? '') . '</td>
            <td style="border: 1px solid #000;">' . $buyer->BusCounty3 . '</td>
        </tr>
        <tr>
            <td>' . $buyer->CallWhen . '</td>
            <td style="text-align: right; font-weight: bold; border: 1px solid #000;">Signed</td>
            <td style="border: 1px solid #000;">' . (($buyer->Signed == 1) ? 'Yes' : 'No') . '</td>
            <td style="text-align: right; font-weight: bold; border: 1px solid #000;">Date</td>
            <td style="border: 1px solid #000;">' . (!empty($buyer->BDate) && strtotime($buyer->BDate) ? date('d/m/Y', strtotime($buyer->BDate)) : '') . '</td>
            <td style="border: 1px solid #000;">' . ($BusType4->SubCategory ?? '') . '</td>
            <td style="border: 1px solid #000;">' . $buyer->BusCounty4 . '</td>
        </tr>
        <tr>
            <td colspan="7" style="height: 20px;"></td>
        </tr>
';
        }
      } else {
        $html .= '
        <div style="text-align:center; margin-top:50px; font-size:14pt;">
            <strong>No results found for the given filters.</strong>
        </div>';
      }
      $html .= '</tbody></table>';
    }
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
