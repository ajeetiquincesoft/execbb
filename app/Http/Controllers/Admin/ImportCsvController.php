<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Agent;
use App\Models\Buyer;
use Carbon\Carbon;

class ImportCsvController extends Controller
{
    public function getImportFile()
    {
        return view('admin.import-file');
    }
    public function importCsv5445(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt',
        ]);

        $file = $request->file('file');
        $handle = fopen($file, 'r');
        $header = fgetcsv($handle); // Read header row
        while (($row = fgetcsv($handle)) !== false) {
            $existing = DB::table('listings')->where('ListingID', $row[0])->exists();

            if ($existing) {
                // Skip this record if already exists
                continue;
            }
            // Insert data into the database
            $phone = $row[23] === '' ? NULL : $row[23];
            $fax = $row[24] === '' ? NULL : $row[24];
            $active = isset($row[68]) ? $row[68] : '';
            if ($active == 1) {
                $status = 'valid';
            } else {
                $status = 'invalid';
            }
            $rawValue = isset($row[54]) ? $row[54] : '';
            $cleanedValue = trim($rawValue);
            $cleanedValue = preg_replace('/[[:^print:]]/', '', $cleanedValue);
            if ($cleanedValue === '' || $cleanedValue === '0') {
                $balance = null;
            } else {
                if (strpos($cleanedValue, ',') !== false) {
                    $cleanedValue = str_replace(',', '', $cleanedValue);
                    $numericValue = (float)$cleanedValue;
                    $balance = $numericValue;
                } else {
                    $balance = $cleanedValue;
                }
            }
            /* $balance = 21542145; */
            DB::insert('
            INSERT INTO listings (
                ListingID, SellerCorpName, SellerLName, SellerFName, SHomeAdd1, SHomeAdd2, SCity, SState, SZip,
                SHomePh, SHomeFax, Pager, Email, BusCategory, BusType, SubCat, Address1, Address2, City, State, Zip,
                County, Group_change, Phone, Fax, CorpName, DBA, BldgSize, Seats, FTEmp, PTEmp, AnnPayroll, LicenseReq,
                Parking, NoDaysOpen, HoursOfOp, BaseMonthRent, AnnRent, LeaseTerms, LeaseOpt, Basement, BaseSize,
                MgtAgentName, MgtAgentPh, RefAgentID, RefAgentPh, YrsEstablished, YrsPresentOwner, Motivation,
                Inventory, AnnualSales, CostOfSale, GrossProfit, TotalExpenses, AnnualNetProfit, PurPrice, DownPay,
                ListPrice, Balance, Interest, AddTerm, SaleReas, Highlights, Comments, Directions, AgentID, ListDate,
                ExpDate, Commission, FlatFee, ListType, SoldEBB, Active, COGFood, COGBeverage, COGOther, COG1Label,
                COG1, COG2Label, COG2, COG3Label, COG3, CommonAreaMaint, Advertising, LicFee, Telephone, Utilities,
                PayrollTax, RealEstateTax, Insurance, AcctLeg, Opt2, Opt2Label, Maintenance, Opt1, Opt1Label, Trash,
                Other, OtherInc, Product, RealEstate, REAskingPrice, ToBuy, InvInPrice, InvNot, DateEntered, EnteredBy,
                DateModified, ModType, Franchise, UntilSold, IntSell, BestBuy, SIC, FedID, YearInc, fsbo, featured,
                imagepath, LeadID, Welcome, CoBrokID, Review, DisplayImage, DisplayID, Steps, Status, CreatedBy, document_path, created_at, updated_at
            ) VALUES (
                ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
            )', [
                $row[0],
                $row[1],
                $row[2],
                $row[3],
                $row[4],
                $row[5],
                $row[6],
                $row[7],
                $row[8],
                $row[9],
                $row[10],
                $row[11],
                $row[12],
                $row[13],
                $row[14],
                $row[15],
                $row[16],
                $row[17],
                $row[18],
                $row[19],
                $row[20],
                $row[21],
                $row[22],
                $phone,
                $fax,
                $row[25],
                $row[26],
                $row[27],
                $row[28],
                $row[29],
                $row[30],
                $row[31],
                $row[32],
                $row[33],
                $row[34],
                $row[35],
                $row[36],
                $row[37],
                $row[38],
                $row[39],
                $row[40],
                $row[41],
                $row[42],
                $row[43],
                $row[44],
                $row[45],
                $row[46],
                $row[47],
                '',
                $row[48],
                $row[49],
                '',
                '',
                '',
                $row[50],
                $row[51],
                $row[52],
                $row[53],
                $balance,
                $row[55],
                $row[56],
                $row[57],
                $row[58],
                $row[59],
                $row[60],
                $row[61],
                $row[62],
                $row[63],
                $row[64],
                $row[65],
                $row[66],
                $row[67],
                isset($row[68]) ? (int)$row[68] : 0,
                $row[69],
                $row[70],
                $row[71],
                $row[72],
                $row[73],
                $row[74],
                $row[75],
                $row[76],
                $row[77],
                $row[78],
                $row[79],
                $row[80],
                $row[81],
                $row[82],
                $row[83],
                $row[84],
                $row[85],
                $row[86],
                $row[87],
                $row[88],
                $row[89],
                $row[90],
                $row[91],
                $row[92],
                $row[93],
                $row[94],
                $row[95],
                $row[96],
                $row[97],
                $row[98],
                $row[99],
                $row[100],
                $row[101],
                $row[102],
                $row[103],
                $row[104],
                $row[105],
                $row[106],
                $row[107],
                $row[108],
                $row[109],
                $row[110],
                $row[111],
                $row[112],
                $row[113],
                $row[114],
                $row[115],
                $row[116],
                $row[117],
                $row[118],
                $row[119],
                $row[120],
                '',
                $status,
                '',
                '',
                now(),
                now()
            ]);
        }

        fclose($handle);
        return back()->with('success', 'CSV data imported successfully!');
    }
    public function listingImportCsv(Request $request)
    {
        set_time_limit(0);
        $request->validate([
            'file' => 'required|mimes:csv,txt',
        ]);

        $file = $request->file('file');

        if (($handle = fopen($file->getRealPath(), 'r')) === false) {
            return back()->with('error', 'Unable to open CSV file.');
        }

        // Read header row
        $csvHeaders = fgetcsv($handle);
        if (!$csvHeaders) {
            return back()->with('error', 'CSV file is empty or invalid.');
        }
        // Normalize header case
        $csvHeaders = array_map(function ($header) {
            $header = preg_replace('/[\x{FEFF}]/u', '', $header); // remove BOM
            return trim($header); // trim space
        }, $csvHeaders);

        // Expected database columns (MUST match your DB columns)
        $expectedColumns = [
            'ListingID',
            'SellerCorpName',
            'SellerLName',
            'SellerFName',
            'SHomeAdd1',
            'SHomeAdd2',
            'SCity',
            'SState',
            'SZip',
            'SHomePh',
            'SHomeFax',
            'Pager',
            'Email',
            'BusCategory',
            'BusType',
            'SubCat',
            'Address1',
            'Address2',
            'City',
            'State',
            'Zip',
            'County',
            'Group_change',
            'Phone',
            'Fax',
            'CorpName',
            'DBA',
            'BldgSize',
            'Seats',
            'FTEmp',
            'PTEmp',
            'AnnPayroll',
            'LicenseReq',
            'Parking',
            'NoDaysOpen',
            'HoursOfOp',
            'BaseMonthRent',
            'AnnRent',
            'LeaseTerms',
            'LeaseOpt',
            'Basement',
            'BaseSize',
            'MgtAgentName',
            'MgtAgentPh',
            'RefAgentID',
            'RefAgentPh',
            'YrsEstablished',
            'YrsPresentOwner',
            'Motivation',
            'Inventory',
            'AnnualSales',
            'CostOfSale',
            'GrossProfit',
            'TotalExpenses',
            'AnnualNetProfit',
            'PurPrice',
            'DownPay',
            'ListPrice',
            'Balance',
            'Interest',
            'AddTerm',
            'SaleReas',
            'Highlights',
            'Comments',
            'Directions',
            'AgentID',
            'ListDate',
            'ExpDate',
            'Commission',
            'FlatFee',
            'ListType',
            'SoldEBB',
            'Active',
            'COGFood',
            'COGBeverage',
            'COGOther',
            'COG1Label',
            'COG1',
            'COG2Label',
            'COG2',
            'COG3Label',
            'COG3',
            'CommonAreaMaint',
            'Advertising',
            'LicFee',
            'Telephone',
            'Utilities',
            'PayrollTax',
            'RealEstateTax',
            'Insurance',
            'AcctLeg',
            'Opt2',
            'Opt2Label',
            'Maintenance',
            'Opt1',
            'Opt1Label',
            'Trash',
            'Other',
            'OtherInc',
            'Product',
            'RealEstate',
            'REAskingPrice',
            'ToBuy',
            'InvInPrice',
            'InvNot',
            'DateEntered',
            'EnteredBy',
            'DateModified',
            'ModType',
            'Franchise',
            'UntilSold',
            'IntSell',
            'BestBuy',
            'SIC',
            'FedID',
            'YearInc',
            'fsbo',
            'featured',
            'imagepath',
            'LeadID',
            'Welcome',
            'CoBrokID',
            'Review',
            'DisplayImage',
            'DisplayID',
            'Steps',
            'Status',
            'CreatedBy',
            'document_path'
        ];

        $integerColumns = ['Fax', 'Phone', 'SHomePh', 'SHomeFax', 'RefAgentID', 'RefAgentPh'];
        $rowCount = 0;
        $insertCount = 0;
        $skipCount = 0;

        while (($row = fgetcsv($handle)) !== false) {
            $rowCount++;
            $listingData = [];
            /*  Log::info('Processing Row Data:', ['row' => $csvHeaders]);
            // Ensure we are correctly extracting the ListingID column from the CSV
            $csvIndex = array_search('ListingID', $csvHeaders);
            if ($csvIndex === false) {
                Log::warning("ListingID column not found in the CSV header.");
                continue; // Skip this row if ListingID is not found
            } */
            foreach ($expectedColumns as $col) {
                $csvIndex = array_search($col, $csvHeaders);
                $value = ($csvIndex !== false && isset($row[$csvIndex])) ? trim($row[$csvIndex]) : null;
                $value = mb_convert_encoding($value, 'UTF-8', 'UTF-8');
                $value = preg_replace('/[^\PC\s]/u', '', $value);
                if (strtoupper($value) === 'NULL' || $value === '') {
                    $value = null;
                }

                if (in_array($col, $integerColumns)) {
                    $listingData[$col] = is_numeric($value) ? (int)$value : null;
                } else {
                    $listingData[$col] = ($value === '') ? null : $value;
                }
            }

            // Set Status based on Active field
            if (isset($listingData['Active'])) {
                $listingData['Status'] = ((int)$listingData['Active'] === 1) ? 'valid' : 'invalid';
            } else {
                $listingData['Status'] = 'invalid';
            }
            // Check if ListingID already exists
            if (!empty($listingData['ListingID'])) {
                $exists = DB::table('listings')->where('ListingID', $listingData['ListingID'])->exists();
                if ($exists) {
                    $skipCount++;
                    continue;
                }
            } else {
                Log::warning("Missing ListingID at row {$rowCount}. Skipping.");
                $skipCount++;
                continue;
            }

            // Insert into DB
            try {
                $listingData['created_at'] = now();
                $listingData['updated_at'] = now();
                $listingData['ListingID'] = $row[array_search('ListingID', $csvHeaders)];
                DB::table('listings')->insert($listingData);
                $insertCount++;
            } catch (\Exception $e) {
                Log::error("Insert failed at row {$rowCount}.", [
                    'data' => $listingData,
                    'error' => $e->getMessage()
                ]);
            }
        }

        fclose($handle);

        return back()->with('success', "CSV import completed. Total rows: {$rowCount}, Inserted: {$insertCount}, Skipped (existing or invalid): {$skipCount}");
    }
    public function agentImportCsv(Request $request)
    {
        set_time_limit(0);
        $request->validate([
            'file' => 'required|mimes:csv,txt',
        ]);

        $file = $request->file('file');

        if (($handle = fopen($file->getRealPath(), 'r')) === false) {
            return back()->with('error', 'Unable to open CSV file.');
        }

        // Read header row
        $csvHeaders = fgetcsv($handle);
        if (!$csvHeaders) {
            return back()->with('error', 'CSV file is empty or invalid.');
        }

        $csvHeaders = array_map('trim', $csvHeaders);

        // Define expected CSV columns
        $expectedColumns = [
            'AgentTableID',
            'AgentID',
            'LName',
            'FName',
            'Spouse',
            'SpLName',
            'SpFName',
            'Address1',
            'Address2',
            'City',
            'State',
            'Zip',
            'Telephone',
            'Pager',
            'CellPhone',
            'Fax',
            'Email',
            'SocSecNum',
            'DOB',
            'HireDate',
            'License',
            'Termination',
            'Active',
            'Comments',
            'Extension',
            'Display',
            'image',
            'Profile',
            'EmailFlag',
            'Renewal',
            'EmailPW',
            'AgentUserRegisterId'
        ];

        // User fields (used for creating users table)
        $userFields = ['FName', 'Email', 'Telephone'];

        // Agent fields are everything else
        //$agentFields = array_diff($expectedColumns, $userFields);

        $integerColumns = ['Telephone', 'Fax'];
        $rowCount = 0;
        $insertCount = 0;
        $skipCount = 0;

        while (($row = fgetcsv($handle)) !== false) {
            $rowCount++;
            $userData = [];
            $agentData = [];

            foreach ($expectedColumns as $col) {
                $csvIndex = array_search($col, $csvHeaders);
                $value = ($csvIndex !== false && isset($row[$csvIndex])) ? trim($row[$csvIndex]) : null;
                $value = mb_convert_encoding($value, 'UTF-8', 'UTF-8');
                $value = preg_replace('/[^\PC\s]/u', '', $value);
                if (strtoupper($value) === 'NULL' || $value === '') {
                    $value = null;
                }

                if (in_array($col, $userFields)) {
                    $userData[$col] = $value;
                } else {
                    if (in_array($col, $integerColumns)) {
                        $agentData[$col] = is_numeric($value) ? (int)$value : null;
                    } elseif (in_array($col, ['DOB', 'HireDate', 'Termination'])) {
                        $agentData[$col] = $this->parseDate($value);
                    } else {
                        $agentData[$col] = $value;
                    }
                }
            }

            // Skip if email is missing, null string, or already exists
            /*  if (empty($userData['Email']) || strtolower(trim($userData['Email'])) === 'null' || User::where('email', $userData['Email'])->exists()) {
                Log::warning("Skipped row {$rowCount} due to missing or duplicate email: " . ($userData['Email'] ?? 'N/A'));
                $skipCount++;
                continue;
            } */
            $agentID = $row[array_search('AgentID', $csvHeaders)];

            // Log or skip if BuyerID is missing
            if (!$agentID) {
                Log::warning("Missing AgentID at row {$rowCount}, skipping.");
                $skipCount++;
                continue;
            }

            // Skip if BuyerID already exists
            if (Agent::where('AgentID', $agentID)->exists()) {
                Log::info("Skipped row {$rowCount} — Agent already exists with AgentID: {$agentID}");
                $skipCount++;
                continue;
            }
            // Process email
            $email = strtolower(trim($userData['Email'] ?? ''));
            // If email is missing or invalid, generate a unique one
            if (empty($email) || $email === 'null' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $email = $this->generateUniqueEmailAgent($userData['FName'] ?? 'agent');
            } elseif (User::where('email', $email)->exists()) {
                // Generate new unique email
                $email = $this->generateUniqueEmailAgent($userData['FName'] ?? 'agent');
                Log::warning("Duplicate email found. Generated new email for AgentID {$agentID}: {$email}");
            }
            $userData['Email'] = $email;

            try {
                DB::beginTransaction();

                $user = User::create([
                    'name' => $userData['FName'] ?? 'Unknown',
                    'email' => $userData['Email'] ?? null,
                    'phone' => $userData['Telephone'] ?? null,
                    'password' => Hash::make('default12345'),
                    'role_name' => 'agent'
                ]);

                $agentData['AgentUserRegisterId'] = $user->id;
                $agentData['FName'] = $userData['FName'] ?? null;
                $agentData['Email'] = $userData['Email'] ?? null;
                $agentData['Telephone'] = $userData['Telephone'] ?? null;

                Agent::create($agentData);

                DB::commit();
                $insertCount++;
                /* break; */
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error("Insert failed at row {$rowCount}.", [
                    'data' => $agentData,
                    'error' => $e->getMessage()
                ]);
                $skipCount++;
            }
        }

        fclose($handle);

        return back()->with('success', "CSV import completed. Total rows: {$rowCount}, Inserted: {$insertCount}, Skipped: {$skipCount}");
    }
    private function generateUniqueEmailAgent($baseName = 'agent')
    {
        do {
            $randomPart = uniqid(strtolower($baseName) . '_');
            $email = $randomPart . '@example.com';
        } while (User::where('email', $email)->exists());

        return $email;
    }
    public function buyerImportCsv(Request $request)
    {
        set_time_limit(0);
        $request->validate([
            'file' => 'required|mimes:csv,txt',
        ]);

        $file = $request->file('file');

        if (($handle = fopen($file->getRealPath(), 'r')) === false) {
            return back()->with('error', 'Unable to open CSV file.');
        }

        // Read header row
        $csvHeaders = fgetcsv($handle);
        if (!$csvHeaders) {
            return back()->with('error', 'CSV file is empty or invalid.');
        }

        $csvHeaders = array_map(function ($header) {
            return trim($header);
        }, $csvHeaders);

        // Define expected CSV columns
        $expectedColumns = [
            'BuyerID',
            'BDate',
            'AgentID',
            'LName',
            'FName',
            'Honorific',
            'NName',
            'Corp',
            'Address1',
            'Address2',
            'City',
            'State',
            'Zip',
            'County',
            'DLNo',
            'SocSecNo',
            'BusPhone',
            'HomePhone',
            'Pager',
            'Fax',
            'Email',
            'CallWhen',
            'PartnerName',
            'PartnerPhone',
            'BusType1',
            'BusType2',
            'BusType3',
            'BusType4',
            'BusLocation',
            'BusCounty1',
            'BusCounty2',
            'BusCounty3',
            'BusCounty4',
            'Group',
            'PPMin',
            'PPMax',
            'DownPmtMin',
            'DownPmtMax',
            'VolMin',
            'VolMax',
            'NetProfMin',
            'NetProfMax',
            'TypeBus',
            'NetWorth',
            'CashAvailable',
            'CurrentEmploy',
            'Interest',
            'Active',
            'Comments',
            'DateEntered',
            'EnteredBy',
            'Signed',
            'BuyerType',
            'OptOut',
            'ExpDate',
            'ValidEmail',
            'BusInt',
            'Location',
            'Price',
            'DownPay',
            'Profit',
            'SalesVol',
            'Dup',
            'MasterID',
            'Welcome',
            'emailmatch',
            'phonematch'
        ];

        // User fields (used for creating users table)
        $userFields = ['FName', 'Email'];

        // Agent fields are everything else
        //$agentFields = array_diff($expectedColumns, $userFields);

        $integerColumns = ['HomePhone', 'Fax'];
        $rowCount = 0;
        $insertCount = 0;
        $skipCount = 0;

        while (($row = fgetcsv($handle)) !== false) {
            $rowCount++;
            $userData = [];
            $buyerData = [];

            foreach ($expectedColumns as $col) {
                $csvIndex = array_search($col, $csvHeaders);
                $value = ($csvIndex !== false && isset($row[$csvIndex])) ? trim($row[$csvIndex]) : null;
                $value = mb_convert_encoding($value, 'UTF-8', 'UTF-8');
                $value = preg_replace('/[^\PC\s]/u', '', $value);
                if (strtoupper($value) === 'NULL' || $value === '') {
                    $value = null;
                }

                if (in_array($col, $userFields)) {
                    $userData[$col] = $value;
                } else {
                    if (in_array($col, $integerColumns)) {
                        $buyerData[$col] = is_numeric($value) ? (int)$value : null;
                    } elseif (in_array($col, ['BDate', 'DateEntered', 'ExpDate'])) {
                        $buyerData[$col] = $this->parseDate($value);
                    } else {
                        $buyerData[$col] = $value;
                    }
                }
            }
            $buyerID = $row[array_search('BuyerID', $csvHeaders)];

            // Log or skip if BuyerID is missing
            if (!$buyerID) {
                Log::warning("Missing BuyerID at row {$rowCount}, skipping.");
                $skipCount++;
                continue;
            }

            // Skip if BuyerID already exists
            if (Buyer::where('BuyerID', $buyerID)->exists()) {
                Log::info("Skipped row {$rowCount} — Buyer already exists with BuyerID: {$buyerID}");
                $skipCount++;
                continue;
            }
            // Process email
            $email = strtolower(trim($userData['Email'] ?? ''));
            // If email is missing or invalid, generate a unique one
            if (empty($email) || $email === 'null' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $email = $this->generateUniqueEmail($userData['FName'] ?? 'buyer');
            } elseif (User::where('email', $email)->exists()) {
                // Generate new unique email
                $email = $this->generateUniqueEmail($userData['FName'] ?? 'buyer');
                Log::warning("Duplicate email found. Generated new email for BuyerID {$buyerID}: {$email}");
            }
            $userData['Email'] = $email;

            try {
                DB::beginTransaction();

                $user = User::create([
                    'name' => $userData['FName'] ?? 'Unknown',
                    'email' => $userData['Email'] ?? null,
                    'password' => Hash::make('default12345'),
                    'role_name' => 'buyer'
                ]);
                $buyerData['BuyerID'] = $row[array_search('BuyerID', $csvHeaders)];
                $buyerData['user_id'] = $user->id;
                $buyerData['FName'] = $userData['FName'] ?? null;
                $buyerData['Email'] = $userData['Email'] ?? null;
                Buyer::create($buyerData);

                DB::commit();
                $insertCount++;
                /*  break; */
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error("Insert failed at row {$rowCount}.", [
                    'data' => $buyerData,
                    'error' => $e->getMessage()
                ]);
                $skipCount++;
            }
        }

        fclose($handle);

        return back()->with('success', "CSV import completed. Total rows: {$rowCount}, Inserted: {$insertCount}, Skipped: {$skipCount}");
    }
    private function generateUniqueEmail($baseName = 'buyer')
    {
        do {
            $randomPart = uniqid(strtolower($baseName) . '_');
            $email = $randomPart . '@example.com';
        } while (User::where('email', $email)->exists());

        return $email;
    }
    private function parseDate($date)
    {
        if (empty($date)) {
            return null;
        }

        // Normalize whitespace
        $date = preg_replace('/\s+/', ' ', trim($date));

        // Try these formats (including Y-m-d H:i:s)
        $formats = ['Y-m-d H:i:s', 'Y-m-d', 'd-m-Y H:i', 'd-m-Y', 'm/d/Y'];

        foreach ($formats as $format) {
            try {
                $dt = \Carbon\Carbon::createFromFormat($format, $date);
                return $dt->format('Y-m-d'); // Standardize to Y-m-d for DB
            } catch (\Exception $e) {
                continue;
            }
        }

        Log::warning("Date parsing failed: " . $date);
        return null;
    }

    public function subCategoryImportCsv(Request $request)
    {
        set_time_limit(0);

        $request->validate([
            'file' => 'required|mimes:csv,txt',
        ]);

        $file = $request->file('file');

        if (($handle = fopen($file->getRealPath(), 'r')) === false) {
            return back()->with('error', 'Unable to open CSV file.');
        }

        // Read and normalize header row
        $rawHeaders = fgetcsv($handle);
        if (!$rawHeaders) {
            return back()->with('error', 'CSV file is empty or invalid.');
        }

        // Remove BOM if present
        $rawHeaders[0] = preg_replace('/^\xEF\xBB\xBF/', '', $rawHeaders[0]);

        // Normalize headers: trim + lowercase
        $csvHeaders = array_map(function ($header) {
            return strtolower(trim($header));
        }, $rawHeaders);

        // Log or print the cleaned headers for verification
        Log::info('Parsed CSV headers: ', $csvHeaders);

        // Expected fields
        $expectedColumns = ['subcatid', 'subcategory', 'catid'];
        $columnMap = [];

        // Create a map between expected and actual CSV headers
        foreach ($expectedColumns as $expected) {
            $index = array_search($expected, $csvHeaders);
            if ($index === false) {
                return back()->with('error', "Missing expected column: '{$expected}' in CSV. Found headers: " . implode(', ', $csvHeaders));
            }
            $columnMap[$expected] = $index;
        }

        // Initialize counters
        $rowCount = 0;
        $insertCount = 0;
        $skipCount = 0;

        while (($row = fgetcsv($handle)) !== false) {
            $rowCount++;

            // Build row data using mapped indices
            $subCategoryData = [];
            foreach ($expectedColumns as $col) {
                $index = $columnMap[$col];
                $value = isset($row[$index]) ? trim($row[$index]) : null;
                $value = mb_convert_encoding($value, 'UTF-8', 'UTF-8');
                $value = preg_replace('/[^\PC\s]/u', '', $value);
                if (strtoupper($value) === 'NULL' || $value === '' || $value === '0') {
                    $value = null;
                }

                // Optional: Capitalize for DB keys (if your DB uses SubCatID, etc.)
                $subCategoryData[ucfirst($col)] = $value;
            }

            // Validate SubCatID
            if (empty($subCategoryData['Subcatid'])) {
                Log::warning("Missing SubCatID at row {$rowCount}. Skipping. Row data: " . json_encode($row));
                $skipCount++;
                continue;
            }

            // Skip duplicates
            if (DB::table('sub_categories')->where('SubCatID', $subCategoryData['Subcatid'])->exists()) {
                $skipCount++;
                continue;
            }
            $subCategoryData['created_at'] = now();  // Current timestamp
            $subCategoryData['updated_at'] = now();  // Current timestamp
            try {
                DB::table('sub_categories')->insert($subCategoryData);
                $insertCount++;
            } catch (\Exception $e) {
                Log::error("Insert failed at row {$rowCount}: " . $e->getMessage(), $subCategoryData);
                $skipCount++;
            }
        }

        fclose($handle);

        return back()->with('success', "CSV import completed. Total rows: {$rowCount}, Inserted: {$insertCount}, Skipped: {$skipCount}");
    }
    public function leadImportCsv(Request $request)
    {
        set_time_limit(0);

        // Validate the file input
        $request->validate([
            'file' => 'required|mimes:csv,txt',
        ]);

        $file = $request->file('file');

        if (($handle = fopen($file->getRealPath(), 'r')) === false) {
            return back()->with('error', 'Unable to open CSV file.');
        }

        // Read and normalize header row
        $csvHeaders = fgetcsv($handle);
        if (!$csvHeaders) {
            return back()->with('error', 'CSV file is empty or invalid.');
        }

        $csvHeaders = array_map(function ($header) {
            // Remove BOM and trim whitespace
            return trim(preg_replace('/^\xEF\xBB\xBF/', '', $header));
        }, $csvHeaders);
        Log::info('CSV Headers:', $csvHeaders);

        // Expected database columns
        $expectedColumns = [
            'LeadID',
            'Status',
            'BusName',
            'Address',
            'City',
            'State',
            'Zip',
            'County',
            'Category',
            'SubCategory',
            'Source',
            'Price',
            'DownPay',
            'AdCopy',
            'AdDate',
            'Phone',
            'Comments',
            'AgentID',
            'LDate',
            'Listed',
            'SellerFName',
            'SellerLName',
            'AppointmentDate',
            'AppointmentTime',
            'FSBO',
            'HomePhone',
            'CellPhone',
            'RealEstateInc',
            'REAsking',
            'AnnSales',
            'YearsInBus',
            'PresentOwner',
            'SizeOfFacility',
            'EnteredBy'
        ];

        $integerColumns = ['Phone', 'HomePhone', 'CellPhone'];
        $rowCount = 0;
        $insertCount = 0;
        $skipCount = 0;

        // Process CSV rows
        while (($row = fgetcsv($handle)) !== false) {
            $rowCount++;

            // Optional: log first few rows for inspection
            if ($rowCount <= 3) {
                Log::info("Row $rowCount:", $row);
            }

            $leadData = [];

            foreach ($expectedColumns as $col) {
                $csvIndex = array_search($col, $csvHeaders);
                $value = ($csvIndex !== false && isset($row[$csvIndex])) ? trim($row[$csvIndex]) : null;

                // Clean encoding and characters
                $value = mb_convert_encoding($value, 'UTF-8', 'UTF-8');
                $value = preg_replace('/[^\PC\s]/u', '', $value);

                if (strtoupper($value) === 'NULL' || $value === '') {
                    $value = null;
                }
                // Convert AppointmentTime from 12-hour to 24-hour format
                if ($col === 'AppointmentTime' && !empty($value)) {
                    try {
                        $dt = \DateTime::createFromFormat('g:i A', $value);
                        if ($dt) {
                            $value = $dt->format('H:i:s');
                        } else {
                            Log::warning("Invalid time format at row {$rowCount}: {$value}");
                            $value = null;
                        }
                    } catch (\Exception $e) {
                        Log::error("Time parsing failed at row {$rowCount}: {$value}", ['error' => $e->getMessage()]);
                        $value = null;
                    }
                }
                // Handle numeric fields
                if (in_array($col, $integerColumns)) {
                    $leadData[$col] = is_numeric($value) ? (int)$value : null;
                } else {
                    $leadData[$col] = $value;
                }
            }

            // Check for LeadID
            $leadID = $leadData['LeadID'] ?? null;
            Log::debug("Row $rowCount LeadID:", ['lead_id' => $leadID]);

            if (empty($leadID)) {
                Log::warning("Missing LeadID at row {$rowCount}. Skipping.");
                $skipCount++;
                continue;
            }

            // Optional: check if record exists
            $exists = DB::table('leads')->where('LeadID', $leadID)->exists();
            if ($exists) {
                $skipCount++;
                continue;
            }

            // Insert the first valid row and exit
            try {
                $leadData['created_at'] = now();  // Current timestamp
                $leadData['updated_at'] = now();  // Current timestamp
                DB::table('leads')->insert($leadData);
                $insertCount++;
                Log::info("Inserted row $rowCount with LeadID: $leadID");
                /* break;  */
            } catch (\Exception $e) {
                Log::error("Insert failed at row {$rowCount}.", [
                    'data' => $leadData,
                    'error' => $e->getMessage()
                ]);
                $skipCount++;
            }
        }

        fclose($handle);

        return back()->with('success', "CSV import completed. Total rows scanned: {$rowCount}, Inserted: {$insertCount}, Skipped: {$skipCount}");
    }
    public function offerImportCsv(Request $request)
    {
        set_time_limit(0);

        // Validate the file input
        $request->validate([
            'file' => 'required|mimes:csv,txt',
        ]);

        $file = $request->file('file');

        if (($handle = fopen($file->getRealPath(), 'r')) === false) {
            return back()->with('error', 'Unable to open CSV file.');
        }

        // Read and normalize header row
        $csvHeaders = fgetcsv($handle);
        if (!$csvHeaders) {
            return back()->with('error', 'CSV file is empty or invalid.');
        }

        $csvHeaders = array_map(function ($header) {
            // Remove BOM and trim whitespace
            return trim(preg_replace('/^\xEF\xBB\xBF/', '', $header));
        }, $csvHeaders);
        Log::info('CSV Headers:', $csvHeaders);

        // Expected database columns
        $expectedColumns = [
            'OfferID',
            'BuyerID',
            'ListingID',
            'ListingAgent',
            'SellingAgent',
            'ResidListingAgent',
            'ResidBuyerAgent',
            'DateOfOffer',
            'UnderContract',
            'OfferPrice',
            'OffDeposit',
            'OffAddlDep',
            'OffBalDownPay',
            'OffDownPay',
            'OffAssump',
            'OffAssump2',
            'OffBalDue',
            'OffPerMonth',
            'OffInterest',
            'OffAddTerms',
            'OffInvInc',
            'OffMaxInv',
            'AccPrice',
            'AccDeposit',
            'AccAddlDep',
            'AccBalDownPay',
            'AccDownPay',
            'AccAssump',
            'AccAssump2',
            'AccBalDue',
            'AccPerMonth',
            'AccInt',
            'AccAddTerm',
            'AccInvInc',
            'AccMaxInv',
            'COfferPrice',
            'COffDeposit',
            'COffAddlDep',
            'COffBalDownPay',
            'COffDownPay',
            'COffAssump',
            'COffAssump2',
            'COffBalDue',
            'COffPerMonth',
            'COffInterest',
            'COffAddTerms',
            'COffInvInc',
            'COffMaxInv',
            'CloseDate',
            'RealEstateInc',
            'REPrice',
            'RETerms',
            'REDownPay',
            'REBal',
            'OpToBuy',
            'OpPrice',
            'OpTerms',
            'OpDownPay',
            'OpBal',
            'LeaseTerm',
            'LeaseNoYears',
            'LeaseDolMonth',
            'LeaseOptions',
            'AddAdj',
            'Contingencies',
            'Comments',
            'Commission',
            'CommissionPct',
            'Status',
            'ExpDate',
            'AccDate',
            'DateEntered',
            'EnteredBy',
            'SAttnID',
            'BAttnID',
            'PartID',
            'ClosingDate',
            'PurchasePrice',
            'DownPaymnt',
            'BalanceDue',
            'BAcctID',
            'SAcctID',
            'RefID',
            'RefFee',
            'LLID',
            'TransAmt',
            'DepositCheckNumber',
            'CheckAmt',
            'BankDraw',
            'DateDeposited',
            'RealEstateTrans',
            'CheckReturned',
            'CheckEBBReturnNumber',
            'CheckReturnedTo',
            'ReturneeRelationship',
            'ReturneeName',
            'ReturneeAddress',
            'ReturneeCity',
            'ReturneeState',
            'ReturneeZip',
            'ReturneePhone',
            'DBA',
            'Bounced',
            'BounceReason',
            'CheckOnHold',
            'NameOnCheck',
            'SchedCloseDate',
            'SchedCloseTime',
            'SchedClosePlace',
            'AttorneyLetters',
            'AnticipationLetters',
            'BuyerAttorney',
            'SellerAttorney',
            'BuyerAccountant',
            'SellerAccountant',
            'Landlord',
            'Referral',
            'ReferralFeePaid',
            'offer_step'
        ];

        $integerColumns = ['Phone', 'HomePhone', 'CellPhone'];
        $rowCount = 0;
        $insertCount = 0;
        $skipCount = 0;

        // Process CSV rows
        while (($row = fgetcsv($handle)) !== false) {
            $rowCount++;
            $offerData = [];

            foreach ($expectedColumns as $col) {
                $csvIndex = array_search($col, $csvHeaders);
                $value = ($csvIndex !== false && isset($row[$csvIndex])) ? trim($row[$csvIndex]) : null;

                // Clean encoding and characters
                $value = mb_convert_encoding($value, 'UTF-8', 'UTF-8');
                $value = preg_replace('/[^\PC\s]/u', '', $value);

                if (strtoupper($value) === 'NULL' || $value === '') {
                    $value = null;
                } elseif (in_array($col, ['BuyerID', 'ListingID']) && $value === '0') {
                    $value = null;
                }
                $zeroIfNullCols = ['BAcctID', 'SAcctID', 'RefID', 'LLID'];
                if (in_array($col, $zeroIfNullCols) && is_null($value)) {
                    $value = 0;
                }
                // Handle numeric fields
                if (in_array($col, $integerColumns)) {
                    $offerData[$col] = is_numeric($value) ? (int)$value : null;
                } else {
                    $offerData[$col] = $value;
                }
            }

            // Check for LeadID
            $offerID = $offerData['OfferID'] ?? null;
            Log::debug("Row $rowCount OfferID:", ['OfferID' => $offerID]);

            if (empty($offerID)) {
                Log::warning("Missing OfferID at row {$rowCount}. Skipping.");
                $skipCount++;
                continue;
            }

            // Optional: check if record exists
            $exists = DB::table('offers')->where('OfferID', $offerID)->exists();
            if ($exists) {
                $skipCount++;
                continue;
            }

            // Insert the first valid row and exit
            try {
                $offerData['created_at'] = now();
                $offerData['updated_at'] = now();
                $offerData['OfferID'] = $row[array_search('OfferID', $csvHeaders)];
                DB::table('offers')->insert($offerData);
                $insertCount++;
                Log::info("Inserted row $rowCount with OfferID: $offerID");
            } catch (\Exception $e) {
                Log::error("Insert failed at row {$rowCount}.", [
                    'data' => $offerData,
                    'error' => $e->getMessage()
                ]);
                $skipCount++;
            }
        }

        fclose($handle);

        return back()->with('success', "CSV import completed. Total rows scanned: {$rowCount}, Inserted: {$insertCount}, Skipped: {$skipCount}");
    }
    public function contactImportCsv(Request $request)
    {
        set_time_limit(0);

        // Validate the file input
        $request->validate([
            'file' => 'required|mimes:csv,txt',
        ]);

        $file = $request->file('file');

        if (($handle = fopen($file->getRealPath(), 'r')) === false) {
            return back()->with('error', 'Unable to open CSV file.');
        }

        // Read and normalize header row
        $csvHeaders = fgetcsv($handle);
        if (!$csvHeaders) {
            return back()->with('error', 'CSV file is empty or invalid.');
        }

        $csvHeaders = array_map(function ($header) {
            // Remove BOM and trim whitespace
            return trim(preg_replace('/^\xEF\xBB\xBF/', '', $header));
        }, $csvHeaders);
        Log::info('CSV Headers:', $csvHeaders);

        // Expected database columns
        $expectedColumns = [
            'ContactID',
            'LName',
            'FName',
            'CompanyName',
            'AddRep',
            'Address1',
            'Address2',
            'City',
            'State',
            'Zip',
            'Phone',
            'Fax',
            'Pager',
            'Email',
            'Type',
            'Comments'
        ];

        $integerColumns = ['Phone', 'Fax', 'Pager'];
        $rowCount = 0;
        $insertCount = 0;
        $skipCount = 0;

        // Process CSV rows
        while (($row = fgetcsv($handle)) !== false) {
            $rowCount++;
            $contactData = [];

            foreach ($expectedColumns as $col) {
                $csvIndex = array_search($col, $csvHeaders);
                $value = ($csvIndex !== false && isset($row[$csvIndex])) ? trim($row[$csvIndex]) : null;

                // Clean encoding and characters
                $value = mb_convert_encoding($value, 'UTF-8', 'UTF-8');
                $value = preg_replace('/[^\PC\s]/u', '', $value);

                if (strtoupper($value) === 'NULL' || $value === '') {
                    $value = null;
                }
                // Handle numeric fields
                if (in_array($col, $integerColumns)) {
                    $contactData[$col] = is_numeric($value) ? (int)$value : null;
                } else {
                    $contactData[$col] = $value;
                }
            }
            $ContactID = $contactData['ContactID'] ?? null;
            if (empty($ContactID)) {
                Log::warning("Missing ContactID at row {$rowCount}. Skipping.");
                $skipCount++;
                continue;
            }

            // Optional: check if record exists
            $exists = DB::table('contacts')->where('ContactID', $ContactID)->exists();
            if ($exists) {
                $skipCount++;
                continue;
            }

            // Insert the first valid row and exit
            try {
                $contactData['created_at'] = now();
                $contactData['updated_at'] = now();
                $contactData['ContactID'] = $row[array_search('ContactID', $csvHeaders)];
                DB::table('contacts')->insert($contactData);
                $insertCount++;
                Log::info("Inserted row $rowCount with ContactID: $ContactID");
            } catch (\Exception $e) {
                Log::error("Insert failed at row {$rowCount}.", [
                    'data' => $contactData,
                    'error' => $e->getMessage()
                ]);
                $skipCount++;
            }
        }

        fclose($handle);

        return back()->with('success', "CSV import completed. Total rows scanned: {$rowCount}, Inserted: {$insertCount}, Skipped: {$skipCount}");
    }
    public function probMatchImportCsv(Request $request)
    {
        set_time_limit(0);

        // Validate the file input
        $request->validate([
            'file' => 'required|mimes:csv,txt',
        ]);

        $file = $request->file('file');

        if (($handle = fopen($file->getRealPath(), 'r')) === false) {
            return back()->with('error', 'Unable to open CSV file.');
        }

        // Read and normalize header row
        $csvHeaders = fgetcsv($handle);
        if (!$csvHeaders) {
            return back()->with('error', 'CSV file is empty or invalid.');
        }

        $csvHeaders = array_map(function ($header) {
            // Remove BOM and trim whitespace
            return trim(preg_replace('/^\xEF\xBB\xBF/', '', $header));
        }, $csvHeaders);
        Log::info('CSV Headers:', $csvHeaders);

        // Expected database columns
        $expectedColumns = [
            'BuyerID',
            'ListingID',
            'BusInt',
            'Location',
            'Price',
            'DownPay',
            'Vol',
            'Profit',
            'Overall',
            'DateRank'
        ];
        $rowCount = 0;
        $insertCount = 0;
        $skipCount = 0;

        // Process CSV rows
        while (($row = fgetcsv($handle)) !== false) {
            $rowCount++;
            $probMatchData = [];

            foreach ($expectedColumns as $col) {
                $csvIndex = array_search($col, $csvHeaders);
                $value = ($csvIndex !== false && isset($row[$csvIndex])) ? trim($row[$csvIndex]) : null;

                // Clean encoding and characters
                $value = mb_convert_encoding($value, 'UTF-8', 'UTF-8');
                $value = preg_replace('/[^\PC\s]/u', '', $value);

                if (strtoupper($value) === 'NULL' || $value === '') {
                    $value = null;
                }
                $probMatchData[$col] = $value;
            }
            // Insert the first valid row and exit
            try {
                $probMatchData['created_at'] = now();
                $probMatchData['updated_at'] = now();
                DB::table('prob_matchs')->insert($probMatchData);
                $insertCount++;
            } catch (\Exception $e) {
                Log::error("Insert failed at row {$rowCount}.", [
                    'data' => $probMatchData,
                    'error' => $e->getMessage()
                ]);
                $skipCount++;
            }
        }

        fclose($handle);

        return back()->with('success', "CSV import completed. Total rows scanned: {$rowCount}, Inserted: {$insertCount}, Skipped: {$skipCount}");
    }
    public function referralsImportCsv(Request $request)
    {
        set_time_limit(0);

        // Validate the file input
        $request->validate([
            'file' => 'required|mimes:csv,txt',
        ]);

        $file = $request->file('file');

        if (($handle = fopen($file->getRealPath(), 'r')) === false) {
            return back()->with('error', 'Unable to open CSV file.');
        }

        // Read and normalize header row
        $csvHeaders = fgetcsv($handle);
        if (!$csvHeaders) {
            return back()->with('error', 'CSV file is empty or invalid.');
        }

        $csvHeaders = array_map(function ($header) {
            // Remove BOM and trim whitespace
            return trim(preg_replace('/^\xEF\xBB\xBF/', '', $header));
        }, $csvHeaders);
        Log::info('CSV Headers:', $csvHeaders);

        // Expected database columns
        $expectedColumns = [
            'RefID',
            'RefCompany',
            'BrokOfRec',
            'AgentName',
            'Address1',
            'Address2',
            'City',
            'State',
            'Zip',
            'Phone',
            'RefFee',
            'RefFeePer',
            'RefAmt',
            'FlatFee',
            'RefSource',
            'RefDir',
            'RefType',
            'Comments',
            'Fax',
            'ReferredName',
            'ReferredAdd1',
            'ReferredAdd2',
            'ReferredCity',
            'ReferredState',
            'ReferredZip',
            'ReferredPhone',
            'ReferredInterest',
            'ReferredDBA'
        ];

        $integerColumns = ['Phone', 'Fax'];
        $rowCount = 0;
        $insertCount = 0;
        $skipCount = 0;

        // Process CSV rows
        while (($row = fgetcsv($handle)) !== false) {
            $rowCount++;
            $referralData = [];

            foreach ($expectedColumns as $col) {
                $csvIndex = array_search($col, $csvHeaders);
                $value = ($csvIndex !== false && isset($row[$csvIndex])) ? trim($row[$csvIndex]) : null;

                // Clean encoding and characters
                $value = mb_convert_encoding($value, 'UTF-8', 'UTF-8');
                $value = preg_replace('/[^\PC\s]/u', '', $value);

                if (strtoupper($value) === 'NULL' || $value === '') {
                    $value = null;
                }
                // Handle numeric fields
                if (in_array($col, $integerColumns)) {
                    $referralData[$col] = is_numeric($value) ? (int)$value : null;
                } else {
                    $referralData[$col] = $value;
                }
            }
            $RefID = $referralData['RefID'] ?? null;
            if (empty($RefID)) {
                Log::warning("Missing RefID at row {$rowCount}. Skipping.");
                $skipCount++;
                continue;
            }

            // Optional: check if record exists
            $exists = DB::table('referrals')->where('RefID', $RefID)->exists();
            if ($exists) {
                Log::info("Row {$rowCount} skipped. RefID {$RefID} already exists.");
                $skipCount++;
                continue;
            }

            // Insert the first valid row and exit
            try {
                Log::debug("Attempting to insert row {$rowCount}: ", $referralData);
                $referralData['created_at'] = now();
                $referralData['updated_at'] = now();
                $referralData['RefID'] = $row[array_search('RefID', $csvHeaders)];
                DB::table('referrals')->insert($referralData);
                $insertCount++;
                Log::info("Inserted row $rowCount with ContactID: $RefID");
            } catch (\Exception $e) {
                Log::error("Insert failed at row {$rowCount}.", [
                    'data' => $referralData,
                    'error' => $e->getMessage()
                ]);
                $skipCount++;
            }
        }

        fclose($handle);

        return back()->with('success', "CSV import completed. Total rows scanned: {$rowCount}, Inserted: {$insertCount}, Skipped: {$skipCount}");
    }
    public function showingsImportCsv(Request $request)
    {
        set_time_limit(0);

        // Validate the file input
        $request->validate([
            'file' => 'required|mimes:csv,txt',
        ]);

        $file = $request->file('file');

        if (($handle = fopen($file->getRealPath(), 'r')) === false) {
            return back()->with('error', 'Unable to open CSV file.');
        }

        // Read and normalize header row
        $csvHeaders = fgetcsv($handle);
        if (!$csvHeaders) {
            return back()->with('error', 'CSV file is empty or invalid.');
        }

        $csvHeaders = array_map(function ($header) {
            // Remove BOM and trim whitespace
            return trim(preg_replace('/^\xEF\xBB\xBF/', '', $header));
        }, $csvHeaders);
        Log::info('CSV Headers:', $csvHeaders);

        // Expected database columns
        $expectedColumns = [
            'ShowingID',
            'AgentID',
            'Date',
            'BuyerID',
            'ListingID',
            'OfferMade',
            'FollowUp',
            'Notes',
            'Verbal',
            'DateEntered',
            'EnteredBy',
            'Dup',
            'Display'
        ];
        $rowCount = 0;
        $insertCount = 0;
        $skipCount = 0;

        // Process CSV rows
        while (($row = fgetcsv($handle)) !== false) {
            $rowCount++;
            $showingData = [];

            foreach ($expectedColumns as $col) {
                $csvIndex = array_search($col, $csvHeaders);
                $value = ($csvIndex !== false && isset($row[$csvIndex])) ? trim($row[$csvIndex]) : null;

                // Clean encoding and characters
                $value = mb_convert_encoding($value, 'UTF-8', 'UTF-8');
                $value = preg_replace('/[^\PC\s]/u', '', $value);

                if (strtoupper($value) === 'NULL' || $value === '') {
                    $value = ($col === 'OfferMade') ? 0 : null;
                }

                $showingData[$col] = $value;
            }
            $ShowingID = $showingData['ShowingID'] ?? null;
            if (empty($ShowingID)) {
                Log::warning("Missing ShowingID at row {$rowCount}. Skipping.");
                $skipCount++;
                continue;
            }

            // Optional: check if record exists
            $exists = DB::table('showings')->where('ShowingID', $ShowingID)->exists();
            if ($exists) {
                /*  Log::info("Row {$rowCount} skipped. ShowingID {$ShowingID} already exists."); */
                $skipCount++;
                continue;
            }

            // Insert the first valid row and exit
            try {
                /* Log::debug("Attempting to insert row {$rowCount}: ", $showingData); */
                $showingData['created_at'] = now();
                $showingData['updated_at'] = now();
                $showingData['ShowingID'] = $row[array_search('ShowingID', $csvHeaders)];
                DB::table('showings')->insert($showingData);
                $insertCount++;
                /* Log::info("Inserted row $rowCount with ShowingID: $ShowingID"); */
            } catch (\Exception $e) {
                Log::error("Insert failed at row {$rowCount}.", [
                    'data' => $showingData,
                    'error' => $e->getMessage()
                ]);
                $skipCount++;
            }
        }

        fclose($handle);

        return back()->with('success', "CSV import completed. Total rows scanned: {$rowCount}, Inserted: {$insertCount}, Skipped: {$skipCount}");
    }
}
