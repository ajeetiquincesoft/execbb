<?php

namespace App\PDFReports;

use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ContactsInfoSheet
{
    public function generate($from, $to)
    {
        // Fetch contacts in the given date range
        $contacts = DB::table('contacts')
            ->whereBetween('created_at', [$from, $to])
            ->orderBy('created_at', 'desc')
            ->get();
        $html = '<div class="contacts-content">';
        $html .= '<h1 style="font-size: 20px;">Executive Business Brokers</h1>';
        $html .= '<h2 style="font-size: 16px;">Contacts Info Sheet</h2>';
        $html .= '<p style="font-size: 12px; text-align: right;"><strong>From:</strong> ' . $from->format('n/j/Y') . ' <strong>To:</strong> ' . $to->format('n/j/Y') . '</p>';
        $html .= '<p style="font-size: 12px; text-align: right;"><strong>Generated:</strong> ' . Carbon::now()->format('n/j/Y') . '</p>';
        if ($contacts->isEmpty()) {
            $html .= '<p style="font-size: 12px; color: red;">No contacts found in the selected date range.</p>';
        }
        foreach ($contacts as $contact) {
            $html .= '<table border="0" cellpadding="4" cellspacing="0" style="width: 100%; font-size: 12px; margin-bottom: 30px;">';
            $html .= '<tr>';
            $html .= '<td style="width: 50%;"><strong>Contact ID:</strong> ' . htmlspecialchars($contact->ContactID ?? '') . '</td>';
            $html .= '<td style="width: 50%;"><strong>Type:</strong> ' . htmlspecialchars($contact->Type ?? '') . '</td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $fullName = trim(($contact->FName ?? '') . ' ' . ($contact->LName ?? ''));
            $html .= '<td><strong>Name:</strong> ' . htmlspecialchars($fullName) . '</td>';
            $html .= '<td><strong>Additional Rep:</strong> ' . htmlspecialchars($contact->AddRep ?? '') . '</td>';
            $html .= '</tr>';
            $html .= '<tr><td colspan="2"><strong>Address:</strong> ' . htmlspecialchars($contact->Address1 ?? '') . '</td></tr>';
            $html .= '<tr><td colspan="2">' . htmlspecialchars($contact->Address2 ?? '') . '</td></tr>';
            $html .= '<tr>';
            $html .= '<td><strong>Phone:</strong> ' . htmlspecialchars($contact->Phone ?? '') . '</td>';
            $html .= '<td><strong>Fax:</strong> ' . htmlspecialchars($contact->Fax ?? '') . '</td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td><strong>Pager:</strong> ' . htmlspecialchars($contact->Pager ?? '') . '</td>';
            $html .= '<td><strong>Email:</strong> ' . htmlspecialchars($contact->Email ?? '') . '</td>';
            $html .= '</tr>';
            $html .= '<tr><td colspan="2"><strong>Comments:</strong> ' . nl2br(htmlspecialchars($contact->Comments ?? '')) . '</td></tr>';
            $html .= '</table><hr style="margin: 20px 0;">';
        }
        $html .= '</div>';
        /* $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        return $dompdf->output(); */
        return $html;
    }
}
