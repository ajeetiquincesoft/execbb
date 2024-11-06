<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title></title>
    <style>
        .bg-5a102a {
            background-color: #5a102a;
        }
        body, html {
            height: 100%;
            margin: 0;
        }
      
    </style>
</head> 

<body>
    <div class="container-fluid py-3 h-100 bg-5a102a">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-4">
                <div class="card" style="border-radius: 1rem;">
                    <div class="row g-0">
                        <div class="col-md-12  d-flex align-items-center">
                            <div class="card-body   text-black">
                                <div class="d-flex  d-flex justify-content-center mb-3 pb-1">
                                    <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                                    <span class="h1 fw-bold mb-0"> <img src="{{ url('assets/images/SidebarLogo.png') }}"
                                            alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" /></span>
                                </div>
                                @if(Session::has('success_message'))
                                <div class="alert alert-success alert-block" id="alert-success">
                                <button type="button" class="close" data-dismiss="alert">×</button> 
                                    <strong>{{ Session::get('success_message') }}</strong>
                                </div>
                                @endif
                                <form id="update_pass" method="POST" action="{{ route('reset.forget.password') }}">
                                    @csrf
                                    @if ($errors->has('emailPassword'))
                                            <div class="alert alert-danger">
                                                {{ $errors->first('emailPassword') }}
                                            </div>
                                        @endif
                                    <input type="hidden" name="token" value="{{$token}}">
                                    <div data-mdb-input-init class="form-outline mb-2">
                                        <label class="form-label" for="email"><b>Email address</b></label>
                                        <input type="email" id="email" name="email" class="form-control form-control-lg" value="{{$email}}" readonly />
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
                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <label class="form-label" for="form2Example27"><b>Confirm password</b></label>
                                        <input type="password" id="conf_password" name="password_confirmation" class="form-control form-control-lg" />

                                        @if ($errors->has('password_confirmation'))
                                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                        @endif
                                    </div> 
                                    <div class="pt-1 mt-1">
                                        <button type="submit" class="btn bg-5a102a text-white btn-block">Submit</button>
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
        <!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include jQuery Validation Plugin -->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script>
$(document).ready(function() {
    $('#update_pass').validate({
        rules: {
            password: {
                required: true,
                minlength: 6  // Minimum password length, adjust if needed
            },
            password_confirmation: {
                required: true,
                minlength: 6,  // Same as password length
                equalTo: '#password'  // Ensures it matches the password field
            }
        },
        messages: {
            password: {
                required: "Please enter a new password",
                minlength: "Password must be at least 6 characters long"
            },
            password_confirmation: {
                required: "Please confirm your new password",
                minlength: "Password confirmation must be at least 6 characters long",
                equalTo: "Password and confirmation must match"
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});

</script> 
<style>
    .error {
    color: #FF0000;
}
    </style>
</body>

</html>