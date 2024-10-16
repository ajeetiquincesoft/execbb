@extends('admin.layout.master')
@section('content')
@if(Session::has('success_message'))
        <div class="alert alert-success alert-block" id="alert-success">
          <button type="button" class="close" data-dismiss="alert">×</button> 
            <strong>{{ Session::get('success_message') }}</strong>
        </div>
        @endif
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="page-title mb-3">Reset Password</h5>
                        <form action="{{ route('reset.password.link') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                  
                                </div>
                                <div class="col-md-4">
                                     <div class="form-group mb-3">
                                        <label for="firstName">Email</label>
                                        <input type="email" placeholder="" id="email" class="form-control"
                                            name="email" required>
                                        @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                  
                                </div>
                            </div> 
                            <div class="col-md-12">
                                <div class="d-grid mx-auto agentSignup">
                                    <button type="submit" class="btn agentBtn">Submit</button>
                                </div>
                            </div>
                        </form>

                    </div>
            </div>
@endsection
