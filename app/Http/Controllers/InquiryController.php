<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InquiryController extends Controller
{
    public function sendInquiry(Request $request)
    {

        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'nullable|string|max:100',
            'email'      => 'required|email|max:150',
            'phone'      => 'required|min:8|max:20',
            'zipcode'    => 'nullable|max:10',
            'budget'     => 'nullable|max:50',
            'timeframe'  => 'nullable|max:50',
            'message'    => 'required|string|max:1000',
        ]);


        $data = $request->all();


        $adminEmail = "robbert@yopmail.com";


        $htmlContent = '
    <html>
    <body style="font-family: Arial; background:#f4f6f8; padding:20px;">
             <table style="width: 100%; max-width: 600px; margin: 0 auto; border: 1px solid #ddd; padding: 20px; border-radius: 8px;">
                <tr>
                    <td style="text-align: center; background-color: #7F2149; color: white; padding: 10px;">
                        <h2 style="margin: 0;">New Listing Inquiry</h2>
                    </td>
                </tr>

            <!-- Body -->
            <tr>
                <td style="padding:20px;color:#333;">

                    <p><strong>Name:</strong> ' . $data['first_name'] . ' ' . $data['last_name'] . '</p>
                    <p><strong>Name:</strong> ' . $data['last_name'] . ' ' . $data['last_name'] . '</p>
                    <p><strong>Email:</strong> ' . $data['email'] . '</p>
                    <p><strong>Phone:</strong> ' . $data['phone'] . '</p>
                    <p><strong>Zipcode:</strong> ' . $data['zipcode'] . '</p>
                    <p><strong>Budget:</strong> ' . $data['budget'] . '</p>
                    <p><strong>Timeframe:</strong> ' . $data['timeframe'] . '</p>

                    <hr>

                    <p><strong>Message:</strong></p>
                    <p style="background:#f8f9fa;padding:10px;border-radius:5px;">
                        ' . $data['message'] . '
                    </p>

                </td>
            </tr>

            <!-- Footer -->
            <tr>
                <td style="background:#f1f1f1;text-align:center;padding:15px;font-size:12px;color:#777;">
                    Executive Business Broker | Inquiry System
                </td>
            </tr>

        </table>
    </body>
    </html>';

        Mail::send([], [], function ($message) use ($adminEmail, $data, $htmlContent) {
            $message->to($adminEmail)
                ->subject('New Inquiry from ' . $data['first_name'])
                ->setBody($htmlContent, 'text/html');

            // optional reply-to
            $message->replyTo($data['email']);
        });

        return back()->with('success', 'Inquiry sent successfully!');
    }
}
