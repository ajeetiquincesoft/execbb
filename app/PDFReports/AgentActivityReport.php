<?php

namespace App\PDFReports;

use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AgentActivityReport
{
    public function generate($from, $to)
    {
        $agents = DB::table('agents')->whereBetween('created_at', [$from, $to])->get();
        $buyerCounts = DB::table('buyers')
            ->whereBetween('DateEntered', [$from, $to])
            ->select('AgentID', DB::raw('COUNT(*) as total'))
            ->groupBy('AgentID')
            ->pluck('total', 'AgentID');
        $listingCounts = DB::table('listings')
            ->whereBetween('DateEntered', [$from, $to])
            ->select('AgentID', DB::raw('COUNT(*) as total'))
            ->groupBy('AgentID')
            ->pluck('total', 'AgentID');
        $validListings = DB::table('listings')
            ->whereBetween('DateEntered', [$from, $to])
            ->select('AgentID', DB::raw('COUNT(*) as total'))
            ->where('status', '=', 'valid')
            ->groupBy('AgentID')
            ->pluck('total', 'AgentID');
        $offerCounts = DB::table('offers')
            ->whereBetween('DateEntered', [$from, $to])
            ->select('listingAgent', DB::raw('COUNT(*) as total'))
            ->groupBy('listingAgent')
            ->pluck('total', 'listingAgent');
        $showingCounts = DB::table('showings')
            ->whereBetween('DateEntered', [$from, $to])
            ->select('agentId', DB::raw('COUNT(*) as total'))
            ->groupBy('agentId')
            ->pluck('total', 'agentId');
        $listTypeCounts = DB::table('listings')
            ->whereBetween('DateEntered', [$from, $to])
            ->select('AgentID', DB::raw('COUNT(*) as count'))
            ->where('ListType', 1)
            ->groupBy('AgentID')
            ->get()
            ->keyBy('AgentID');
        $listType2Counts = DB::table('listings')
            ->whereBetween('DateEntered', [$from, $to])
            ->select('AgentID', DB::raw('COUNT(*) as count'))
            ->where('ListType', 2)
            ->groupBy('AgentID')
            ->get()
            ->keyBy('AgentID');
        $listType3Counts = DB::table('listings')
            ->whereBetween('DateEntered', [$from, $to])
            ->select('AgentID', DB::raw('COUNT(*) as count'))
            ->where('ListType', 3)
            ->groupBy('AgentID')
            ->get()
            ->keyBy('AgentID');
        $agentCommissions = DB::table('listings')
            ->whereBetween('DateEntered', [$from, $to])
            ->select('AgentID', DB::raw('MAX(Commission) as total_commission'))
            ->groupBy('AgentID')
            ->pluck('total_commission', 'AgentID');
        $closedListings = DB::table('listings')
            ->whereBetween('DateEntered', [$from, $to])
            ->select('AgentID', DB::raw('COUNT(*) as close_count'))
            ->where('Status', 'Close')
            ->groupBy('AgentID')
            ->pluck('close_count', 'AgentID');

        $html = '<div class="hotsheet-content">';
        $html .= '<h1 style="font-size: 18px; text-align: center;">Agent Activity</h1>';
        $html .= '<h1 style="font-size: 18px; text-align: center;">Executive Business Brokers</h1>';
        $html .= '<p class="sub-heading" style="font-size: 14px; text-align: center;">From ' . $from->toDateString() . ' to ' . $to->toDateString() . '</p>';
        $html .= '<span class="mb-2" style="font-size: 12px; display: block; text-align: center;">Generated on: ' . Carbon::now()->format('m/d/Y') . '</span>';
        $html .= '</div><br><br>';
        $html .= '<table border="1" cellpadding="4" cellspacing="0" style="width: 100%; border-collapse: collapse;">';
        $html .= '<thead>';
        $html .= '<tr style="background-color: #F2F2F2; font-size: 12px; text-align: center;">';
        $html .= '<th rowspan="2">Agent</th>';
        $html .= '<th rowspan="2">Buyers</th>';
        $html .= '<th rowspan="2">Listings</th>';
        $html .= '<th rowspan="2">Valid</th>';
        $html .= '<th rowspan="2">Offers</th>';
        $html .= '<th rowspan="2">Showings</th>';
        $html .= '<th rowspan="2">To Buyers</th>';
        $html .= '<th rowspan="2">Pending</th>';
        $html .= '<th rowspan="2">Sole</th>';
        $html .= '<th colspan="2">Listing Types</th>';
        $html .= '<th rowspan="2">Comm.</th>';
        $html .= '<th rowspan="2">Closing</th>';
        $html .= '</tr>';
        $html .= '<tr style="background-color: #F2F2F2; font-size: 12px; text-align: center;">';
        $html .= '<th>Excl.</th>';
        $html .= '<th>Open</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';
        foreach ($agents as $agent) {
            $agentId = $agent->AgentID ?? '';
            $fullName = trim(($agent->FName ?? '') . ' ' . ($agent->LName ?? ''));
            $agentDisplay = $agentId . ' - ' . $fullName;
            $buyerCount = $buyerCounts[$agentId] ?? '';
            $listingCount = $listingCounts[$agentId] ?? '';
            $validCount = $validListings[$agentId] ?? '';
            $offerCount = $offerCounts[$agentId] ?? 0;
            $showingCount = $showingCounts[$agentId] ?? '';
            $countListType1 = $listTypeCounts[$agent->AgentID]->count ?? '';
            $listType2Count = $listType2Counts[$agent->AgentID]->count ?? '';
            $listType3Count = $listType3Counts[$agent->AgentID]->count ?? '';
            $commission = $agentCommissions[$agentId] ?? '';
            $closeCount = $closedListings[$agentId] ?? 0;
            $html .= '<tr style="font-size: 12px; text-align: center;">';
            $html .= '<td>' . htmlspecialchars($agentDisplay) . '</td>';
            $html .= '<td>' . $buyerCount . '</td>';
            $html .= '<td>' . $listingCount . '</td>';
            $html .= '<td>' . $validCount . '</td>';
            $html .= '<td>' . $offerCount . '</td>';
            $html .= '<td>' . $showingCount . '</td>';
            $html .= '<td> </td>';
            $html .= '<td>0</td>';
            $html .= '<td>' . $countListType1 . '</td>';
            $html .= '<td>' . $listType2Count . '</td>';
            $html .= '<td>' . $listType3Count . '</td>';
            $html .= '<td>' . $commission . '</td>';
            $html .= '<td>' . $closeCount . '</td>';
            $html .= '</tr>';
        }
        $html .= '</tbody></table>';
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        return $dompdf->output();
    }
}
