@extends('frontend.layout.master')
@section('content')
<div class="container py-5 update_pass">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-md-6 col-lg-6 col-xl-6">
            <div class="card">
                <div class="row g-0">
                    <div class="col-md-12 d-flex align-items-center">
                        <div class="card-body text-black">
                            <div class="d-flex d-flex justify-content-center mb-3 pb-1">
                                <span class="h1 fw-bold mb-0"> <img src="{{ url('assets/images/main_logo.png') }}"
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
                                <div class="pt-1 mt-1 d-flex flex-column justify-content-center align-items-center">
                                    <button type="submit" class="mb-3 btn bg-5a102a text-white btn-block" style="height: 50px; width: 35%;">Continue</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .update_pass .card {
        border: none;
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#update_pass').validate({
            rules: {
                password: {
                    required: true,
                    minlength: 6 // Minimum password length, adjust if needed
                },
                password_confirmation: {
                    required: true,
                    minlength: 6, // Same as password length
                    equalTo: '#password' // Ensures it matches the password field
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
@endsection