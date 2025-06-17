<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\BuyerEmail;
use App\Models\Buyer;

class EmailBuyerController extends Controller
{
    public function index()
    {
        $buyers = Buyer::orderBy('created_at', 'desc')->get();
        return view('admin.email_buyer.send_email_to_buyer', compact('buyers'));
    }
    public function sendEmail(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'recipientEmail' => 'required|array', // Ensures at least one email is selected
            'recipientEmail.*' => 'email',
            'subject' => 'required|string|max:255',
            'email_content' => 'required|string',
        ]);
        // Ensure content from CKEditor is clean and not altered
        $content = html_entity_decode($request->email_content);  // Decode HTML entities

        // Prepare email data
        $emailData = [
            'subject' => $request->subject,
            'email_content' => $content, // Raw HTML content from CKEditor
            'recipientEmail' => $request->recipient_email,
        ];
        // Send the email
        //Mail::to($request->recipientEmail)->send(new BuyerEmail($request->all()));
        foreach ($request->recipientEmail as $email) {
            Mail::to($email)->send(new BuyerEmail($emailData));
        }
        // Mail::to('santosh3257@yopmail.com')->send(new BuyerEmail($emailData));
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
            $query->where(function ($q) use ($search) {
                $q->where('Email', 'like', '%' . $search . '%')
                    ->orWhere('FName', 'like', '%' . $search . '%')
                    ->orWhere('HomePhone', 'like', '%' . $search . '%');
            });
        }

        $buyers = $query->orderBy('FName')
            ->skip(($page - 1) * $perPage)
            ->take($perPage + 1)
            ->get();

        $hasMore = $buyers->count() > $perPage;

        $results = $buyers->take($perPage)->map(function ($buyer) {
            return [
                'id' => $buyer->Email,
                'text' => "{$buyer->FName} | {$buyer->HomePhone} | {$buyer->Email}"
            ];
        });

        return response()->json([
            'items' => $results,
            'pagination' => ['more' => $hasMore]
        ]);
    }
}
