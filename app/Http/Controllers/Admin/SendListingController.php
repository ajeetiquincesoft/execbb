<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buyer;
use App\Models\Listing;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Database;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class SendListingController extends Controller
{
    protected $database;
    protected $reference;

    public function __construct()
    {
        // Set the path to your Firebase service account JSON file
        $serviceAccountPath = storage_path('app/firebase/exeb-443511-firebase-adminsdk-fbsvc-99ad7c8b12.json');

        // Initialize Firebase with the service account and database URI
        $firebase = (new Factory)
            ->withServiceAccount($serviceAccountPath)
            ->withDatabaseUri('https://exeb-443511-default-rtdb.firebaseio.com');

        // Create the database instance
        $this->database = $firebase->createDatabase();

        // Set the reference to 'notifications'
        $this->reference = $this->database->getReference('notifications');
    }
    public function index()
    {
        $buyers = Buyer::orderBy('created_at', 'desc')->get();
        $listings = Listing::where('Status', 'valid')->where('Active', 1)->orderBy('created_at', 'desc')->get();
        return view('admin.send_listing.index', compact('buyers', 'listings'));
    }
    public function shareListing(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'recipientEmail' => 'required|array',  // Ensures at least one email is selected
            'recipientEmail.*' => 'email',
            'listingName' => 'required|array',  // Listing IDs should be an array
        ]);

        // Ensure content from CKEditor is clean and not altered
        $content = html_entity_decode($request->email_content);  // Decode HTML entities
        $notes = trim(strip_tags(html_entity_decode($request->email_content)));

        // Prepare the base URL for the listing
        $baseUrl = url('view/business/listing/');
        $baseUrlFactsheet = url('factsheet/'); // Assuming your listings are accessible via a URL like /listing/{id}

        // Prepare the links for the selected listings
        $listingLinks = [];
        $factsheetLinks = [];
        $user = auth()->user();
        foreach ($request->listingName as $listingId) {
            // Create a link for each listing
            $listingLinks[] = '<a href="' . $baseUrl . '/' . $listingId . '">View Listing ' . $listingId . '</a>';
            $factsheetLinks[] = '<a href="' . $baseUrlFactsheet . '/' . base64_encode($listingId) . '">View Listing factsheet ' . base64_encode($listingId) . '</a>';
        }

        // Combine the links into a string
        $listingLinksString = implode('<br>', $listingLinks);  // Join links with a line break
        $factSheetLinksString = implode('<br>', $factsheetLinks);
        // Subject of the email
        $subject = 'Exclusive Listings Just for You – View Selected Properties';

        // Loop through each recipient email and send email
        foreach ($request->recipientEmail as $email) {
            $buyerID = User::where('email', $email)->where('role_name', 'buyer')->first();
            foreach ($request->listingName as $listingId) {
                $AgentId = Listing::where('ListingID', $listingId)->value('AgentID');
                DB::table('showings')->insert([
                    'ListingID' => $listingId,
                    'BuyerID'   => $buyerID->id,
                    'AgentID'   => $AgentId,
                    'Notes' => $notes,
                    'Date'   => Carbon::now(),
                    'DateEntered'   => Carbon::now(),
                    'EnteredBy'   => $user->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
            $data = [
                'title' => 'Share Exclusive Listings',
                'body' => 'Admin share Exclusive Listings Just for You. listing is ' . $listingLinksString . ' and factsheet of listing is ' . $factSheetLinksString . '',
                'timestamp' => Carbon::now()->toIso8601String(),
                'sender_id' => Auth::id(),
                'receiver_id' => $buyerID->id,
                'is_read' => false,
            ];
            $this->reference->push($data);
            $htmlContent = '<html>
        <body style="font-family: Arial, sans-serif; color: #333; line-height: 1.6;">
            <table style="width: 100%; max-width: 600px; margin: 0 auto; border: 1px solid #ddd; padding: 20px; border-radius: 8px;">
                <tr>
                    <td style="text-align: center; background-color: #4CAF50; color: white; padding: 10px;">
                        <h2 style="margin: 0;">Property Listings Just for You</h2>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 20px;">
                        <p>Dear Buyer,</p>

                        <p>We are excited to share with you a selection of property listings that may be of interest to you. Based on your preferences, we have carefully curated the following listings:</p>

                        <p><strong>Property Listings:</strong></p>
                        <ul>
                            ' . $listingLinksString . '
                        </ul>
                        <p><strong>FactSheet of Listing:</strong></p>
                        <ul>
                            ' . $factSheetLinksString . '
                        </ul>
                        <p>' . $content . '</p>

                        <p>We believe these properties align with your needs and are confident they will provide you with excellent opportunities. Feel free to explore the listings, and let us know if you did like more information or a personalized tour.</p>

                        <p>If you have any questions or would like assistance with your property search, please do not hesitate to reach out to us. We are here to help!</p>

                        <p>Best regards,</p>
                        <p style="font-weight: bold;">Executive Business Broker</p>
                        <p style="font-weight: bold;">Phone: 908.851.9066</p>

                        <p style="font-size: 0.8em; color: #777;">You are receiving this email because you showed interest in properties with us. If you no longer wish to receive these updates, please unsubscribe here.</p>
                    </td>
                </tr>
            </table>
        </body>
    </html>';

            // Send email with HTML content
            Mail::send([], [], function ($message) use ($email, $subject, $htmlContent) {
                $message->to($email)
                    ->subject($subject)
                    ->setBody($htmlContent, 'text/html'); // Set the body as HTML
            });
        }

        // Return a response (optional)
        return redirect()->back()->with('success', 'Email sent successfully!');
    }
    public function ajax(Request $request)
    {
        $search = $request->input('q');
        $page = $request->input('page', 1);
        $perPage = 10;

        $query = Buyer::query();

        if ($search) {
            $query->where('Email', 'like', '%' . $search . '%');
        }

        $buyers = $query->orderBy('Email')
            ->skip(($page - 1) * $perPage)
            ->take($perPage + 1) // Fetch one extra to check for more
            ->get();

        $hasMore = $buyers->count() > $perPage;

        $results = $buyers->take($perPage)->map(function ($buyer) {
            return [
                'id' => $buyer->Email,
                'text' => $buyer->Email
            ];
        });

        return response()->json([
            'items' => $results,
            'pagination' => ['more' => $hasMore]
        ]);
    }
}
