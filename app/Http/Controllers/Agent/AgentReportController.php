<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\Agent;
use App\Models\Buyer;
use App\Models\Offer;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AgentReportController extends Controller
{
    public function index()
    {
        return view('agent-dashboard.reports.index');
    }
    public function export(Request $request)
    {
        $reportName = $request->report;
        // Initialize variables
        $columns = [];
        $tableName = '';
        $fileName = '';
        // Define report configurations
        $reportConfig = [
            'listing' => ['model' => new Listing, 'fileName' => 'listings.csv', 'orderColumn' => 'ListingID'],
            'offer' => ['model' => new Offer, 'fileName' => 'offers.csv', 'orderColumn' => 'OfferID'],
            'agent' => ['model' => new Agent, 'fileName' => 'agents.csv', 'orderColumn' => 'AgentTableID'],
            'buyer' => ['model' => new Buyer, 'fileName' => 'buyers.csv', 'orderColumn' => 'BuyerID'],
            'leads' => ['tableName' => 'leads', 'fileName' => 'leads.csv', 'orderColumn' => 'LeadID'],
        ];
        // Validate the report name
        if (!array_key_exists($reportName, $reportConfig)) {
            return response()->json(['error' => 'Invalid report type.'], 400);
        }
        // Get the table and data configurations
        $config = $reportConfig[$reportName];
        if (isset($config['model'])) {
            $tableName = $config['model']->getTable();
        } elseif (isset($config['tableName'])) {
            $tableName = $config['tableName'];
        }
        $columns = Schema::getColumnListing($tableName);
        $fileName = $config['fileName'];
        // Set headers for CSV download
        $headers = [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0",
        ];
        // Generate CSV content
        $query = DB::table($tableName)
            ->orderBy($config['orderColumn'], 'desc');
        if ($reportName == 'listing') {
            $user = auth()->user();
            $query->where('RefAgentID', $user->id);
        }
        $callback = function () use ($columns, $query) {
            $handle = fopen('php://output', 'w');
            // Write column headers
            fputcsv($handle, $columns);
            // Stream data in chunks to handle large datasets
            $query->chunk(1000, function ($chunk) use ($handle, $columns) {
                foreach ($chunk as $data) {
                    $row = [];
                    foreach ($columns as $column) {
                        $row[] = $data->$column ?? ''; // Avoid errors for missing columns
                    }
                    fputcsv($handle, $row);
                }
            });
            fclose($handle);
        };
        // Return a streamed response for the CSV file
        return response()->stream($callback, 200, $headers);
    }
}
