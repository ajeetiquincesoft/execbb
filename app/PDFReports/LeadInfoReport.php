<?php

namespace App\PDFReports;

use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LeadInfoReport
{
    public function generate(Request $request)
    {
        //dd($request);
        $from = $request->from_date;
        $to = $request->to_date;
        $html = '';
        $lead = DB::table('leads')->where('LeadID', $request->lead_business_name)->first();
        if ($lead) {
            $html .= '<style>
                body {
                    font-family: Arial, sans-serif;
                    font-size: 10pt;
                }
                .header {
                    text-align: left;
                    font-weight: bold;
                }
                .right {
                    text-align: right;
                }
                .report-title {
                    font-size: 12pt;
                    font-weight: bold;
                    margin-bottom: 5px;
                }
                .subtitle {
                    margin-top: 0;
                    margin-bottom: 20px;
                }
                .lead-block {
                    margin-bottom: 20px;
                }
                .lead-header {
                    font-weight: bold;
                }
                .lead-address {
                    margin: 2px 0 8px 0;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-bottom: 5px;
                }
                td {
                    border: 1px solid #000;
                    padding: 3px 6px;
                    vertical-align: top;
                }
                .lead-id {
                    font-weight: bold;
                }
                .lead-link a {
                    color: blue;
                    text-decoration: underline;
                }
            </style>';
            $html .= '<!-- Header -->
            <div class="header">Executive Business Brokers</div>
            <div class="report-title">Lead Information</div>
            <div class="right">As of: ' . now()->format('n/j/Y') . '</div>';
            $category = DB::table('categories')->where('CategoryID', $lead->Category)->first();
            if ($category) {
                $categoryName = $category->BusinessCategory;
            } else {
                $categoryName = $lead->Category;
            }
            $SubCategoryData = DB::table('sub_categories')->where('SubCatID', $lead->SubCategory)->first();
            if ($SubCategoryData) {
                $subCategoryName = $SubCategoryData->SubCategory; // adjust column name
            } else {
                $subCategoryName = $lead->SubCategory; // fallback to raw value
            }
            $html .= '<div class="lead-block">
                    <table>
                        <tr><td>Lead Date</td><td>' . (!empty($lead->LDate) && strtotime($lead->LDate) ? date('d/m/Y', strtotime($lead->LDate)) : '') . '</td></tr>
                        <tr><td>Lead ID</td><td>' . $lead->LeadID . '</td></tr>
                        <tr><td>Agent ID</td><td>' . $lead->AgentID . '</td></tr>
                        <tr><td>Appoint Date</td><td>' . (!empty($lead->AppointmentDate) && strtotime($lead->AppointmentDate) ? date('d/m/Y', strtotime($lead->AppointmentDate)) : '') . '</td></tr>
                        
                        <tr><td>Seller Name</td><td>' . $lead->SellerFName . ' ' . $lead->SellerLName . '</td></tr>
                        <tr><td>Bus Name</td><td>' . $lead->BusName . '</td></tr>
                        <tr><td>Address</td><td>' . $lead->Address . ' ' . $lead->City . ', ' . $lead->State . '</td></tr>
                        <tr><td>City</td><td>' . $lead->City . '</td></tr>
                        <tr><td>County</td><td>' . $lead->County . '</td></tr>
                        <tr><td>Bus Phone</td><td>' . $lead->Phone . '</td></tr>
                        <tr><td>Home Phone</td><td>' . $lead->HomePhone . '</td></tr>
                        <tr><td>Cell Phone</td><td>' . $lead->CellPhone . '</td></tr>
                        <tr><td>FSBO No</td><td>' . $lead->FSBO . '</td></tr>
                        
                        <tr><td>Listed</td><td>' . $lead->Listed . '</td></tr>
                        <tr><td>Sub-Category</td><td>' . $subCategoryName . '</td></tr>
                        <tr><td>Ann Sales</td><td>$' . $lead->AnnSales . '</td></tr>
                        <tr><td>Size of Facility</td><td>' . $lead->SizeOfFacility . '</td></tr>
                        <tr><td>Present Owner</td><td>' . $lead->PresentOwner . '</td></tr>
                        
                        <tr><td>Asking Price</td><td>$' . $lead->Price . '</td></tr>
                        <tr><td>R/E Inc</td><td>' . $lead->RealEstateInc . '</td></tr>
                        <tr><td>If Yes, R/E Price</td><td>$' . $lead->REAsking . '</td></tr>
                    
                        <tr><td>Source</td><td>' . $lead->Source . '</td></tr>
                        <tr><td>Ad Copy</td><td>' . $lead->AdCopy . '</td></tr>
                        <tr><td>Ad Date</td><td>' . (!empty($lead->AdDate) && strtotime($lead->AdDate) ? date('d/m/Y', strtotime($lead->AdDate)) : '') . '</td></tr>
                    
                        <tr><td>Comment</td><td>' . $lead->Comments . '</td></tr>
                    </table>
                </div>';
        } else {
            $html .= '
                <div style="text-align:center; margin-top:50px; font-size:14pt;">
                    <strong>No results found for the given filters.</strong>
                </div>';
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
