
   
@extends('admin.layout.master')
@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-error">
        {{ session('error') }}
    </div>
@endif
        <div class="container-fluid content bg-light">
            <div class="row card p-4">
                <form id="emailBuyer" action="{{ route('email.buyer.send') }}" method="post">
                    @csrf
                    <div>
                        <h1>Email Buyer:</h1>
                        <hr>
                        <div class="row mb-2">
                            <div class="col-md-6 mb-3">
                                <label for="Recipient Email">Recipient Email</label>
                                <select id="recipientEmail" name="recipientEmail[]" class="form-select " multiple>
                                   @foreach($buyers as $key=>$buyer)
                                    <option value="{{$buyer->Email}}">{{$buyer->Email}}</option>
                                    @endforeach
                                </select>
                                @error('recipientEmail')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="Subject">Subject</label>
                                <input type="text" class="form-control form-control-sm" id="subject" name="subject" value="{{old('subject')}}">
                                @error('subject')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12 mb-3">
                                <label for="Content">Content</label>
                                <textarea  class="form-control" id="emai_content" name="email_content" rows="5" required>{{ old('email_content') }}</textarea>
                                @error('email_content')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center" style="overflow:auto;">
                        <div>
                            <button class="btn-primary" type="submit" id="prevBtn">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div p-8="">
            <p>&nbsp;</p>
        </div>
  
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  
           $(document).ready(function () {
                $('#emailBuyer').validate({
                    rules: {
                        recipientEmail: {
                            required: true
                        },
                        subject: {
                            required: true
                        },
                        emai_content: {
                            required: true
                        },
                        
                    },
                    messages: {
                      
                    },
                    submitHandler: function (form) {
                        form.submit();
                    }
                });
            });
</script>
@endsection