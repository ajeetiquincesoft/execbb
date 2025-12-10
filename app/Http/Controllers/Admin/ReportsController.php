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
use App\PDFReports\InternalListingActiveByAgent;



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
        $agents = Agent::whereNotNull('FName')
            ->where('FName', '!=', '')
            ->where('FName', 'REGEXP', '^[A-Za-z ]+$')
            ->where('Active', 1)
            ->orderBy('FName', 'asc')->get();
        $listingDBA = Listing::whereNotNull('DBA')
            ->where('DBA', '!=', '')
            ->orderBy('DBA', 'asc')->get();
        $initialItems = DB::table('buyers')->whereNotNull('FName')
            ->where('FName', '!=', '')
            ->where('FName', 'REGEXP', '^[A-Za-z ]+$')
            ->orderBy('FName', 'asc')->limit(1000)->get();
        $counties = DB::table('counties')->orderBy('County', 'asc')->get();
        $categories = DB::table('categories')->orderBy('BusinessCategory', 'asc')->get();
        $subcategories = DB::table('sub_categories')->orderBy('SubCategory', 'asc')->get();
        $contacts = DB::table('contacts')->whereNotNull('FName')
            ->where('FName', '!=', '')->orderBy('FName', 'asc')->get();
        $contactTypes = DB::table('contact_types')->orderBy('Description', 'asc')->get();
        $leadBusinessNames = DB::table('leads')->whereNotNull('BusName')
            ->where('BusName', '!=', '')->orderBy('BusName', 'asc')->get();
        $referralsNames = DB::table('referrals')->orderBy('RefCompany', 'asc')->get();
        return view('admin.reports.index', compact('reports', 'agents', 'categories', 'subcategories', 'initialItems', 'counties', 'listingDBA', 'contacts', 'contactTypes', 'leadBusinessNames', 'referralsNames'));
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
                $html = $report->generate($from, $to);
                $filename = 'AgentActivity_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '6':
                $report = new AgentInfoReport();
                $html  = $report->generate($agentInfo);
                $filename = 'AgentInfo_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '7':
                $report = new AgentMailingLabelsReport();
                $html = $report->generate($request);
                $filename = 'AgentMailingLabelsReport_' . now()->format('Ymd_His') . '.pdf';
                break;



            case '8':
                $html = (new AgentSignatureReports())->generate($agentInfo->FName, $agentInfo->LName, $agentInfo->AgentID);
                $filename = 'AgentSignature_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '9':
                $report = new BuyerListReport();
                $html = $report->generate($request);
                $filename = 'BuyerListReport_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '10':
                $report = new BuyerInfoReports();
                $html = $report->generate($request);
                $filename = 'BuyerInfoReports_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '11':
                $report = new BuyerProbMatchReport();
                $html = $report->generate($request);
                $filename = 'BuyerProbMatchReport_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '12':
                $report = new ActiveBuyerByAgent();
                $html = $report->generate($buyerInfo, $agentInfo);
                $filename = 'ActiveBuyerByAgent_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '14':
                $report = new BuyerInterestLetter();
                $html = $report->generate($request);
                $filename = 'BuyerInterestLatter_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '16':
                $report = new BuyerListFromWebReport();
                $html = $report->generate($request);
                $filename = 'BuyerListFromWebReport_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '17':
                $report = new SignedBuyerByAgentReport();
                $html = $report->generate($request);
                $filename = 'SignedBuyerByAgentReport_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '18':
                $report = new BuyerLeadListReport();
                $html = $report->generate($request);
                $filename = 'BuyerLeadListReport_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '19':
                $report = new BuyerElectronicSignature();
                $html = $report->generate($request);
                $filename = 'BuyerElectronicSignature_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '23':
                $html = (new ClosingListReport())->generate($request);
                $filename = 'ClosingReport_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '24':
                $html = (new ClosingListReport())->generate($request);
                $filename = 'ClosingReport_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '25':
                $html = (new ContactListReport())->generate($request);
                $filename = 'ContactListreport_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '26':
                $report = new ContactsInfoSheet();
                $html = $report->generate($from, $to);
                $filename = 'ContactsInfoSheet_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '28':
                $html = (new EscrowListReport())->generate($request);
                $filename = 'EscrowListReport_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '29':
                $html = (new EscrowInfoReport())->generate($request);
                $filename = 'EscrowInfoReport_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '31':
                $report = new LeadReport();
                $html = $report->generate($request);
                $filename = 'LeadReport_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '32':
                $report = new LeadInfoReport();
                $html = $report->generate($request);
                $filename = 'LeadInfoReport_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '33':
                $report = new LeadMailingLabelsReport();
                $html = $report->generate($request);
                $filename = 'LeadMailingLabelsReport_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '35':
                $report = new BusinessesForSoldReport();
                $html = $report->generate($request);
                $filename = 'BusinessForSoldReports_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '36':
                $report = new ListingFactSheet();
                $html = $report->generate($request);
                $filename = 'ListingFactSheetReport_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '41':
                $report = new BusinessesForSaleReport();
                $html = $report->generate($request);
                $filename = 'BusinessForSaleReports_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '46':
                $report = new ListingExpLetter();
                $html = $report->generate($request);
                $filename = 'ListingExpLatter_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '51':
                $report = new InternalListingActiveByAgent();
                $html = $report->generate($request);
                $filename = 'InternalListingActiveByAgent_' . now()->format('Ymd_His') . '.pdf';
                break;


            case '52':
                $report = new WelcomeLetterListListingReport();
                $html = $report->generate($request);
                $filename = 'WelcomeLetterListListingReport_' . now()->format('Ymd_His') . '.pdf';
                break;


            case '53':
                $report = new OfferListReport();
                $html = $report->generate($request);
                $filename = 'OfferListReport_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '54':
                $report = new OfferListReport();
                $html = $report->generate($request);
                $filename = 'OfferListReport_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '55':
                $report = new ReferralListReport();
                $html = $report->generate($request);
                $filename = 'ReferralListReport_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '56':
                $report = new ReferralInfoSheet();
                $html = $report->generate($request);
                $filename = 'ReferralInfoSheet_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '57':
                $report = new ReferralMailingLabelsReport();
                $html = $report->generate($request);
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
        return view('admin.reports.preview', [
            'html' => $html,
            'filters' => $request->all(),
            'reportType' => $reportType,
        ]);

        /* return response()->streamDownload(function () use ($pdfOutput) {
            echo $pdfOutput;
        }, $filename); */
    }
    public function download(Request $request)
    {
        $from = Carbon::parse($request->from_date)->startOfDay();
        $to = Carbon::parse($request->to_date)->endOfDay();
        $agentInfo = DB::table('agents')->where('AgentID', $request->agent)->first();
        $buyerInfo = DB::table('buyers')->where('AgentID', $request->agent)->where('Active', 1)->get();
        $reportType = $request->report2;

        switch ($reportType) {
            case '5':
                $report = new AgentActivityReport();
                $html = $report->generate($from, $to);
                $filename = 'AgentActivity_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '6':
                $report = new AgentInfoReport();
                $html  = $report->generate($agentInfo);
                $filename = 'AgentInfo_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '7':
                $report = new AgentMailingLabelsReport();
                $html = $report->generate($request);
                $filename = 'AgentMailingLabelsReport_' . now()->format('Ymd_His') . '.pdf';
                break;



            case '8':
                $html = (new AgentSignatureReports())->generate($agentInfo->FName, $agentInfo->LName, $agentInfo->AgentID);
                $filename = 'AgentSignature_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '9':
                $report = new BuyerListReport();
                $html = $report->generate($request);
                $filename = 'BuyerListReport_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '10':
                $report = new BuyerInfoReports();
                $html = $report->generate($request);
                $filename = 'BuyerInfoReports_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '11':
                $report = new BuyerProbMatchReport();
                $html = $report->generate($request);
                $filename = 'BuyerProbMatchReport_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '12':
                $report = new ActiveBuyerByAgent();
                $html = $report->generate($buyerInfo, $agentInfo);
                $filename = 'ActiveBuyerByAgent_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '14':
                $report = new BuyerInterestLetter();
                $html = $report->generate($request);
                $filename = 'BuyerInterestLatter_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '16':
                $report = new BuyerListFromWebReport();
                $html = $report->generate($request);
                $filename = 'BuyerListFromWebReport_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '17':
                $report = new SignedBuyerByAgentReport();
                $html = $report->generate($request);
                $filename = 'SignedBuyerByAgentReport_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '18':
                $report = new BuyerLeadListReport();
                $html = $report->generate($request);
                $filename = 'BuyerLeadListReport_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '19':
                $report = new BuyerElectronicSignature();
                $html = $report->generate($request);
                $filename = 'BuyerElectronicSignature_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '23':
                $html = (new ClosingListReport())->generate($request);
                $filename = 'ClosingReport_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '24':
                $html = (new ClosingListReport())->generate($request);
                $filename = 'ClosingReport_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '25':
                $html = (new ContactListReport())->generate($request);
                $filename = 'ContactListreport_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '26':
                $report = new ContactsInfoSheet();
                $html = $report->generate($from, $to);
                $filename = 'ContactsInfoSheet_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '28':
                $html = (new EscrowListReport())->generate($request);
                $filename = 'EscrowListReport_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '29':
                $html = (new EscrowInfoReport())->generate($request);
                $filename = 'EscrowInfoReport_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '31':
                $report = new LeadReport();
                $html = $report->generate($request);
                $filename = 'LeadReport_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '32':
                $report = new LeadInfoReport();
                $html = $report->generate($request);
                $filename = 'LeadInfoReport_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '33':
                $report = new LeadMailingLabelsReport();
                $html = $report->generate($request);
                $filename = 'LeadMailingLabelsReport_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '35':
                $report = new BusinessesForSoldReport();
                $html = $report->generate($request);
                $filename = 'BusinessForSoldReports_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '36':
                $report = new ListingFactSheet();
                $html = $report->generate($request);
                $filename = 'ListingFactSheetReport_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '41':
                $report = new BusinessesForSaleReport();
                $html = $report->generate($request);
                $filename = 'BusinessForSaleReports_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '46':
                $report = new ListingExpLetter();
                $html = $report->generate($request);
                $filename = 'ListingExpLatter_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '51':
                $report = new InternalListingActiveByAgent();
                $html = $report->generate($request);
                $filename = 'InternalListingActiveByAgent_' . now()->format('Ymd_His') . '.pdf';
                break;


            case '52':
                $report = new WelcomeLetterListListingReport();
                $html = $report->generate($request);
                $filename = 'WelcomeLetterListListingReport_' . now()->format('Ymd_His') . '.pdf';
                break;


            case '53':
                $report = new OfferListReport();
                $html = $report->generate($request);
                $filename = 'OfferListReport_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '54':
                $report = new OfferListReport();
                $html = $report->generate($request);
                $filename = 'OfferListReport_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '55':
                $report = new ReferralListReport();
                $html = $report->generate($request);
                $filename = 'ReferralListReport_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '56':
                $report = new ReferralInfoSheet();
                $html = $report->generate($request);
                $filename = 'ReferralInfoSheet_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '57':
                $report = new ReferralMailingLabelsReport();
                $html = $report->generate($request);
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
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape'); // or portrait
        $dompdf->render();

        // Stream download
        return $dompdf->stream($filename, ['Attachment' => true]);
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
        $options = DB::table('sub_categories')->where('CatID', $request->business_cat_id)->orderBy('SubCategory', 'asc')->get();
        return response()->json($options);
    }
    public function getBuyerData(Request $request)
    {
        $page = $request->get('page', 1);
        $limit = 1000;
        $search = $request->get('search', '');

        $query = DB::table('buyers')->whereNotNull('FName')
            ->where('FName', '!=', '')
            ->where('FName', 'REGEXP', '^[A-Za-z ]+$')
            ->orderBy('FName', 'asc');

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
