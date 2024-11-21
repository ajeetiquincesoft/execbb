<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@300;400;500;600&display=swap" rel="stylesheet">

    <title>Responsive Login</title>
    <style>
        body {
            font-family: 'Urbanist', sans-serif;
        }
        button.btn.bg-5a102a.text-white.btn-block {
            background-color: #7F2149;
            border-radius: 0px;
            font-size: 15px;
        }
        .bg-5a102a {
            /* background-color: #5a102a; */
            height: 100vh; /* Full height for the background */
        }

        .img-fluid {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Ensure the image covers its container */
        }

        .card {
            /* border-radius: 1rem; */
            border: 0;
        }

        .login-image {
            border-radius: 1rem 0 0 1rem;
            height: 100%; /* Ensure the image takes the full height */
        }

        .content-center {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center; /* Center the content horizontally */
            height: 100%; /* Full height of the column */
        }
        .client_login {
            font-size: 32px;
            font-weight: 600;
        }
        p.m-0.an_account {
            text-align: center;
            font-size: 14px;
        }
        .form-control {
            border-radius: 0px;         
            border-color: #B3B3B3; 
            color: #B3B3B3 !important;
        }
        @media (max-width: 768px) {
            .login-image {
                display: none; /* Hide the image on small screens */
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid bg-5a102a">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-4">
                <div class="card">
                    <div class="row g-0">
                      <!--   <div class="col-md-4 d-none d-md-block">
                            <img src="{{ url('images/login_2.jpg') }}" alt="login form" class="img-fluid login-image" />
                        </div> -->
                        <div class="col-md-12 d-flex align-items-center content-center">
                            <div class="card-body text-black" style="width: 100%;">
                                <div class="d-flex justify-content-center pb-1">
                                <h5 class="fw-normal mb-2 text-center m-0 client_login">Client Log In</h5>
                                </div>
                                <p class="m-0 mb-3 an_account" style="color: #5D5D5D;">Don't have an account? <a href="#!" style="color: #7F2149;">Create your free account</a></p>

                                <form method="POST" action="{{ route('login.custom') }}">
                                @csrf
                                    @if ($errors->has('emailPassword'))
                                            <div class="alert alert-danger">
                                                {{ $errors->first('emailPassword') }}
                                            </div>
                                        @endif
                                    <div class="form-outline mb-4">
                                        <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Email Address"/>
                                        @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-outline mb-4">
                                        <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Password"/>
                                        @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>

                                    <div class="pt-1 mt-1 d-flex flex-column justify-content-center align-items-center">
                                        <button type="submit" class="mb-3 btn bg-5a102a text-white btn-block" style="height: 50px; width: 25%;">Continue</button>
                                        <div>
                                            <a class="small text-muted" href="{{ route('forget.password') }}" style="color: #7F2149 !important;text-decoration: underline;">Forgot password?</a>
                                        </div>
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>