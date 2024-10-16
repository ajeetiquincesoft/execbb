@extends('admin.layout.master')
@section('content')


<main class="signup-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-12">
                    <h3 class="card-header text-center">Update Agent</h3>
                    <div class="card-body">

                        <form action="{{ route('update.agent',$agent->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <input type="text" placeholder="Name" id="name" class="form-control" name="name" value="{{$agent->name}}"
                                        required>
                                        @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                     </div>
                                </div>
                                <div class="col-md-6">
                                     <div class="form-group mb-3">
                                        <input type="text" placeholder="Email" id="email_address" class="form-control"
                                            name="email" value="{{$agent->email}}" required>
                                        @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                           
                            <div class="col-md-3">
                                <div class="d-grid mx-auto">
                                    <button type="submit" class="btn btn-dark btn-block">Update</button>
                                </div>
                            </div>
                        </form>

                    </div>
            </div>
        </div>
    </div>
</main>
@endsection