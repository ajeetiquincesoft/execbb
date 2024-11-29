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
use Symfony\Component\HttpFoundation\StreamedResponse;

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
        $datas = null;
        $columns = [];
        //dd($reportName);
        if ($reportName == 'listing') {
            $tableName = (new Listing)->getTable();
            $columns = Schema::getColumnListing($tableName);
            $datas = DB::table('listings')->get();
            $headers = [
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename=listings.csv",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            ];
        }
        elseif ($reportName == 'offer') {
            $tableName = (new Offer)->getTable();
            $columns = Schema::getColumnListing($tableName);
            $datas = DB::table('offers')->get();
            $headers = [
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename=offers.csv",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            ];
        }
        elseif ($reportName == 'agent') {
            $tableName = (new Agent)->getTable();
            $columns = Schema::getColumnListing($tableName);
            $datas = DB::table('agents')->get();
            $headers = [
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename=agents.csv",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            ];
        }
       elseif ($reportName == 'buyer') {
            $tableName = (new Buyer)->getTable();
            $columns = Schema::getColumnListing($tableName);
            $datas = DB::table('buyers')->get();
            $headers = [
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename=buyers.csv",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            ];
        }
        if ($datas->isEmpty()) {
            return response()->json(['error' => 'No data available for the selected report.']);
        }
        // Open a memory stream
        $handle = fopen('php://output', 'w');

        // Add the dynamic header row to the CSV using the table column names
        fputcsv($handle, $columns);

        // Loop through the data and write each row to the CSV
      foreach ($datas as $data) {
            // Get the data from the user model and create an array for fputcsv()
            $dataArray = (array) $data;
            fputcsv($handle, $dataArray);
        } 
      /*   $datas->chunk(100, function ($chunk) use ($handle) {
            foreach ($chunk as $data) {
                // Convert each model's data to an array and write it to the CSV
                fputcsv($handle, $data->toArray());
            }
        }); */

        // Return the response with the headers and streamed content
        return response()->stream(
            function () use ($handle) {
                fclose($handle);
            },
            200,
            $headers
        );
    }
}
