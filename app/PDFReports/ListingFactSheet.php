<?php

namespace App\PDFReports;

use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\Agent;
use Carbon\Carbon;

class ListingFactSheet
{
    public function generate(Request $request)
    {
        $categories = DB::table('categories')->pluck('BusinessCategory', 'CategoryID');
        $subCategories = DB::table('sub_categories')->pluck('SubCategory', 'SubCatID');
        $category = request('category');
        $subcategory = request('subcategory');
        $dba = request('listing_dba');
        $status = request('status');
        // Start building the query
        $query = Listing::query();
        // Apply filters if they are present
        if ($category) {
            $query->where('BusCategory', $category);
        }

        if ($subcategory) {
            $query->where('SubCat', $subcategory);
        }

        if ($dba) {
            $query->where('DBA', 'like', '%' . $dba . '%');
        }

        if ($status) {
            $query->where('status', $status);
        }

        // Apply sorting and get results
        $listingQueryData = $query->orderBy('created_at', 'desc')->take(50)->get();
        $previousDate = Carbon::today()->subDay()->format('Y-m-d');
         $html = '<html><head><style>
                 body { font-family: Arial}
                table { width: 100%; page-break-inside: avoid;}
                tr, td, th {
                page-break-inside: avoid;
                page-break-after: auto;
            }
            .no-break {
                page-break-inside: avoid;
            }
            </style></head><body>';
        foreach ($listingQueryData as $listingData) {
            $annualSaleAmount = $listingData->AnnualSales ?? 0;
            $annualSaleAmount = (float) $annualSaleAmount;
             $listingAgent = Agent::where('AgentID', $listingData->AgentID)->first();
             $lname = $listingAgent ? $listingAgent->LName : '';
             $fname = $listingAgent ? $listingAgent->FName : '';
            // Cost of Goods Labels and Values
            $COGs = [
                ['label' => $listingData->COG1Label ?? 'N/A', 'value' => $listingData->COG1 ?? 0],
                ['label' => $listingData->COG2Label ?? 'N/A', 'value' => $listingData->COG2 ?? 0],
                ['label' => $listingData->COG3Label ?? 'N/A', 'value' => $listingData->COG3 ?? 0],
            ];
            $html .= '<table cellspacing="0" cellpadding="0" style="border-collapse: collapse; border: none; border-bottom: 1px solid black;">';
        $html .= '<tbody>';
        $html .= '<tr style="border-bottom: 1px solid black;">
                <td valign="top" style="font-size: 8pt; border-right: 1px solid black; text-align: left;">
                    <p>Executive Business Brokers</p>
                </td>';
        $html .= '<td valign="top" style="font-size: 8pt; text-align:right;">
                    Fact sheet&nbsp; <i>as of:&nbsp; ' . $previousDate . '</i>
                </td>
            </tr>';
        $html .= ' <tr style="border-bottom: 1px solid black;  text-align: left;">
                <td colspan="2" style="font-size: 8pt; font-weight: bold">
                    Mergers &amp; Acquisitions / Business Valuations / Commercial Financing / Investment Property /Consulting
                </td>
            </tr>';
            $html .= '<tr>
                <td colspan="2" align="center" style="font-size: 8pt">
                    <table border="0"  cellspacing="0" cellpadding="0">
                            <tr>
                                <td style=" font-size: 8pt"><b>ID#:</b></td>
                                <td colspan="3" style=" font-size: 8pt">&nbsp;' . $listingData->ListingID . '</td>
                                <td style=" font-size: 8pt"></td>
                                <td style=" font-size: 8pt"></td>
                            </tr>
                            <tr>
                                <td style=" font-size: 8pt">Name of Business:</td>
                                <td colspan="3" style=" font-size: 12pt"><b>&nbsp;' . $listingData->DBA . '</b></td>
                                <td style=" font-size: 8pt" align="right"></td>
                                <td style=" font-size: 8pt" rowspan="5"></td>
                            </tr>
                            <tr>
                                <td style=" font-size: 8pt">Address 1:</td>
                                <td colspan="3" style=" font-size: 8pt">&nbsp;' . $listingData->Address1 . '.</td>
                                <td style=" font-size: 8pt"></td>
                            </tr>
                            <tr>
                                <td style=" font-size: 8pt">Address 2:</td>
                                <td colspan="3" style=" font-size: 8pt">&nbsp;</td>
                                <td style=" font-size: 8pt"></td>
                            </tr>
                            <tr>
                                <td style=" font-size: 8pt"><b>City:</b></td>
                                <td style=" font-size: 8pt">&nbsp;' . $listingData->City . '</td>
                                <td style=" font-size: 8pt"><b>State:</b></td>
                                <td style=" font-size: 8pt">&nbsp;' . strtoupper($listingData->State) . '</td>
                            </tr>
                            <tr>
                                <td style=" font-size: 8pt"><b>Zip:</b></td>
                                <td style=" font-size: 8pt">&nbsp;' . $listingData->Zip . '</td>
                                <td style=" font-size: 8pt"><b>County:</b></td>
                                <td style=" font-size: 8pt">&nbsp;' . $listingData->County . '</td>
                            </tr>
                    </table>
                </td>
            </tr>';
            $html .= '<tr>
        <td width="50%" align="center" style="font-size: 10pt; font-weight: bold; border-top: 1px solid black; border-bottom: 1px solid black; border-right: 1px solid black;">
            Business Profile
        </td>
        <td width="50%" align="center" style="font-size: 10pt; font-weight: bold; border-top: 1px solid black; border-bottom: 1px solid black;">
            Income and Expense
        </td>
    </tr>
    <tr style="border-bottom: 1px solid black;">
        <td valign="top" style="border-right: 1px solid black;">
        <div>
            <table  border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;">
                <tr>
                    <td style="font-size: 8pt">Business Category:</td>
                    <td style="font-size: 8pt"><u>' . htmlspecialchars($categories[$listingData->BusCategory] ?? 'N/A') . '</u></td>
                </tr>
                <tr>
                    <td style="font-size: 8pt">Business Type:</td>
                    <td style="font-size: 8pt"><u>' . htmlspecialchars($subCategories[$listingData->SubCat] ?? 'N/A') . '</u></td>
                </tr>
                <tr>
                    <td style="font-size: 8pt">Purchase Price:</td>
                    <td style="font-size: 8pt"><u>$' . number_format( (float) $listingData->PurPrice, 2) . '</u></td>
                </tr font-size: 8pt">
                <tr>
                    <td style="font-size: 8pt">Down Payment:</td>
                    <td style="font-size: 8pt"><u>$' . number_format( (float) $listingData->DownPay, 2) . '</u></td>
                </tr>
                <tr>
                    <td style="font-size: 8pt">Balance:</td>
                    <td style="font-size: 8pt"><u>$' . number_format( (float) ($listingData->Balance ?? 0), 2) . '</u></td>
                </tr>
                <tr>
                    <td style="font-size: 8pt">Interest Rate:</td>
                    <td style="font-size: 8pt"><u>' . ($listingData->Interest ?? 0) . ' %</u></td>
                </tr>
                <tr>
                    <td style="font-size: 8pt">Annual Sales:</td>
                    <td style="font-size: 8pt"><u>$' . number_format( (float) $listingData->AnnualSales, 2) . '</u></td>
                </tr>
                <tr>
                    <td style="font-size: 8pt">Years Established:</td>
                    <td style="font-size: 8pt"><u>' . htmlspecialchars($listingData->YrsEstablished ?? 'N/A') . '</u></td>
                </tr>
                <tr>
                    <td style=" font-size: 8pt" valign="middle">
                        Years Present Owner: </td>
                    <td style=" font-size: 8pt" valign="middle"><u>' . $listingData->YrsPresentOwner . '</u></td>
                </tr>
                <tr>
                    <td style=" font-size: 8pt;" valign="middle">
                        Store/Building Size:
                    </td>
                    <td style=" font-size: 8pt;" valign="middle">
                        <u>' . htmlspecialchars($listingData->BldgSize ?? 'N/A') . '</u>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        Seats:
                        <u>' . htmlspecialchars($listingData->Seats ?? 0) . '</u>
                    </td>
                </tr>
                <tr>
                    <td style=" font-size: 8pt;" valign="middle">
                        Employees:
                    </td>
                    <td style=" font-size: 8pt;" valign="middle">
                        FT: <u>' . htmlspecialchars($listingData->FTEmp ?? 0) . '</u>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        PT: <u>' . htmlspecialchars($listingData->PTEmp ?? 0) . '</u>
                    </td>
                </tr>
                <tr>
                    <td style=" font-size: 8pt;" valign="middle">
                        Annual Payroll:
                    </td>
                    <td style=" font-size: 8pt;" valign="middle">
                        <u>$' . number_format( (float) ($listingData->AnnPayroll ?? 0), 2) . '</u>
                    </td>
                </tr>
                <tr>
                    <td style=" font-size: 8pt;" valign="middle">
                        Business Hours:
                    </td>
                    <td style=" font-size: 8pt;" valign="middle">
                        <u>' . htmlspecialchars($listingData->BizHours ?? 'Mon.- Fri. 8:00 a.m. - 5:00 p.m.') . '</u>
                    </td>
                </tr>
                <tr>
                    <td style=" font-size: 8pt;" valign="middle">
                        Product Mix:
                    </td>
                    <td style=" font-size: 8pt;" valign="middle">
                        <u>' . htmlspecialchars($listingData->Product ?? 'N/A') . '</u>
                    </td>
                </tr>
                <tr>
                    <td style=" font-size: 8pt;" valign="middle">
                        Lease Terms:
                    </td>
                    <td style=" font-size: 8pt;" valign="middle">
                        <u>' . htmlspecialchars($listingData->LeaseTerms ?? 'N/A') . ' year</u>
                    </td>
                </tr>
                <tr>
                    <td style=" font-size: 8pt;" valign="middle">
                        Lease Options:
                    </td>
                    <td style=" font-size: 8pt;" valign="middle">
                        <u>' . htmlspecialchars($listingData->LeaseOpt ?? 'N/A') . ' year</u>
                    </td>
                </tr>
                <tr>
                    <td style=" font-size: 8pt;" valign="middle">
                        Real Estate:
                    </td>
                    <td style=" font-size: 8pt;" valign="middle">
                        Included? <u>' . ($listingData->RealEstate ? 'Yes' : 'No') . '</u>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        Option to Buy? <u>' . ($listingData->ToBuy ? 'Yes' : 'No') . '</u>
                    </td>
                </tr>
                <tr>
                    <td style=" font-size: 8pt;" valign="middle">
                        Real Estate Asking Price:
                    </td>
                    <td style=" font-size: 8pt;" valign="middle">
                        <u>$' . number_format( (float) ($listingData->REAskingPrice ?? 0), 2) . '</u>
                    </td>
                </tr>
                <tr>
                    <td style=" font-size: 8pt;" valign="middle">
                        Inventory Included:
                    </td>
                    <td style=" font-size: 8pt;" valign="middle">
                        <u>$' . number_format( (float) ($listingData->InvInPrice ?? 0), 2) . '</u>
                    </td>
                </tr>
                <tr>
                    <td style=" font-size: 8pt;" valign="middle">
                        Inventory Not Included:
                    </td>
                    <td style=" font-size: 8pt;" valign="middle">
                        <u>$' . number_format( (float) ($listingData->InvNot ?? 0), 2) . '</u>
                    </td>
                </tr>
                <tr>
                    <td style=" font-size: 8pt;" valign="middle">
                        Additional Terms:
                    </td>
                    <td style=" font-size: 8pt;" valign="middle">
                        <u>' . htmlspecialchars($listingData->AddTerm ?? 'N/A') . '</u>
                    </td>
                </tr>
                <tr>
                    <td style=" font-size: 8pt; font-weight: bold;" valign="middle">
                        Highlights:
                    </td>
                    <td style=" font-size: 8pt;" valign="middle">
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style=" font-size: 8pt;" valign="top">
                        ' . ($listingData->Highlights ?? '') . ' <b>**PLEASE SEE ATTACHED**</b>
                    </td>
                </tr>
                <tr>
                    <td style=" font-size: 8pt; font-weight: bold;" valign="middle">
                        Listing Agent:
                    </td>
                    <td style=" font-size: 8pt;" valign="middle">
                        <b><u>'. $fname .' '. $lname .'</u></b>
                    </td>
                </tr>


            </table>
            </div>
        </td>
        <td valign="top">
        <div class="income-expence" style="margin-bottom: 10px;">
            <table  border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;">';
            $html .= '
                <tr>
                    <td style=" font-size: 8pt">Annual Sales:</td>
                    <td style=" font-size: 8pt" align="right">
                        <u>$' . number_format( (float) $annualSaleAmount, 2) . '</u>
                    </td>
                    <td style=" font-size: 8pt"></td>
                </tr>
                <tr>
                    <td style=" font-size: 8pt" align="right">
                        <p align="left">Cost Of Goods</p>
                    </td>
                    <td style=" font-size: 8pt" align="right"></td>
                    <td style=" font-size: 8pt" align="right"></td>
                </tr>
                ';

            // Loop through each COG item
            $totalCost = 0;
            foreach ($COGs as $cog) {
                $value = $cog['value'];
                $percentage = ($annualSaleAmount != 0) ? ($value / $annualSaleAmount) * 100 : 0;
                $totalCost += $value;

                $html .= '
                <tr>
                    <td style=" font-size: 8pt">' . htmlspecialchars($cog['label']) . ':</td>
                    <td style=" font-size: 8pt" align="right" >
                        <u>&nbsp;$' . number_format( (float) $value, 2) . '</u>
                    </td>
                    <td style=" font-size: 8pt" align="right">
                        <u>&nbsp;' . number_format( (float) $percentage, 2) . '%</u>
                    </td>
                </tr>
                ';
            }

            // Total Cost and GOP
            $percentageTotalCost = ($annualSaleAmount != 0) ? ($totalCost / $annualSaleAmount) * 100 : 0;
            $totalGOP = $annualSaleAmount - $totalCost;
            $percentageGOP = ($annualSaleAmount != 0) ? ($totalGOP / $annualSaleAmount) * 100 : 0;

            $html .= "
                <tr>
                    <td style=\" font-size:8pt;\" align=\"left\"><b>Total Cost of Sales:</b></td>
                    <td style=\" font-size:8pt;\" align=\"right\"><u>$" . number_format( (float) $totalCost, 2) . "</u></td>
                    <td style=\" font-size:8pt;\" align=\"right\"><u>" . number_format( (float) $percentageTotalCost, 2) . "%</u></td>
                </tr>
                <tr>
                     <td style=\" font-size:8pt;\" align=\"left\"><b>Gross Operating Profit:</b></td>
                    <td style=\" font-size:8pt;\" align=\"right\"><u>$" . number_format( (float) $totalGOP, 2) . "</u></td>
                    <td style=\" font-size:8pt;\" align=\"right\"><u>" . number_format( (float) $percentageGOP, 2) . "%</u></td>
                </tr>
                ";
            // Define operating expense categories
            $expenseCategories = [
                'AnnRent'           => 'Annual Rent',
                'CommonAreaMaint'   => 'Common Area Maintenance',
                'RealEstateTax'     => 'Real Estate Tax',
                'AnnPayroll'        => 'Annual Payroll',
                'PayrollTax'        => 'Payroll Tax',
                'LicFee'            => 'License Fee',
                'Advertising'       => 'Advertising',
                'Telephone'         => 'Telephone',
                'Utilities'         => 'Utilities, Gas / Electric',
                'Insurance'         => 'Insurance',
                'AcctLeg'           => 'Accounting / Legal',
                'Maintenance'       => 'Maintenance',
                'Trash'             => 'Trash',
                'Other'             => 'Other'
            ];

            $totalOperatingExpenses = 0;

            // Section header
            $html .= "
                <tr>
                    <td colspan=\"2\" style=\" font-size:8pt;\" align=\"left\"><b>Operating Expenses:</b></td>
                    <td></td><td></td>
                </tr>
                ";

            // Loop through categories
            foreach ($expenseCategories as $key => $label) {
                $val = $listingData->$key ?? 0;
                $pct = ($annualSaleAmount !== null && $annualSaleAmount != 0) 
                    ? ($val / $annualSaleAmount) * 100 
                    : 0;

                $totalOperatingExpenses += $val;

                $html .= "
                <tr>
                    
                    <td style=\" font-size:8pt;\">{$label}:</td>
                    <td style=\" font-size:8pt;\" align=\"right\"><u>$" . number_format( (float) $val, 2) . "</u></td>
                    <td style=\" font-size:8pt;\" align=\"right\"><u>" . number_format( (float) $pct, 2) . "%</u></td>
                </tr>
                ";
            }

            // Optional fields
            for ($i = 1; $i <= 2; $i++) {
                $labelKey = "Opt{$i}Label";
                $valueKey = "Opt{$i}";
                if (!empty($listingData->$labelKey)) {

                    $val = $listingData->$valueKey ?? 0;
                    $pct = ($annualSaleAmount !== null && $annualSaleAmount != 0) 
                        ? ($val / $annualSaleAmount) * 100 
                        : 0;

                    $totalOperatingExpenses += $val;

                    $html .= "
                <tr>
                    
                    <td style=\" font-size:8pt;\">" . htmlspecialchars($listingData->$labelKey) . ":</td>
                    <td style=\" font-size:8pt;\" align=\"right\"><u>$" . number_format( (float) $val, 2) . "</u></td>
                    <td style=\" font-size:8pt;\" align=\"right\"><u>" . number_format( (float) $pct, 2) . "%</u></td>
                </tr>
                ";
                }
            }

            // Total operating expenses
            $totalOpPct = ($annualSaleAmount > 0) 
                ? ($totalOperatingExpenses / $annualSaleAmount) * 100 
                : 0;
            $html .= "
                <tr>
                    
                    <td style=\" font-size:8pt;\"><b>Total Operating Expenses:</b></td>
                    <td align=\"right\" style=\" font-size:8pt;\"><u>$" . number_format( (float) $totalOperatingExpenses, 2) . "</u></td>
                    <td align=\"right\" style=\" font-size:8pt;\"><u>" . number_format( (float) $totalOpPct, 2) . "%</u></td>
                </tr>
                ";

            // Recapitulation
            $totalCost = $listingData->COG1 + $listingData->COG2 + $listingData->COG3;
            $percentTotalCost = $annualSaleAmount ? ($totalCost / $annualSaleAmount) * 100 : 0;
            $totalOperatingProfit = $annualSaleAmount - ($totalCost + $totalOperatingExpenses);
            $percentOperatingProfit = $annualSaleAmount ? ($totalOperatingProfit / $annualSaleAmount) * 100 : 0;
            $otherIncome = $listingData->OtherInc ?? 0;
            $percentOtherIncome = $annualSaleAmount ? ($otherIncome / $annualSaleAmount) * 100 : 0;
            $adjCashFlow = $totalOperatingProfit + $otherIncome;
            $percentAdjCashFlow = $annualSaleAmount ? ($adjCashFlow / $annualSaleAmount) * 100 : 0;
            $html .= "
                <tr>
                    <td colspan=\"2\" style=\" font-size:8pt;\" align=\"left\">Recapitulation:</td>
                    <td></td><td></td>
                </tr>";
            $html .= '
                    <tr>
                        <td style=" font-size: 8pt;">Annual Sales</td>
                        <td style=" font-size: 8pt;" align="right"><u>$' . number_format( (float) $annualSaleAmount, 2) . '</u></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style=" font-size: 8pt;">Cost of Sales</td>
                        <td style=" font-size: 8pt;" align="right"><u>$' . number_format( (float) $totalCost, 2) . '</u></td>
                        <td style=" font-size: 8pt;" align="right"><u>' . number_format( (float) $percentTotalCost, 2) . '%</u></td>
                    </tr>

                    <tr>
                        <td style=" font-size: 8pt;">Operating Expenses</td>
                        <td style=" font-size: 8pt;" align="right"><u>$' . number_format( (float) $totalOperatingExpenses, 2) . '</u></td>
                        <td style=" font-size: 8pt;" align="right"><u>' . number_format( (float) $totalOpPct, 2) . '%</u></td>
                    </tr>

                    <tr>
                        <td style=" font-size: 8pt;">Operating Profit</td>
                        <td style=" font-size: 8pt;" align="right"><u>$' . number_format( (float) $totalOperatingProfit, 2) . '</u></td>
                        <td style=" font-size: 8pt;" align="right"><u>' . number_format( (float) $percentOperatingProfit, 2) . '%</u></td>
                    </tr>

                    <tr>
                        <td style=" font-size: 8pt;">Other Income</td>
                        <td style=" font-size: 8pt;" align="right"><u>$' . number_format( (float) $otherIncome, 2) . '</u></td>
                        <td style=" font-size: 8pt;" align="right"><u>' . number_format( (float) $percentOtherIncome, 2) . '%</u></td>
                    </tr>

                    <tr style="margin-bottom : 10px;">
                        <td style=" font-size: 8pt;"><b>Total Adj. Cash Flow</b></td>
                        <td style=" font-size: 8pt;" align="right"><u><b>$' . number_format( (float) $adjCashFlow, 2) . '</b></u></td>
                        <td style=" font-size: 8pt;" align="right"><u><b>' . number_format( (float) $percentAdjCashFlow, 2) . '%</b></u></td>
                    </tr>
                    ';




            $html .= '</table></div>
        </td>
    </tr>';
            $html .= '<tr>
                <td colspan="2" align="center" style=" font-size: 8pt">
                    <table border="0"  cellspacing="0" cellpadding="0" style="border-collapse: collapse" bordercolor="#111111">
                        <tbody>
                            <tr>
                                <td  style=" font-size: 8pt; font-weight: bold">Footnotes and Legend: ()</td>
                            </tr>
                            <tr>
                                <td  style=" font-size: 8pt">
                                    <p class="MsoNormal">
                                        <span style="font-size:8.5pt;font-family:Verdana;color:black">
                                            Adjusted Cash Flow - A calculation showing the cash flow
                                            generated by the Business for the most recent fiscal or
                                            calendar year, unless otherwise indicated, by adding back to
                                            the net profit those costs that are discretionary to the
                                            Seller, INCLUDING the owners salary and benefits, or in an
                                            absentee-run business, the Managers salary and benefits,
                                            non-cash benefits such as depreciation (in most situations)
                                            and amortization, and certain non-recurring or unusual
                                            expenses such as Seller Perks. BUYERS BEWARE Broker has not
                                            audited the books and records and accordingly does not warrant
                                            the accuracy or correctness of information. Purchaser must
                                            conduct his / her own investigation to determine the accuracy
                                            of all business and financial information presented herein.<br>
                                            &nbsp;</span>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td  align="center" style=" font-size: 8pt">
                                    2583 Morris Ave Union, NJ 07083 Phone: (908)851-9040 Fax: (908)851-9066 Email: sales@execbb.com</td>
                            </tr>
                            <tr>
                                <td  align="center" style=" font-size: 8pt; font-weight: bold">
                                    Website:&nbsp;https://www.execbb.com</td>
                            </tr>
                            <tr>
                                <td  align="center" style=" font-size: 8pt">*All information is from sources deemed reliable and is submitted subject to errors, omissions, change of price, rental, prior sale and withdrawal notice.</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>';
            $html .= '</tbody></table>';
        }

         $html .= '</body></html>';
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
      

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        return $dompdf->output();
    }
}