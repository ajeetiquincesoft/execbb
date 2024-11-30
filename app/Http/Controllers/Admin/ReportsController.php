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

    // Define chunk size for headers and data (10 columns at a time)
    $chunkSize = 10;
    $columnChunks = array_chunk($columns, $chunkSize); // Divide columns into chunks of 10

    $datas->chunk(40, function ($chunk) use ($handle, $columnChunks) {
        // For each chunk of data, we will write the headers and then the data
        foreach ($columnChunks as $index => $columnChunk) {
            // Write headers for the current chunk
            fputcsv($handle, $columnChunk); // Write headers chunk

            // For each data row in the chunk, write the corresponding values
            foreach ($chunk as $data) {
                $dataArray = (array) $data;
                $dataValues = array_values($dataArray);
               
                // Slice the data values to match the chunk size (first 10 columns for each chunk)
                $dataValuesChunk = array_slice($dataValues, $index * 10, 10);

                // Write the corresponding data chunk to the CSV
                fputcsv($handle, $dataValuesChunk);
            }
        }
    });

    // Return the response with headers and streamed content after all data has been written
    return response()->stream(
        function () use ($handle) {
            fclose($handle); // Close the file after streaming is complete
        },
        200,
        $headers
    );


   
    }
}
