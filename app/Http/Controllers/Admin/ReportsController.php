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
    $fileName = '';

    // Define the file name and table based on the report type
    if ($reportName == 'listing') {
        $tableName = (new Listing)->getTable();
        $columns = Schema::getColumnListing($tableName);
        $datas = DB::table('listings')->orderBy('ListingID','desc')->get();
        $fileName = 'listings.csv';
    } elseif ($reportName == 'offer') {
        $tableName = (new Offer)->getTable();
        $columns = Schema::getColumnListing($tableName);
        $datas = DB::table('offers')->orderBy('OfferID','desc')->get();
        $fileName = 'offers.csv';
    } elseif ($reportName == 'agent') {
        $tableName = (new Agent)->getTable();
        $columns = Schema::getColumnListing($tableName);
        $datas = DB::table('agents')->orderBy('AgentTableID','desc')->get();
        $fileName = 'agents.csv';
    } elseif ($reportName == 'buyer') {
        $tableName = (new Buyer)->getTable();
        $columns = Schema::getColumnListing($tableName);
        $datas = DB::table('buyers')->orderBy('BuyerID','desc')->get();
        $fileName = 'buyers.csv';
    }elseif ($reportName == 'leads') {
        $tableName = ' leads';
        $columns = Schema::getColumnListing('leads');
        $datas = DB::table('leads')->orderBy('LeadID','desc')->get();
        $fileName = 'leads.csv';
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
      // Write the column headers to the CSV file
      fputcsv($handle, $columns);
      $datasArray = $datas->toArray();
     // dd($columns);
      //dd(is_array($columns));
 foreach ($datasArray as $data) {
    $row = [];

    // Loop through each column name and fetch the corresponding value from $data
    foreach ($columns as $column) {
        // Add each value to the row array (using -> to access properties of the object)
        $row[] = $data->$column;
    }
    
    fputcsv($handle, $row); 
    //dd($row);
    } 
/*     DB::table('buyers')->orderBy('BuyerID', 'desc')->chunk(5, function ($datas) use ($handle) {
        // Loop through each chunk of 10 records
        foreach ($datas as $data) {
            // Convert the object to an array using get_object_vars or typecasting
            $dataArray = (array) $data;  // or you can use get_object_vars($data)
        
            // Get the values from the array (remove keys)
            $dataValues = array_values($dataArray);

            // Write the corresponding data chunk to the CSV
            fputcsv($handle, $dataValues);
        }
    }); */
 

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
