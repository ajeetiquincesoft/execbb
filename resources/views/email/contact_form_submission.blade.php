<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EBB Contact Form Submission</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #2c3e50;
            font-size: 24px;
            margin-bottom: 20px;
        }

        p {
            font-size: 16px;
            margin-bottom: 10px;
        }

        p strong {
            color: #34495e;
        }

        footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #7f8c8d;
        }

        footer p {
            margin: 5px 0;
        }

        .footer-link {
            color: #3498db;
            text-decoration: none;
        }

        .footer-link:hover {
            text-decoration: underline;
        }

        .separator {
            border-top: 1px solid #ecf0f1;
            margin: 20px 0;
        }

        .footer-note {
            color: #95a5a6;
        }

        .section-title {
            background-color: #2980b9;
            color: white;
            padding: 10px;
            font-size: 18px;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <main>
            <h2>New Contact Form Submission</h2>

            <p><strong>Dear Executive Business Brokers Team,</strong></p>
            <p>We have received a new contact form submission from a prospective client. Below are the details:</p>

            <div class="separator"></div>

            <p><strong>First Name:</strong> {{ $first_name }}</p>
            <p><strong>Last Name:</strong> {{ $last_name }}</p>
            <p><strong>Mailing Address:</strong> {{ $address }}</p>
            <p><strong>City/Town:</strong> {{ $city }}</p>
            <p><strong>State:</strong> {{ $state }}</p>
            <p><strong>County:</strong> {{ $country }}</p>
            <p><strong>Zip Code:</strong> {{ $zip }}</p>
            <p><strong>Day Time Phone:</strong> {{ $day_time_phone }}</p>
            <p><strong>Evening Phone:</strong> {{ $evening_phone }}</p>
            <p><strong>Cellular Phone:</strong> {{ $cellular_phone }}</p>
            <p><strong>Email Address:</strong> {{ $email }}</p>
            <p><strong>Best Time to Contact:</strong> {{ $time_to_connect }}</p>

            <div class="separator"></div>

            <p><strong>Message:</strong></p>
            <p>{{ $message_content }}</p>

            <div class="separator"></div>

            <p><strong>Role:</strong> {{ $role }}</p>

            <div class="separator"></div>

            <p>Thank you for your attention to this inquiry.</p>

            <p>Best regards,</p>
            <p><strong>The Executive Business Brokers Team</strong></p>
        </main>

        <footer>
            <p>&copy; {{ date('Y') }} Executive Business Brokers. All rights reserved.</p>
            <p>Visit our website: <a href="https://execbb.com/" class="footer-link">https://execbb.com</a></p>
            <p class="footer-note">This email was sent to you for informational purposes only.</p>
        </footer>
    </div>
</body>

</html>
