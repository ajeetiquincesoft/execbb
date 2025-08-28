<?php

namespace App\PDFReports;

use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class InternalListingActiveByAgent
{
    public function generate(Request $request)
    {
        // Sample data - replace this with your actual query
        $from = $request->from_date;
        $to = $request->to_date;

        $listings = DB::table('listings as l')
            ->leftJoin('categories as c', 'l.BusCategory', '=', 'c.CategoryID')
            ->leftJoin('sub_categories as sc', 'l.SubCat', '=', 'sc.SubCatID')
            ->when($request->franchise == '1', fn($q) => $q->where('Franchise', 1))
            ->when($request->real_estate_inc == '1', fn($q) => $q->where('RealEstate', 1))
            ->when($request->best_buy == '1', fn($q) => $q->where('BestBuy', 1))
            ->when($request->category, fn($q) => $q->where('l.BusCategory', $request->category))
            ->when($request->subcategory, fn($q) => $q->where('l.SubCat', $request->subcategory))
            ->when($request->agent, fn($q) => $q->where('l.AgentID', $request->agent))
            ->when($request->status, fn($q) => $q->where('l.Status', $request->status))
            ->whereBetween('l.DateEntered', [$from, $to])
            ->select('l.*', 'c.BusinessCategory as CategoryName', 'sc.SubCategory as SubCategoryName')
            ->get();

        // Now group by names instead of IDs
        $groupedListings = $listings->groupBy(['CategoryName', 'SubCategoryName']);

        $html = '
        <style>
            body {
                font-family: Arial, sans-serif;
                font-size: 9pt;
                margin: 20px;
            }
            .header {
                text-align: center;
                margin-bottom: 15px;
            }
            .header h1 {
                font-size: 14pt;
                margin: 0;
                font-weight: bold;
            }
            .sub-header {
                text-align: center;
                font-size: 9pt;
                margin-bottom: 20px;
            }
            .category {
                margin-top: 20px;
                font-weight: bold;
                font-size: 11pt;
                padding-bottom: 4px;
            }
            .subCategory{
            border-bottom: 1px solid #000;
             font-weight: bold;
            padding-bottom: 4px;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 6px;
                margin-bottom: 15px;
            }
            th, td {
                border: 1px solid #000;
                padding: 5px;
                font-size: 8pt;
                text-align: left;
                width: 16.66%;
                word-wrap: break-word;
            }
            th {
                background-color: #f2f2f2;
                font-weight: bold;
            }
            .small {
                font-size: 7pt;
            }
        </style>';

        // Header Section
        $html .= '
        <div class="header">
            <h1>Executive Business Brokers</h1>
            <div>Internal Listings Report</div>
        </div>
        <div class="sub-header">
            Active by Category | As of: ' . now()->format('m/d/Y') . '<br>
            Total Active Listings: ' . $listings->flatten()->count() . '
        </div>';

        // Loop categories and listings
        foreach ($groupedListings as $categoryName => $subcategories) {
            $html .= '<div class="category">' . e($categoryName) . '</div>';
            foreach ($subcategories as $subcategoryName => $items) {
                $html .= '<div class="subCategory">' . e($subcategoryName) . '</div>';
                foreach ($items as $listing) {
                    $listType = DB::table('listing_types')->where('ListType', $listing->ListType)->first();
                    if ($listType) {
                        $listTypeName = $listType->Description;
                    } else {
                        $listTypeName = '';
                    }

                    $html .= '
                <table>
                    <tr>
                        <td>Bldg Size</td>
                        <td>' . e($listing->BldgSize ?? '') . '</td>
                        <td>Ann. Payroll</td>
                        <td>$' . e($listing->AnnPayroll ?? '0') . '</td>
                        <td>Inv In Price</td>
                        <td>$' . e($listing->InvInPrice ?? '0') . '</td>
                    </tr>
                    <tr>
                        <td>Days Open</td>
                        <td>' . e($listing->NoDaysOpen ?? '0') . '</td>
                        <td>Ann. Sales</td>
                        <td>$' . e($listing->AnnualSales ?? '0') . '</td>
                        <td>Inv Not</td>
                        <td>$' . e($listing->InvNot ?? '0') . '</td>   
                    </tr>
                    <tr>
                        <td>Base Rent</td>
                        <td>$' . e($listing->BaseMonthRent ?? '') . '</td>
                        <td>Ann. Net Profit</td>
                        <td>$' . e($listing->AnnualNetProfit ?? '0') . '</td>
                        <td>Exp Date</td>
                        <td>' . e($listing->ExpDate ?? '') . '</td>
                    </tr>
                    <tr>
                        <td>List Type</td>
                        <td>' . e($listTypeName ?? '') . '</td>
                        <td>Pur. Price</td>
                        <td>$' . number_format($listing->PurPrice ?? 0, 2) . '</td>
                        <td>RE Inc</td>
                        <td>' . (isset($listing->REInc) && $listing->REInc ? "Yes" : "No") . '</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Down Pay</td>
                        <td>$' . number_format($listing->DownPay ?? 0, 2) . '</td>
                        <td>Until Sold</td>
                        <td>' . e($listing->UntilSold == 0 ? 'No' : 'Yes') . '</td>
                    </tr>
                    <tr>
                        <td>Lease Terms</td>
                        <td colspan="3">' . e($listing->LeaseTerms ?? '') . '</td>
                        <td>' . e($listing->BusCategory ?? '') . '</td>
                        <td>' . e($listing->SubCat ?? '') . '</td>
                    </tr>
                </table>';
                }
            }
        }

        // Footer / Legend
        $html .= '
        <div class="small">
            <b>Footnotes and Legend:</b><br>
            Adjusted Profit - A calculation showing the cash flow generated by the Business...<br><br>
            2583 Morris Ave Union, NJ 07083 | Phone: (908)851-9040 | Fax: (908)851-9066 | Email: sales@execbb.com<br>
            Website: https://www.execbb.com <br>
            *All information is from sources deemed reliable and is submitted subject to errors...
        </div>';

        // Generate PDF
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        return $dompdf->output();
    }
}
