@extends('frontend.layout.master')
@section('content')
<div class="container py-5">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-md-6 col-lg-6 col-xl-6">
            <div class="row g-0">
                <div class="col-md-12 d-flex align-items-center content-center">
                    <div class="card-body text-black" style="width: 100%;">
                        <div class="d-flex justify-content-center pb-1">
                            <h5 class="fw-normal mb-2 text-center m-0 client_login">Client Log In</h5>
                        </div>
                        <p class="m-0 mb-3 an_account" style="color: #5D5D5D;">Don't have an account? <a href="{{route('register.ebb.buyer')}}" style="color: #7F2149;">Create your free account</a></p>

                        <form method="POST" action="{{ route('login.custom') }}" id="login_user">
                            @csrf
                            @if ($errors->has('emailPassword'))
                            <div class="alert alert-danger">
                                {{ $errors->first('emailPassword') }}
                            </div>
                            @endif
                            <div class="form-outline mb-4">
                                <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Email Address" />
                                @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-outline mb-4">
                                <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Password" />
                                @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>

                            <div class="pt-1 mt-1 d-flex flex-column justify-content-center align-items-center">
                                <button type="submit" class="mb-3 btn bg-5a102a text-white btn-block" style="height: 50px; width: 35%;">Continue</button>
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
<style>
    .content-center {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100%;
    }

    .client_login {
        font-size: 32px;
        font-weight: 600;
    }

    p.m-0.an_account {
        text-align: center;
        font-size: 14px;
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#login_user').validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 6
                }
            },
            messages: {
                password: {
                    required: "Please enter a new password",
                    minlength: "Password must be at least 6 characters long"
                }
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
</script>
@endsection