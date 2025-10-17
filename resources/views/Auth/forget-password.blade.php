@extends('frontend.layout.master')
@section('content')
    <div class="container py-5">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-6">
                <div class="row g-0">
                    <div class="col-md-12 d-flex align-items-center">
                        <div class="card-body text-black">
                            <div class="d-flex d-flex justify-content-center mb-3 pb-1">
                                <span class="h1 fw-bold mb-0"> <img src="{{ url('assets/images/main_logo.png') }}"
                                        alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" /></span>
                            </div>
                            @if (Session::has('success_message'))
                                <div class="alert alert-success alert-block" id="alert-success">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                    <strong>{{ Session::get('success_message') }}</strong>
                                </div>
                            @endif
                            <form id="forget_pass" method="POST" action="{{ route('update.password.link') }}">
                                @csrf

                                @if ($errors->has('emailPassword'))
                                    <div class="alert alert-danger">
                                        {{ $errors->first('emailPassword') }}
                                    </div>
                                @endif
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <label class="form-label" for="email"><b>Email address</b></label>
                                    <input type="email" id="email" name="email" class="form-control form-control-lg"
                                        value="{{ old('email') }}" />
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif

                                </div>
                                <div class="pt-1 mt-1 d-flex flex-column justify-content-center align-items-center">
                                    <button type="submit" class="mb-3 btn bg-5a102a text-white btn-block"
                                        style="height: 50px; width: 35%;">Continue</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#forget_pass').validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    }
                },
                messages: {
                    email: {
                        required: "Please enter your email",
                        email: "Please enter a valid email address"
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
@endsection
