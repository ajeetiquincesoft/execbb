<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Listing;
use App\Models\Agent;
use App\Models\Buyer;
use App\Models\Offer;
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
        $headers = [];
        $columns = [];
        $tableName = '';
        $datas = null;

        // Define the file name and table based on the report type
        if ($reportName == 'listing') {
            $tableName = (new Listing)->getTable();
            $columns = Schema::getColumnListing($tableName);
            $datas = DB::table('listings')->orderBy('ListingID','desc');
            $fileName = 'listings.csv';
        } elseif ($reportName == 'offer') {
            $tableName = (new Offer)->getTable();
            $columns = Schema::getColumnListing($tableName);
            $datas = DB::table('offers')->orderBy('OfferID','desc');
            $fileName = 'offers.csv';
        } elseif ($reportName == 'agent') {
            $tableName = (new Agent)->getTable();
            $columns = Schema::getColumnListing($tableName);
            $datas = DB::table('agents')->orderBy('AgentTableID','desc');
            $fileName = 'agents.csv';
        } elseif ($reportName == 'buyer') {
            $tableName = (new Buyer)->getTable();
            $columns = Schema::getColumnListing($tableName);
            $datas = DB::table('buyers')->orderBy('BuyerID','desc');
            $fileName = 'buyers.csv';
        }

        if ($datas->count() == 0) {
            return response()->json(['error' => 'No data available for the selected report.']);
        }

        // Set the CSV headers for the response
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        // Open a memory stream for writing CSV data
        $handle = fopen('php://output', 'w');

        // Add the dynamic header row (columns) to the CSV file
        fputcsv($handle, $columns);

        // Add an orderBy clause to ensure the data is chunked consistently
       // $datas->orderBy('id');  // You can replace 'id' with any column that makes sense for your dataset

        // Chunk the dataset into smaller portions for processing
        $datas->chunk(100, function ($chunk) use ($handle) {
            // Write each row of the chunk to the CSV file
            foreach ($chunk as $data) {
                // Convert the data to an array and write it to the CSV
                $dataArray = (array) $data;
                fputcsv($handle, $dataArray);
            }
        });

        // Return the response with headers and streamed content
        return response()->stream(
            function () use ($handle) {
                fclose($handle);
            },
            200,
            $headers
        );
    }
}
