@extends('admin.layout.master')
@section('content')
@if(Session::has('success_message'))
        <div class="alert alert-success alert-block" id="alert-success">
          <button type="button" class="close" data-dismiss="alert">×</button> 
            <strong>{{ Session::get('success_message') }}</strong>
        </div>
        @endif
        @if(Session::has('error_message'))
        <div class="alert alert-danger alert-block" id="alert-success">
          <button type="button" class="close" data-dismiss="alert">×</button> 
            <strong>{{ Session::get('error_message') }}</strong>
        </div>
        @endif
        <div class="container-fluid content bg-light">
            <div class="row card p-4">
                <form action="{{ route('reset.password.link') }}" method="POST">
                @csrf
                    <div class="tab-reset">
                        <h3>Reset password</h3>
                        <hr>
                        <div class="row">
                            <div class="row mb-3">
                                <div class="col-sm-6 col-md-4 col-lg-4 col-xl-4 mb-3">
                                    <label for="old_password">Old password</label>
                                    <input type="text" class="form-control" id="old_password" name="old_password" value="{{old('old_password')}}">
                                    @if ($errors->has('old_password'))
                                        <span class="text-danger">{{ $errors->first('old_password') }}</span>
                                        @endif
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-4 col-xl-4 mb-3">
                                    <label for="new_password">New password</label>
                                    <input type="text" class="form-control" id="new_password" name="password">
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-4 col-xl-4 mb-3">
                                    <label for="confirm_password">Confirm password</label>
                                    <input type="text" class="form-control" id="confirm_password" name="password_confirmation">
                                    @if ($errors->has('password_confirmation'))
                                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                        @endif
                                </div>
                               
                            </div>

                        </div>
                        <div class="col-md-12">
                                <div class="d-grid mx-auto agentSignup">
                                    <button type="submit" class="btn agentBtn">Submit</button>
                                </div>
                            </div>
                    </div>
                </form>
            </div>
        </div>
        <div p-8>
            <p>&nbsp;</p>
        </div>
                                  
                           
   
@endsection