<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\PDFReports\AgentActivityReport;
use App\PDFReports\AgentInfoReport;
use App\PDFReports\ActiveBuyerByAgent;
use App\PDFReports\BusinessesForSaleReport;
use App\PDFReports\BusinessesForSoldReport;
use App\PDFReports\ContactsInfoSheet;
use App\PDFReports\BuyerListReport;
use App\PDFReports\ListingFactSheet;
use App\PDFReports\AgentSignatureReports;
use App\PDFReports\ContactListReport;
use App\PDFReports\BuyerInterestLetter;
use App\PDFReports\ListingExpLetter;
use App\PDFReports\BuyerInfoReports;
use App\PDFReports\BuyerProbMatchReport;
use App\PDFReports\BuyerListFromWebReport;
use App\PDFReports\SignedBuyerByAgentReport;
use App\PDFReports\BuyerLeadListReport;
use App\PDFReports\BuyerElectronicSignature;
use App\PDFReports\LeadReport;
use App\PDFReports\LeadInfoReport;
use App\PDFReports\LeadMailingLabelsReport;
use App\PDFReports\OfferListReport;
use App\PDFReports\ReferralListReport;
use App\PDFReports\ReferralInfoSheet;
use App\PDFReports\ReferralMailingLabelsReport;
use App\PDFReports\EscrowListReport;
use App\PDFReports\EscrowInfoReport;
use App\PDFReports\ClosingListReport;
use App\PDFReports\AgentMailingLabelsReport;
use App\PDFReports\WelcomeLetterListListingReport;


use Carbon\Carbon;
use App\Models\Agent;
use App\Models\Listing;
use Dompdf\Dompdf;
use Dompdf\Options;

