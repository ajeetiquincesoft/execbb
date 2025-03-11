<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class DownloadActivityController extends Controller
{
    public function index(){
        $reportName = 'activities';
        // Initialize variables
        $columns = [];
        $tableName = '';
        $fileName = '';
        // Define report configurations
        $reportConfig = [
            'activities' => ['model' => new Activity, 'fileName' => 'activities.csv', 'orderColumn' => 'id'],
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
