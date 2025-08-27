<?php

namespace App\PDFReports;

use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LeadMailingLabelsReport
{
    public function generate(Request $request)
    {
        //dd($request);
        $from = $request->from_date;
        $to = $request->to_date;
        $html = '';
           $leads = DB::table('leads')->where('SubCategory', $request->subcategory)->get();
            if ($leads) {
            $html .= '<style>
                    body {
                        font-family: Arial, sans-serif;
                        font-size: 10pt;
                        margin: 20px;
                    }
                </style>';
                $html .= '<div class="lead-container"><table width="100%" cellspacing="0" cellpadding="5" style="border-collapse: collapse;"><tr>';
                // Loop through leads
                foreach ($leads as $index => $lead) {
                    $html .='<td width="33%" valign="top" style="padding:8px;">
                        <strong>' . htmlspecialchars($lead->BusName ?? '') . '</strong><br>
                        ' . htmlspecialchars($lead->Address ?? '') . '<br>
                        ' . htmlspecialchars($lead->City ?? '') . ', ' . htmlspecialchars($lead->State ?? '') . ' ' . htmlspecialchars($lead->Zip ?? '') . '
                    </td>';
                    if(($index + 1) % 3 == 0){
                        $html .=' </tr><tr>';
                    }
                }

                $html .= '</div></tr></table>';
            
        }else{
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
