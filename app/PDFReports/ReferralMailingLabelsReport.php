<?php

namespace App\PDFReports;

use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ReferralMailingLabelsReport
{
    public function generate(Request $request)
    {
        $html = '';
        $referrals = DB::table('referrals')->where('RefType', $request->referral_status)->get();
        if ($referrals) {
            $html .= '<style>
                    body {
                        font-family: Arial, sans-serif;
                        font-size: 10pt;
                        margin: 20px;
                    }
                </style>';
            $html .= '<div class="lead-container"><table width="100%" cellspacing="0" cellpadding="5" style="border-collapse: collapse;"><tr>';
            // Loop through leads
            foreach ($referrals as $index => $referral) {
                $html .= '<td width="33%" valign="top" style="padding:8px;">
                        <strong>' . htmlspecialchars($referral->RefCompany ?? '') . '</strong><br>
                        ' . htmlspecialchars($referral->Address1 ?? '') . '<br>
                        ' . htmlspecialchars($referral->City ?? '') . ', ' . htmlspecialchars($referral->State ?? '') . ' ' . htmlspecialchars($referral->Zip ?? '') . '
                    </td>';
                if (($index + 1) % 3 == 0) {
                    $html .= ' </tr><tr>';
                }
            }

            $html .= '</div></tr></table>';
        } else {
            $html .= '
                <div style="text-align:center; margin-top:50px; font-size:14pt;">
                    <strong>No results found for the given filters.</strong>
                </div>';
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
