@extends('frontend.layout.buyer-master')
@section('content')
    @if (Session::has('success_message'))
        <div class="alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
            <strong>{{ Session::get('success_message') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (Session::has('error_message'))
        <div class="alert alert-danger alert-dismissible fade show" id="alert-success" role="alert">
            <strong>{{ Session::get('error_message') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="container-fluid content bg-light">
        <h2>Change password</h2>
        <p>Change your password.</p>
        <div class="row">
            <form id="buyer_reset_pass" action="{{ route('buyer.modify.password') }}" method="POST" autocomplete="off">
                @csrf
                <div class="tab-reset">
                    <div class="row mb-3">
                        <div class="col-sm-6 col-md-4 col-lg-4 col-xl-4 mb-3">
                            <label for="old_password">Old password</label>
                            <input type="text" class="form-control form-control-lg" id="old_password" name="old_password"
                                value="{{ old('old_password') }}" autocomplete="new-password">
                            @if ($errors->has('old_password'))
                                <span class="text-danger">{{ $errors->first('old_password') }}</span>
                            @endif
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-4 col-xl-4 mb-3">
                            <label for="new_password">New password</label>
                            <input type="password" class="form-control form-control-lg" id="password" name="password">
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif

                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-4 col-xl-4 mb-3">
                            <label for="confirm_password">Confirm password</label>
                            <input type="password" class="form-control form-control-lg" id="confirm_password"
                                name="password_confirmation">
                            @if ($errors->has('password_confirmation'))
                                <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                        </div>

                    </div>
                    <div class="save_buyer_info">
                        <button type="submit" class="btn btn-save">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#buyer_reset_pass').validate({
                rules: {
                    old_password: {
                        required: true
                    },
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
                    old_password: {
                        required: "Please enter your old password"
                    },
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
