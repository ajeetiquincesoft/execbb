<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\Agent;
use App\Models\Buyer;
use App\Models\Offer;
use App\Models\Contact;
use App\Models\Referral;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    public function index()
    {
        return view('admin.reports.index');
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
            'contact' => ['model' => new Contact, 'fileName' => 'contacts.csv', 'orderColumn' => 'ContactID'],
            'referral' => ['model' => new Referral, 'fileName' => 'referrals.csv', 'orderColumn' => 'RefID'],
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
        $callback = function () use ($columns, $tableName, $config) {
            $handle = fopen('php://output', 'w');
            // Write column headers
            fputcsv($handle, $columns);
            // Stream data in chunks to handle large datasets
            DB::table($tableName)
                ->orderBy($config['orderColumn'], 'desc')
                ->chunk(1000, function ($chunk) use ($handle, $columns) {
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
