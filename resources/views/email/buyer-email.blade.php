<!-- resources/views/agent/welcome.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject }}</title>
</head>
<body>
    <div class="container">
        <main>
            <p>{!! $content !!}</p>
        </main>

        <footer>
            <p>&copy; {{ date('Y') }} Executive Business Brokers. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>
