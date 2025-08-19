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
use Carbon\Carbon;
use App\Models\Agent;
use App\Models\Listing;

class ReportsController extends Controller
{
    public function index()
    {
        $reports = DB::table('reports')->get();
        $agents = Agent::orderBy('created_at', 'desc')->get();
        $listingDBA = Listing::orderBy('created_at', 'desc')->get();
        $initialItems = DB::table('buyers')->limit(1000)->get();
        $counties = DB::table('counties')->get();
        $categories = DB::table('categories')
            ->get();
        $subcategories = DB::table('sub_categories')
            ->get();
        $statuses = DB::table('listings')
            ->whereNotNull('Status')
            ->distinct()
            ->orderBy('Status')
            ->pluck('Status');
        $contacts = DB::table('contacts')->get();
        $contactTypes = DB::table('contact_types')->get();
        return view('admin.reports.index', compact('reports', 'agents', 'categories', 'subcategories', 'statuses','initialItems','counties','listingDBA','contacts','contactTypes'));
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

            case '41':
                $report = new BusinessesForSaleReport();
                $pdfOutput = $report->generate($request);
                $filename = 'BusinessForSaleReports_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '35':
                $report = new BusinessesForSoldReport();
                $pdfOutput = $report->generate($request);
                $filename = 'BusinessForSoldReports_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '26':
                $report = new ContactsInfoSheet();
                $pdfOutput = $report->generate($from, $to);
                $filename = 'ContactsInfoSheet_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '9':
                $report = new BuyerListReport();
                $pdfOutput = $report->generate($request);
                $filename = 'BuyerListReport_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '36':   
                $report = new ListingFactSheet(); 
                $pdfOutput = $report->generate($request);
                $filename = 'ListingFactSheetReport_' . now()->format('Ymd_His') . '.pdf';
                break;
            
            case '8':
                $pdfOutput = (new AgentSignatureReports())->generate($agentInfo->FName, $agentInfo->LName, $agentInfo->AgentID);
                $filename = 'AgentSignature_' . now()->format('Ymd_His') . '.pdf';
                break;
            
            case '25':
                $pdfOutput = (new ContactListReport())->generate($request);
                $filename = 'ContactListreport_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '14':
                $report = new BuyerInterestLetter();
                $pdfOutput = $report->generate($request);
                $filename = 'BuyerInterestLatter_' . now()->format('Ymd_His') . '.pdf';
                break;

            case '46':
                $report = new ListingExpLetter();
                $pdfOutput = $report->generate($request);
                $filename = 'ListingExpLatter_' . now()->format('Ymd_His') . '.pdf';
                break;

                
            default:
                abort(400, 'Invalid report type selected.');
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
