
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buyer Registration Successful</title>
</head>
<body>
    <div class="container">
        <header>
            <h1>Welcome to the Team!</h1>
        </header>

        <main>
            <p>Dear {{ isset($data['firstName']) ? $data['firstName'] : (isset($data['first_name']) ? $data['first_name'] : 'Guest') }} 
            {{ isset($data['lastName']) ? $data['lastName'] : (isset($data['last_name']) ? $data['last_name'] : '') }},,</p>
            <p>Thank you for registering as a buyer with us. We are thrilled to have you on board!</p>
            <p>Thank you for joining our platform. You can now access all the tools and services we offer to help you with your needs. We are excited to have you on board and look forward to a successful partnership.</p>
            
            <p>Your account details are as follows:</p>
            <ul>
                <li><strong>Username:</strong> {{ $data['email'] }}</li>
                <li><strong>Password:</strong> {{ isset($data['firstName']) ? $data['firstName'] : (isset($data['first_name']) ? $data['first_name'] : 'Guest') }}@123</li>
            </ul>
            <p>Here are some quick tips to get you started:</p>
            <ul>
                <li>Complete your profile in the dashboard.</li>
                <li>Familiarize yourself with our services.</li>
                <li>Reach out to our support team if you have any questions.</li>
            </ul>
            <p>We look forward to a successful partnership!</p>
        </main>

        <footer>
            <p>&copy; {{ date('Y') }} Executive Business Brokers. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>
