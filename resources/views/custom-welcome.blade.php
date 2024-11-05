<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Laravel</title>

    <!-- Google Font (Optional) -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS (Optional) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Custom Styles */
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
        }

        .hero {
            background-image: url("{{ asset('images/login_2.jpg') }}");
            background-size: cover;
            background-position: center;
            height: 100vh; /* Full screen height */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: #ffffff; /* White text color for better contrast */
            text-align: center;
            padding: 0 20px; /* Add padding for smaller screens */
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
        }

        .hero p {
            font-size: 1.2rem;
        }

        /* Button Styling */
        .btn-custom {
            background-color: #007bff;
            color: white;
            padding: 12px 25px;
            font-size: 1rem;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
            transition: background-color 0.3s;
        }

        .btn-custom:hover {
            background-color: #0056b3;
        }

        /* Responsive Font Adjustments */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }
            .hero p {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>

    <div class="hero">
        <div>
            <h1>Welcome to Executive Business Brokers</h1>
            <p class="lead">This is a simple welcome page with a custom background image.</p>
            <a href="#" class="btn btn-custom">Learn More</a>
        </div>
    </div>

    <!-- Optional: Bootstrap JS and Popper.js for responsive behavior -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js"></script>

</body>
</html>
