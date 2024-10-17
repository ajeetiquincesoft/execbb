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
                <form action="{{ route('update.profile',$user->id) }}" method="POST">
                @csrf
                @method('PUT')
                    <div class="tab-profile">
                        <h3>Edit profile</h3>
                        <hr>
                        <div class="row">
                            <div class="row mb-3">
                                <div class="col-sm-6 col-md-4 col-lg-4 col-xl-6 mb-3">
                                    <label for="user_name">Name</label>
                                    <input type="text" class="form-control" id="user_name" name="name" value="{{$user->name}}">
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-4 col-xl-6 mb-3">
                                    <label for="user_email">Email</label>
                                    <input type="text" class="form-control" id="user_email" name="email" value="{{$user->email}}" readonly>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
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