class ReportsController extends Controller
{
    public function index()
    {
        $reports = DB::table('reports')->get();
        $agents = Agent::orderBy('created_at', 'desc')->get();
        $listingDBA = Listing::orderBy('created_at', 'desc')->get();
        $initialItems = DB::table('buyers')->limit(1000)->get();
        $counties = DB::table('counties')->get();
        $categories = DB::table('categories')->get();
        $subcategories = DB::table('sub_categories')->get();
        $statuses = DB::table('listings')
            ->whereNotNull('Status')
            ->distinct()
            ->orderBy('Status')
            ->pluck('Status');
        $contacts = DB::table('contacts')->get();
        $contactTypes = DB::table('contact_types')->get();
        $leadBusinessNames = DB::table('leads')->get();
        $referralsNames = DB::table('referrals')->get();
        return view('admin.reports.index', compact('reports', 'agents', 'categories', 'subcategories', 'statuses', 'initialItems', 'counties', 'listingDBA', 'contacts', 'contactTypes', 'leadBusinessNames', 'referralsNames'));
    }
    public function export(Request $request)
    {
        // dd($request);
        $request->validate([
            'report' => 'required',
            'from_date' => 'required|date',
            'to_date' => 'required|date|after_or_equal:from_date',
        ]);
        $from = Carbon::parse($request->from_date)->startOfDay();
        $to = Carbon::parse($request->to_date)->endOfDay();
        $agentInfo = DB::table('agents')->where('AgentID', $request->agent)->first();
        $buyerInfo = DB::table('buyers')->where('AgentID', $request->agent)->where('Active', 1)->get();
        $reportType = $request->report2;

        switch ($reportType) {
            case '5':
                $report = new AgentActivityReport();
                $pdfOutput = $report->generate($from, $to);
                $filename = 'AgentActivity_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '6':
                $report = new AgentInfoReport();
                $pdfOutput = $report->generate($agentInfo);
                $filename = 'AgentInfo_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '7':
                $report = new AgentMailingLabelsReport();
                $pdfOutput = $report->generate($request);
                $filename = 'AgentMailingLabelsReport_' . now()->format('Ymd_His') . '.pdf';
                break;



            case '8':
                $pdfOutput = (new AgentSignatureReports())->generate($agentInfo->FName, $agentInfo->LName, $agentInfo->AgentID);
                $filename = 'AgentSignature_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '9':
                $report = new BuyerListReport();
                $pdfOutput = $report->generate($request);
                $filename = 'BuyerListReport_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '10':
                $report = new BuyerInfoReports();
                $pdfOutput = $report->generate($request);
                $filename = 'BuyerInfoReports_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '11':
                $report = new BuyerProbMatchReport();
                $pdfOutput = $report->generate($request);
                $filename = 'BuyerProbMatchReport_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '12':
                $report = new ActiveBuyerByAgent();
                $pdfOutput = $report->generate($buyerInfo, $agentInfo);
                $filename = 'ActiveBuyerByAgent_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '14':
                $report = new BuyerInterestLetter();
                $pdfOutput = $report->generate($request);
                $filename = 'BuyerInterestLatter_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '16':
                $report = new BuyerListFromWebReport();
                $pdfOutput = $report->generate($request);
                $filename = 'BuyerListFromWebReport_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '17':
                $report = new SignedBuyerByAgentReport();
                $pdfOutput = $report->generate($request);
                $filename = 'SignedBuyerByAgentReport_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '18':
                $report = new BuyerLeadListReport();
                $pdfOutput = $report->generate($request);
                $filename = 'BuyerLeadListReport_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '19':
                $report = new BuyerElectronicSignature();
                $pdfOutput = $report->generate($request);
                $filename = 'BuyerElectronicSignature_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '23':
                $pdfOutput = (new ClosingListReport())->generate($request);
                $filename = 'ClosingReport_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '24':
                $pdfOutput = (new ClosingListReport())->generate($request);
                $filename = 'ClosingReport_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '25':
                $pdfOutput = (new ContactListReport())->generate($request);
                $filename = 'ContactListreport_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '26':
                $report = new ContactsInfoSheet();
                $pdfOutput = $report->generate($from, $to);
                $filename = 'ContactsInfoSheet_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '28':
                $pdfOutput = (new EscrowListReport())->generate($request);
                $filename = 'EscrowListReport_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '29':
                $pdfOutput = (new EscrowInfoReport())->generate($request);
                $filename = 'EscrowInfoReport_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '31':
                $report = new LeadReport();
                $pdfOutput = $report->generate($request);
                $filename = 'LeadReport_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '32':
                $report = new LeadInfoReport();
                $pdfOutput = $report->generate($request);
                $filename = 'LeadInfoReport_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '33':
                $report = new LeadMailingLabelsReport();
                $pdfOutput = $report->generate($request);
                $filename = 'LeadMailingLabelsReport_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '35':
                $report = new BusinessesForSoldReport();
                $pdfOutput = $report->generate($request);
                $filename = 'BusinessForSoldReports_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '36':
                $report = new ListingFactSheet();
                $pdfOutput = $report->generate($request);
                $filename = 'ListingFactSheetReport_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '41':
                $report = new BusinessesForSaleReport();
                $pdfOutput = $report->generate($request);
                $filename = 'BusinessForSaleReports_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '46':
                $report = new ListingExpLetter();
                $pdfOutput = $report->generate($request);
                $filename = 'ListingExpLatter_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '52':
                $report = new WelcomeLetterListListingReport();
                $pdfOutput = $report->generate($request);
                $filename = 'WelcomeLetterListListingReport_' . now()->format('Ymd_His') . '.pdf';
                break;


            case '53':
                $report = new OfferListReport();
                $pdfOutput = $report->generate($request);
                $filename = 'OfferListReport_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '54':
                $report = new OfferListReport();
                $pdfOutput = $report->generate($request);
                $filename = 'OfferListReport_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '55':
                $report = new ReferralListReport();
                $pdfOutput = $report->generate($request);
                $filename = 'ReferralListReport_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '56':
                $report = new ReferralInfoSheet();
                $pdfOutput = $report->generate($request);
                $filename = 'ReferralInfoSheet_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '57':
                $report = new ReferralMailingLabelsReport();
                $pdfOutput = $report->generate($request);
                $filename = 'ReferralInfoSheet_' . now()->format('Ymd_His') . '.pdf';
                break;

            default:
                // Generate professional PDF instead of abort
                $options = new Options();
                $options->set('isHtml5ParserEnabled', true);
                $options->set('isRemoteEnabled', true);

                $dompdf = new Dompdf($options);

                $html = '
                        <style>
                            body {
                                font-family: Arial, sans-serif;
                                font-size: 12pt;
                                text-align: center;
                                padding: 40px;
                            }
                            .message-box {
                                border: 2px solid #333;
                                padding: 30px;
                                border-radius: 10px;
                                background: #f9f9f9;
                                display: inline-block;
                                margin-top: 50px;
                            }
                            h1 {
                                color: #b22222;
                                margin-bottom: 20px;
                            }
                            p {
                                color: #333;
                            }
                        </style>
                        <div class="message-box">
                            <h1>Report Notice</h1>
                            <p>The report type you selected is invalid.</p>
                            <p>Please verify your selection and try again.</p>
                            <p><strong>Executive Business Brokers Reports</strong></p>
                        </div>';

                $dompdf->loadHtml($html);
                $dompdf->setPaper('A4', 'portrait');
                $dompdf->render();
                return $dompdf->stream('invalid-report.pdf', ["Attachment" => false]);
        }

        return response()->streamDownload(function () use ($pdfOutput) {
            echo $pdfOutput;
        }, $filename);
    }
    public function getSubReports(Request $request)
    {
        $options = DB::table('report_types')
            ->where('report_id', $request->report_id)
            ->get();
        return response()->json($options);
    }
    public function getBusinessSubCategories(Request $request)
    {
        // Fetch options based on the selected ID (e.g., from a database)
        $options = DB::table('sub_categories')->where('CatID', $request->business_cat_id)->get();
        return response()->json($options);
    }
    public function getBuyerData(Request $request)
    {
        $page = $request->get('page', 1);
        $limit = 1000;
        $search = $request->get('search', '');

        $query = DB::table('buyers')->orderBy('BuyerID');

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('FName', 'like', "{$search}%")
                    ->orWhere('LName', 'like', "{$search}%");
            });
        }

        $items = $query->skip(($page - 1) * $limit)
            ->take($limit)
            ->get(['BuyerID', 'FName', 'LName']);

        return response()->json($items);
    }
}
