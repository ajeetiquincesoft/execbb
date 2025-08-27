<?php

namespace App\PDFReports;

use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ReferralInfoSheet
{
    public function generate($request)
    {
        $referral = DB::table('referrals')->where('RefID', $request->referral_name)->first();
        $html = '<div class="referral-content">';
        $html .= '<h1 style="font-size: 20px;">Executive Business Brokers</h1>';
        $html .= '<h2 style="font-size: 16px;">Escrow Info Sheet</h2>';
        $html .= '<p style="font-size: 12px; text-align: right;">As of: ' . Carbon::now()->format('n/j/Y') . '</p>';
        if ($referral) {
            $html .= '<table border="0" cellpadding="4" cellspacing="0" style="width: 100%; font-size: 12px; margin-bottom: 30px;">';
            $html .= '<tr>';
            $html .= '<td style="width: 50%;"><strong>Referral ID:</strong> ' . htmlspecialchars($referral->RefID ?? '') . '</td>';
            $html .= '<td style="width: 50%;"><strong>Referral Source:</strong> ' . htmlspecialchars($referral->RefSource ?? '') . '</td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td><strong>Company:</strong> ' . htmlspecialchars($referral->RefCompany) . '</td>';
            $html .= '</tr>';
            $html .= '<tr>
            <td><strong>Broker of Record:</strong> ' . htmlspecialchars($referral->BrokOfRec ?? '') . '</td>
            <td><strong>Agent Name:</strong> ' . htmlspecialchars($referral->AgentName ?? '') . '</td>
            </tr>';
            $html .= '<tr>';
            $html .= '<td><strong>Phone:</strong> ' . htmlspecialchars($referral->Phone ?? '') . '</td>';
            $html .= '<td><strong>Fax:</strong> ' . htmlspecialchars($referral->Fax ?? '') . '</td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td><strong>Referral Fee:</strong> $' . htmlspecialchars($referral->RefFee ?? '') . '</td>';
            $html .= '</tr>';
            $html .= '<tr><td><strong>Referral Amount:</strong> $' . nl2br(htmlspecialchars($referral->RefAmt ?? '')) . '</td></tr>';
            $html .= '<tr><td><strong>Flat Fee:</strong> ' . nl2br(htmlspecialchars($referral->FlatFee ?? '')) . '</td></tr>';
            $html .= '</table>';
            
        }else{
            $html .= '<p style="font-size: 12px; color: red;">No referral found in the selected type.</p>';
        }
        $html .= '</div>';
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        return $dompdf->output();
    }
}
