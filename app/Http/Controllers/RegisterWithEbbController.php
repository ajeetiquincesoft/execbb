<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buyer;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Agent;
use App\Models\SignNda;
use Illuminate\Support\Facades\Hash;
use App\Events\BuyerRegister;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;
use Dompdf\Dompdf;
use Dompdf\Options;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RegisterWithEbbController extends Controller
{
    public function downloadPdf()
    {
        // ✅ DomPDF options
        $options = new Options();
        $options->set('isRemoteEnabled', true); // allow images
        $options->set('isHtml5ParserEnabled', true);

        $dompdf = new Dompdf($options);

        // ✅ Image path
        $imagePath = public_path('nda_signatures/sign_1771588268.png');

        // Check file exists
        if (!file_exists($imagePath)) {
            abort(404, 'Image not found');
        }

        // ✅ Convert image to base64 (MOST IMPORTANT)
        $imageBase64 = base64_encode(file_get_contents($imagePath));
        $imageSrc = 'data:image/png;base64,' . $imageBase64;

        // ✅ HTML content
        $html = '
        <html>
        <head>
            <style>
                body { font-family: DejaVu Sans, sans-serif; }
                .img { width:200px; height:auto; }
            </style>
        </head>
        <body>

            <h2>PDF with Image</h2>

            <p><strong>Name:</strong> Santosh Chaudhary</p>

            <p><strong>Signature:</strong></p>

            <img src="' . $imageSrc . '" class="img">

        </body>
        </html>
    ';

        // Load HTML
        $dompdf->loadHtml($html);

        // Paper size
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF
        $dompdf->render();

        // Download
        return response()->streamDownload(
            fn() => print($dompdf->output()),
            "sample.pdf"
        );
    }
    public function getBusType($id)
    {
        // Fetch options based on the selected ID (e.g., from a database)
        $options = DB::table('sub_categories')->where('CatID', $id)->get();

        return response()->json($options);
    }
    public function register(Request $request)
    {
        $queryParams = $request->query();
        session()->forget(['buyerData', 'step']);
        return redirect()->route('register.with.ebb', $queryParams);
    }
    public function registerWithEbb(Request $request)
    {
        //session()->forget(['buyerData', 'step']);
        $step = session('step', 1);
        $buyerData = session('buyerData', []);
        /*  dd($buyerData); */
        $categoryData = DB::table('categories')->get();
        $states = DB::table('states')->get();
        $counties = DB::table('counties')->get();
        /* $agents = User::with('agent_info')->where('role_name', 'agent')->get(); */
        $agents = User::select(
            'users.*',
            'agents.FName',
            'agents.LName',
            'agents.AgentID'
        )
            ->join('agents', 'agents.AgentUserRegisterId', '=', 'users.id')
            ->where('users.role_name', 'agent')
            ->whereNull('users.deleted_at')
            ->where('agents.Active', 1)
            ->orderBy('agents.FName', 'asc')
            ->get();
        $sub_categories = DB::table('sub_categories')->get();
        $uniqueAgID = '';
        if ($request->query('agent_id')) {
            $agId = $request->query('agent_id');
            $getUniqueID = Agent::where('AgentUserRegisterId', $agId)->first();
            $uniqueAgID = $getUniqueID->AgentID;
        }
        return view('frontend.register-with-ebb', compact('step', 'buyerData', 'categoryData', 'states', 'counties', 'agents', 'sub_categories', 'uniqueAgID'));
    }

    public function storeRegisterWithEbb_old(Request $request)
    {
        // Start the transaction
        DB::beginTransaction();
        try {
            $step = session('step', 1);
            //$this->validateStep($request, $step);
            if ($step == 1) {
                $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                    'secret' => config('services.recaptcha.secret_key'),
                    'response' => $request->recaptcha_token,
                    'remoteip' => $request->ip(),
                ]);

                $result = $response->json();

                if (!($result['success'] ?? false) || ($result['score'] ?? 0) < 0.5) {
                    return back()->with('error', 'reCAPTCHA failed. Try again.');
                }
                // Check if already registered
                $existingUser = User::where('email', $request->nda_email)
                    ->where('role_name', 'buyer')
                    ->first();

                if ($existingUser) {
                    return back()->with(
                        'error',
                        'This email address is already registered. Please sign in or use a different email address.'
                    );
                }
                $buyerData = session('buyerData', []);
                // Handle signature (base64 → store temporarily)
                $signaturePath = null;

                if (!empty($request->signature)) {

                    if (preg_match('/^data:image\/(\w+);base64,/', $request->signature)) {

                        $image = substr($request->signature, strpos($request->signature, ',') + 1);
                        $image = base64_decode($image);

                        $signFolder = public_path('nda_signatures');

                        if (!File::exists($signFolder)) {
                            File::makeDirectory($signFolder, 0755, true);
                        }

                        $signName = 'sign_' . time() . '.png';
                        file_put_contents($signFolder . '/' . $signName, $image);

                        $signaturePath = 'nda_signatures/' . $signName;
                    }
                }

                // Store ALL data in session
                $getFullname = preg_split('/\s+/', trim($request->full_name));
                $firstName = array_shift($getFullname);
                $lastName  = implode(' ', $getFullname);
                $buyerData = array_merge($buyerData, [
                    'full_name' => $request->full_name,
                    'nda_business_interest' => $request->nda_business_interest,
                    'home_address' => $request->home_address,
                    'nda_cell_phone' => $request->nda_cell_phone,
                    'nda_email' => $request->nda_email,
                    'signature' => $request->signature ?? '',
                    'nda_form_sign' => 'yes',
                    'first_name' => $firstName,
                    'last_name' => $lastName ?? ''
                ]);

                // Save back to session
                session(['buyerData' => $buyerData]);
            } elseif ($step == 2) {
                $buyerData = session('buyerData', []);

                $buyerData = array_merge($buyerData, [
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'agent' => $request->agent,
                    'address' => $request->address,
                    'city' => $request->city,
                    'state' => $request->state,
                    'zip' => $request->zip,
                    'county' => $request->county,
                    'callWhen' => $request->callWhen,
                ]);

                session(['buyerData' => $buyerData]);
            } elseif ($step == 3) {
                if ($request->has('next')) {
                    $data = session('buyerData');
                    if (!$data) {
                        return back()->with('error', 'Session expired');
                    }

                    event(new BuyerRegister($data));
                    $check = $this->buyerRegistration($data);
                    $data = array_merge($data, [
                        'TypeBus' => $request->business_interest,
                        'Interest' => $request->Interest ?? 0,
                        'BusCategory1' => $request->bus_category1,
                        'BusCategory2' => $request->bus_category2,
                        'BusCategory3' => $request->bus_category3,
                        'BusCategory4' => $request->bus_category4,
                        'BusType1' => $request->bus_type1,
                        'BusType2' => $request->bus_type2,
                        'BusType3' => $request->bus_type3,
                        'BusType4' => $request->bus_type4,
                        'BusCounty1' => $request->desiredCounty1,
                        'BusCounty2' => $request->desiredCounty2,
                        'BusCounty3' => $request->desiredCounty3,
                        'BusCounty4' => $request->desiredCounty4,
                        'BusLocation' => $request->desiredLocation,
                        'NetWorth' => $request->netWorth,
                        'CashAvailable' => $request->cashAvailable,
                        'PPMin' => $request->priceRangeMinimum,
                        'PPMax' => $request->priceRangeMaximum,
                        'VolMin' => $request->salesVolumeMinimum,
                        'VolMax' => $request->salesVolumeMaximum,
                        'NetProfMin' => $request->netIncomeMinimum,
                        'NetProfMax' => $request->netIncomeMaximum,
                        'Comments' => $request->comments,
                        'user_id' => $check->id,
                    ]);
                    session(['buyerData' => $data]);

                    // Create Buyer
                    $buyer = new Buyer;
                    $buyer->FName = $data['first_name'] ?? null;
                    $buyer->LName = $data['last_name'] ?? null;
                    $buyer->AgentID = $data['agent'] ?? null;
                    $buyer->Address1 = $data['address'] ?? null;
                    $buyer->City = $data['city'] ?? null;
                    $buyer->State = $data['state'] ?? null;
                    $buyer->Zip = $data['zip'] ?? null;
                    $buyer->County = $data['county'] ?? null;
                    $buyer->HomePhone = $data['nda_cell_phone'] ?? null;
                    $buyer->Email = $data['nda_email'] ?? null;
                    $buyer->TypeBus = $data['TypeBus'] ?? null;
                    $buyer->Interest = $data['Interest'] ?? 0;
                    $buyer->BusType1 = $data['BusType1'] ?? null;
                    $buyer->BusType2 = $data['BusType2'] ?? null;
                    $buyer->BusType3 = $data['BusType3'] ?? null;
                    $buyer->BusType4 = $data['BusType4'] ?? null;
                    $buyer->BusCounty1 = $data['BusCounty1'] ?? null;
                    $buyer->BusCounty2 = $data['BusCounty2'] ?? null;
                    $buyer->BusCounty3 = $data['BusCounty3'] ?? null;
                    $buyer->BusCounty4 = $data['BusCounty4'] ?? null;
                    $buyer->BusLocation = $data['BusLocation'] ?? null;
                    $buyer->NetWorth = $data['NetWorth'] ?? null;
                    $buyer->CashAvailable = $data['CashAvailable'] ?? null;
                    $buyer->PPMin = $data['PPMin'] ?? null;
                    $buyer->PPMax = $data['PPMax'] ?? null;
                    $buyer->VolMin = $data['VolMin'] ?? null;
                    $buyer->VolMax = $data['VolMax'] ?? null;
                    $buyer->NetProfMin = $data['NetProfMin'] ?? null;
                    $buyer->NetProfMax = $data['NetProfMax'] ?? null;
                    $buyer->Comments = $data['Comments'] ?? null;
                    $buyer->user_id = $data['user_id'];
                    $buyer->save();

                    // Create NDA Record
                    $nda = new SignNda;
                    $nda->full_name = $data['full_name'] ?? null;
                    $nda->business_interest = $data['nda_business_interest'] ?? null;
                    $nda->home_address = $data['home_address'] ?? null;
                    $nda->home_phone = $data['home_phone'] ?? null;
                    $nda->cell_phone = $data['nda_cell_phone'] ?? null;
                    $nda->email = $data['nda_email'] ?? null;
                    $nda->signature = $data['signature'] ?? null;
                    $nda->user_id = $data['user_id'];
                    $nda->save();

                    // Generate PDF
                    $options = new Options();
                    $options->set('defaultFont', 'Helvetica');

                    $dompdf = new Dompdf($options);

                    $pdfContent = View::make('pdf.nda_form_pdf', [
                        'full_name' => $data['full_name'] ?? null,
                        'business_interest' => $data['nda_business_interest'] ?? null,
                        'home_address' => $data['home_address'] ?? null,
                        'cell_phone' => $data['nda_cell_phone'] ?? null,
                        'email' => $data['nda_email'] ?? null,
                        'signature' => $data['signature'] ?? null,
                        'date' => now()->format('m-d-Y'),
                    ])->render();

                    $dompdf->loadHtml($pdfContent);
                    $dompdf->render();

                    $filename = 'nda_' . time() . '.pdf';
                    /*   return response()->streamDownload(
                        function () use ($dompdf) {
                            echo $dompdf->output();
                        },
                        $filename
                    ); */
                    $path = public_path('nda_pdfs/' . $filename);

                    file_put_contents($path, $dompdf->output());

                    $nda->nda_pdf_path = 'nda_pdfs/' . $filename;
                    $nda->save();

                    DB::commit();


                    // Clear session
                    session()->forget(['buyerData', 'step']);

                    return redirect()->route('login')->with('success', 'Your account has been successfully created. Please check your email for instructions to log in!');
                }
            }

            $action = $request->input('action_type');

            if ($action === 'previous') {
                $step = $step - 1;
            } else {
                $step = $step + 1;
            }

            // Store the updated step in session
            session(['step' => $step]);
            // Commit the transaction if no errors
            DB::commit();

            return redirect()->route('register.with.ebb', $request->query());
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'An error occurred while processing your request. Please try again.');
        }
    }
    public function storeRegisterWithEbb(Request $request)
    {
        DB::beginTransaction();

        try {
            $step = session('step', 1);

            if ($step == 1) {

                /*
            |--------------------------------------------------------------------------
            | STEP 1 VALIDATION
            |--------------------------------------------------------------------------
            */
                $request->validate([
                    'nda_email' => 'required|email|max:254',
                    'signature_type' => 'required|in:draw,type',
                    'typed_signature' => 'required_if:signature_type,type|max:255',
                ], [
                    'nda_email.required' => 'Please enter your email address.',
                    'nda_email.email' => 'Please enter a valid email address.',
                    'signature_type.required' => 'Please select a signature option.',
                    'typed_signature.required_if' => 'Please type your signature.',
                ]);

                /*
            |--------------------------------------------------------------------------
            | reCAPTCHA
            |--------------------------------------------------------------------------
            */
                $response = Http::asForm()->post(
                    'https://www.google.com/recaptcha/api/siteverify',
                    [
                        'secret' => config('services.recaptcha.secret_key'),
                        'response' => $request->recaptcha_token,
                        'remoteip' => $request->ip(),
                    ]
                );

                $result = $response->json();

                if (
                    !($result['success'] ?? false) ||
                    ($result['score'] ?? 0) < 0.5
                ) {
                    DB::rollBack();

                    return back()
                        ->withInput()
                        ->with('error', 'reCAPTCHA failed. Try again.');
                }

                /*
            |--------------------------------------------------------------------------
            | CHECK EXISTING EMAIL
            |--------------------------------------------------------------------------
            */
                $existingUser = User::where('email', $request->nda_email)
                    ->where('role_name', 'buyer')
                    ->first();

                if ($existingUser) {
                    DB::rollBack();

                    return back()
                        ->withInput()
                        ->with(
                            'error',
                            'This email address is already registered. Please sign in or use a different email address.'
                        );
                }

                $buyerData = session('buyerData', []);

                /*
            |--------------------------------------------------------------------------
            | SIGNATURE
            |--------------------------------------------------------------------------
            |
            | DRAW:
            | - Keep the original working behavior.
            | - Save the canvas as a PNG in nda_signatures.
            | - Store the ORIGINAL data:image/... base64 value in session/database.
            |   This is what your old PDF was using successfully.
            |
            | TYPE:
            | - Store the typed text directly.
            |
            |--------------------------------------------------------------------------
            */
                $signatureType = $request->signature_type ?? 'draw';
                $signatureValue = '';

                if ($signatureType === 'type') {

                    $signatureValue = trim($request->typed_signature ?? '');

                    if ($signatureValue === '') {
                        DB::rollBack();

                        return back()
                            ->withInput()
                            ->with('error', 'Please type your signature.');
                    }
                } elseif ($signatureType === 'draw') {

                    /*
                |--------------------------------------------------------------------------
                | KEEP OLD DRAW SIGNATURE CODE
                |--------------------------------------------------------------------------
                */
                    $signaturePath = null;

                    if (!empty($request->signature)) {

                        if (
                            preg_match(
                                '/^data:image\/(\w+);base64,/',
                                $request->signature
                            )
                        ) {

                            $image = substr(
                                $request->signature,
                                strpos($request->signature, ',') + 1
                            );

                            $image = base64_decode($image);

                            if ($image === false) {
                                DB::rollBack();

                                return back()
                                    ->withInput()
                                    ->with(
                                        'error',
                                        'Unable to process your signature. Please try again.'
                                    );
                            }

                            $signFolder = public_path('nda_signatures');

                            if (!File::exists($signFolder)) {
                                File::makeDirectory(
                                    $signFolder,
                                    0755,
                                    true
                                );
                            }

                            $signName =
                                'sign_' .
                                time() .
                                '_' .
                                uniqid() .
                                '.png';

                            $saved = file_put_contents(
                                $signFolder . '/' . $signName,
                                $image
                            );

                            if ($saved === false) {
                                DB::rollBack();

                                return back()
                                    ->withInput()
                                    ->with(
                                        'error',
                                        'Unable to save your signature. Please try again.'
                                    );
                            }

                            $signaturePath =
                                'nda_signatures/' . $signName;

                            /*
                        |--------------------------------------------------------------------------
                        | IMPORTANT
                        |--------------------------------------------------------------------------
                        | Keep the original base64 value for the PDF.
                        | Your old working PDF used:
                        | <img src="{!! $signature !!}">
                        |
                        | The PNG above is still created and retained on disk.
                        |--------------------------------------------------------------------------
                        */
                            $signatureValue = $request->signature;
                        } else {

                            DB::rollBack();

                            return back()
                                ->withInput()
                                ->with(
                                    'error',
                                    'Invalid signature format. Please draw your signature again.'
                                );
                        }
                    } else {

                        DB::rollBack();

                        return back()
                            ->withInput()
                            ->with(
                                'error',
                                'Please provide your signature.'
                            );
                    }
                } else {

                    DB::rollBack();

                    return back()
                        ->withInput()
                        ->with(
                            'error',
                            'Invalid signature type.'
                        );
                }

                /*
            |--------------------------------------------------------------------------
            | STORE STEP 1 DATA
            |--------------------------------------------------------------------------
            */
                $getFullname = preg_split(
                    '/\s+/',
                    trim($request->full_name)
                );

                $firstName = array_shift($getFullname);
                $lastName = implode(' ', $getFullname);

                $buyerData = array_merge(
                    $buyerData,
                    [
                        'full_name' => $request->full_name,
                        'nda_business_interest' =>
                        $request->nda_business_interest,
                        'home_address' =>
                        $request->home_address,
                        'nda_cell_phone' =>
                        $request->nda_cell_phone,
                        'nda_email' =>
                        $request->nda_email,

                        'signature' => $signatureValue,
                        'signature_type' => $signatureType,
                        'typed_signature' =>
                        $request->typed_signature ?? '',

                        'nda_form_sign' => 'yes',

                        'first_name' => $firstName,
                        'last_name' => $lastName ?? '',
                    ]
                );

                session([
                    'buyerData' => $buyerData
                ]);
            } elseif ($step == 2) {

                /*
            |--------------------------------------------------------------------------
            | STEP 2
            |--------------------------------------------------------------------------
            */
                $buyerData = session('buyerData', []);

                $buyerData = array_merge(
                    $buyerData,
                    [
                        'first_name' => $request->first_name,
                        'last_name' => $request->last_name,

                        // Agent remains optional
                        'agent' => $request->agent,

                        'address' => $request->address,
                        'city' => $request->city,
                        'state' => $request->state,
                        'zip' => $request->zip,
                        'county' => $request->county,
                        'callWhen' => $request->callWhen,
                    ]
                );

                session([
                    'buyerData' => $buyerData
                ]);
            } elseif ($step == 3) {

                /*
            |--------------------------------------------------------------------------
            | STEP 3
            |--------------------------------------------------------------------------
            */
                if ($request->has('next')) {

                    $data = session('buyerData');

                    if (!$data) {
                        DB::rollBack();

                        return back()
                            ->with('error', 'Session expired');
                    }

                    /*
                |--------------------------------------------------------------------------
                | CREATE USER
                |--------------------------------------------------------------------------
                */
                    event(new BuyerRegister($data));

                    $check = $this->buyerRegistration($data);

                    /*
                |--------------------------------------------------------------------------
                | BUSINESS SEARCH DATA
                |--------------------------------------------------------------------------
                */
                    $data = array_merge(
                        $data,
                        [
                            'TypeBus' =>
                            $request->business_interest,
                            'Interest' =>
                            $request->Interest ?? 0,

                            'BusCategory1' =>
                            $request->bus_category1,
                            'BusCategory2' =>
                            $request->bus_category2,
                            'BusCategory3' =>
                            $request->bus_category3,
                            'BusCategory4' =>
                            $request->bus_category4,

                            'BusType1' =>
                            $request->bus_type1,
                            'BusType2' =>
                            $request->bus_type2,
                            'BusType3' =>
                            $request->bus_type3,
                            'BusType4' =>
                            $request->bus_type4,

                            'BusCounty1' =>
                            $request->desiredCounty1,
                            'BusCounty2' =>
                            $request->desiredCounty2,
                            'BusCounty3' =>
                            $request->desiredCounty3,
                            'BusCounty4' =>
                            $request->desiredCounty4,

                            'BusLocation' =>
                            $request->desiredLocation,

                            'NetWorth' =>
                            $request->netWorth,
                            'CashAvailable' =>
                            $request->cashAvailable,

                            'PPMin' =>
                            $request->priceRangeMinimum,
                            'PPMax' =>
                            $request->priceRangeMaximum,

                            'VolMin' =>
                            $request->salesVolumeMinimum,
                            'VolMax' =>
                            $request->salesVolumeMaximum,

                            'NetProfMin' =>
                            $request->netIncomeMinimum,
                            'NetProfMax' =>
                            $request->netIncomeMaximum,

                            'Comments' =>
                            $request->comments,

                            'user_id' => $check->id,
                        ]
                    );

                    session([
                        'buyerData' => $data
                    ]);

                    /*
                |--------------------------------------------------------------------------
                | CREATE BUYER
                |--------------------------------------------------------------------------
                */
                    $buyer = new Buyer;

                    $buyer->FName =
                        $data['first_name'] ?? null;
                    $buyer->LName =
                        $data['last_name'] ?? null;

                    // Agent is optional
                    $buyer->AgentID =
                        $data['agent'] ?? null;

                    $buyer->Address1 =
                        $data['address'] ?? null;
                    $buyer->City =
                        $data['city'] ?? null;
                    $buyer->State =
                        $data['state'] ?? null;
                    $buyer->Zip =
                        $data['zip'] ?? null;
                    $buyer->County =
                        $data['county'] ?? null;
                    $buyer->HomePhone =
                        $data['nda_cell_phone'] ?? null;
                    $buyer->Email =
                        $data['nda_email'] ?? null;

                    $buyer->TypeBus =
                        $data['TypeBus'] ?? null;
                    $buyer->Interest =
                        $data['Interest'] ?? 0;

                    $buyer->BusType1 =
                        $data['BusType1'] ?? null;
                    $buyer->BusType2 =
                        $data['BusType2'] ?? null;
                    $buyer->BusType3 =
                        $data['BusType3'] ?? null;
                    $buyer->BusType4 =
                        $data['BusType4'] ?? null;

                    $buyer->BusCounty1 =
                        $data['BusCounty1'] ?? null;
                    $buyer->BusCounty2 =
                        $data['BusCounty2'] ?? null;
                    $buyer->BusCounty3 =
                        $data['BusCounty3'] ?? null;
                    $buyer->BusCounty4 =
                        $data['BusCounty4'] ?? null;

                    $buyer->BusLocation =
                        $data['BusLocation'] ?? null;

                    $buyer->NetWorth =
                        $data['NetWorth'] ?? null;
                    $buyer->CashAvailable =
                        $data['CashAvailable'] ?? null;

                    $buyer->PPMin =
                        $data['PPMin'] ?? null;
                    $buyer->PPMax =
                        $data['PPMax'] ?? null;

                    $buyer->VolMin =
                        $data['VolMin'] ?? null;
                    $buyer->VolMax =
                        $data['VolMax'] ?? null;

                    $buyer->NetProfMin =
                        $data['NetProfMin'] ?? null;
                    $buyer->NetProfMax =
                        $data['NetProfMax'] ?? null;

                    $buyer->Comments =
                        $data['Comments'] ?? null;

                    $buyer->user_id =
                        $data['user_id'];

                    $buyer->save();

                    /*
                |--------------------------------------------------------------------------
                | CREATE NDA
                |--------------------------------------------------------------------------
                */
                    $nda = new SignNda;

                    $nda->full_name =
                        $data['full_name'] ?? null;

                    $nda->business_interest =
                        $data['nda_business_interest'] ?? null;

                    $nda->home_address =
                        $data['home_address'] ?? null;

                    $nda->home_phone =
                        $data['home_phone'] ?? null;

                    $nda->cell_phone =
                        $data['nda_cell_phone'] ?? null;

                    $nda->email =
                        $data['nda_email'] ?? null;

                    /*
                 * Draw:
                 * data:image/png;base64,...
                 *
                 * Type:
                 * John Smith
                 */
                    $nda->signature =
                        $data['signature'] ?? null;

                    /*
                 * draw OR type
                 */
                    $nda->signature_type =
                        $data['signature_type'] ?? 'draw';

                    $nda->user_id =
                        $data['user_id'];

                    $nda->save();

                    /*
                |--------------------------------------------------------------------------
                | GENERATE PDF
                |--------------------------------------------------------------------------
                |
                | IMPORTANT:
                | We keep the draw signature as the original base64 data URI.
                | This is the exact format your old working PDF expected.
                |
                | Type signature is plain text and the PDF Blade should handle
                | it using signature_type.
                |
                |--------------------------------------------------------------------------
                */
                    $options = new Options();

                    $options->set(
                        'defaultFont',
                        'Helvetica'
                    );

                    $options->set(
                        'isRemoteEnabled',
                        true
                    );

                    $options->set(
                        'isHtml5ParserEnabled',
                        true
                    );

                    $dompdf =
                        new Dompdf($options);

                    $pdfContent =
                        View::make(
                            'pdf.nda_form_pdf',
                            [
                                'full_name' =>
                                $data['full_name'] ?? null,

                                'business_interest' =>
                                $data['nda_business_interest'] ?? null,

                                'home_address' =>
                                $data['home_address'] ?? null,

                                'cell_phone' =>
                                $data['nda_cell_phone'] ?? null,

                                'email' =>
                                $data['nda_email'] ?? null,

                                'signature' =>
                                $data['signature'] ?? null,

                                'signature_type' =>
                                $data['signature_type'] ?? 'draw',

                                'date' =>
                                now()->format('m-d-Y'),
                            ]
                        )->render();

                    $dompdf->loadHtml($pdfContent);

                    $dompdf->setPaper(
                        'A4',
                        'portrait'
                    );

                    $dompdf->render();

                    /*
                |--------------------------------------------------------------------------
                | SAVE PDF
                |--------------------------------------------------------------------------
                */
                    $pdfFolder =
                        public_path('nda_pdfs');

                    if (!File::exists($pdfFolder)) {
                        File::makeDirectory(
                            $pdfFolder,
                            0755,
                            true
                        );
                    }

                    $filename =
                        'nda_' .
                        time() .
                        '_' .
                        uniqid() .
                        '.pdf';

                    $path =
                        $pdfFolder .
                        DIRECTORY_SEPARATOR .
                        $filename;

                    file_put_contents(
                        $path,
                        $dompdf->output()
                    );

                    $nda->nda_pdf_path =
                        'nda_pdfs/' . $filename;

                    $nda->save();

                    DB::commit();

                    /*
                |--------------------------------------------------------------------------
                | CLEAR SESSION
                |--------------------------------------------------------------------------
                */
                    session()->forget([
                        'buyerData',
                        'step'
                    ]);

                    return redirect()
                        ->route('login')
                        ->with(
                            'success',
                            'Your account has been successfully created. Please check your email for instructions to log in!'
                        );
                }
            }

            /*
        |--------------------------------------------------------------------------
        | NEXT / PREVIOUS
        |--------------------------------------------------------------------------
        */
            $action =
                $request->input('action_type');

            if ($action === 'previous') {
                $step = $step - 1;
            } else {
                $step = $step + 1;
            }

            session([
                'step' => $step
            ]);

            DB::commit();

            return redirect()
                ->route(
                    'register.with.ebb',
                    $request->query()
                );
        } catch (\Throwable $e) {

            DB::rollBack();
            Log::error('EBB Registration Error', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),

                // GD diagnostic
                'php_version' => PHP_VERSION,
                'php_sapi' => PHP_SAPI,
                'php_ini' => php_ini_loaded_file(),
                'gd_loaded' => extension_loaded('gd'),
                'gd_info' => extension_loaded('gd') ? gd_info() : null,
            ]);
            return back()
                ->withInput()
                ->with(
                    'error',
                    'An error occurred while processing your request. Please try again.'
                );
        }
    }

    public function buyerRegistration(array $data)
    {
        try {
            $password = $data['first_name'] . '@123';

            return User::create([
                'name' => $data['first_name'],
                'email' => $data['nda_email'],
                'role_name' => 'buyer',
                'password' => Hash::make($password)
            ]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
    // Validate data for each step
    private function validateStep(Request $request, $step)
    {
        // Initialize validation rules as an empty array
        $rules = [];

        // Check if the "next" button is pressed (we assume the button name is 'next')
        if ($request->has('next')) {
            // Switch case based on the current step
            switch ($step) {
                case 2:
                    // Step 1 validation rules
                    $rules = [
                        'first_name' => 'required',
                        'last_name' => 'required',
                        'agent' => 'required',
                        'BDate' => 'required',
                        'address' => 'required',
                        'city' => 'required',
                        'state' => 'required',
                        'zip' => 'required',
                        'home_phone' => 'required',
                        'county' => 'required',
                        'email' => 'required|email',
                    ];
                    break;
            }

            // Validate the request with the current step's rules
            $request->validate($rules);
        }
    }
}
