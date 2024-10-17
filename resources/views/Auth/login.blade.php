<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
    <style>
        .bg-5a102a {
            background-color: #5a102a;
        }

        .img-fluid {
            max-width: 89% !important;
            height: 100%;
        }
    </style>
</head>

<body>
    <div class="container-fluid py-3 h-100 bg-5a102a">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
                <div class="card" style="border-radius: 1rem;">
                    <div class="row g-0">
                        <div class="col-md-6  d-none d-md-block">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img1.webp"
                                alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                        </div>
                        <div class="col-md-6  d-flex align-items-center">
                            <div class="card-body   text-black">
                                <div class="d-flex  d-flex justify-content-center mb-3 pb-1">
                                    <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                                    <span class="h1 fw-bold mb-0"> <img src="{{ url('assets/images/SidebarLogo.png') }}"
                                            alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" /></span>
                                </div>

                                <form method="POST" action="{{ route('login.custom') }}">
                                    @csrf
                                    <h5 class="fw-normal mb-2  text-center m-0">Sign into your account</h5>
                                    @if ($errors->has('emailPassword'))
                                            <div class="alert alert-danger">
                                                {{ $errors->first('emailPassword') }}
                                            </div>
                                        @endif
                                    <div data-mdb-input-init class="form-outline mb-2">
                                        <label class="form-label" for="email"><b>Email address</b></label>
                                        <input type="email" id="email" name="email" class="form-control form-control-lg" />
                                        @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif

                                    </div>
                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <label class="form-label" for="form2Example27"><b>Password</b></label>
                                        <input type="password" id="password" name="password" class="form-control form-control-lg" />

                                        @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                        
                                    <div class="pt-1 mt-1">
                                        <button type="submit" class="btn bg-5a102a text-white btn-block">Login</button>
                                    </div>
                                    <div style="text-align:end">
                                        <a class="small text-muted" href="#!">Forgot password?</a>
                                    </div>

                                    <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="#!"
                                            style="color: #393f81;">Register here</a></p>

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