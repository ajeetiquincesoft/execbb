
   
@extends('admin.layout.master')
@section('content')
        <div class="container-fluid content bg-light">
            <div class="row card p-4">
                <form id="storeContactType" action="{{ route('store.contact-type') }}" method="post">
                    @csrf
                    <div>
                        <h1>Add Contact Type</h1>
                        <hr>
                        <div class="row mb-2">
                            <div class="col-md-6 mb-3">
                                <label for="contactType">Contact Type</label>
                                <input type="text" class="form-control" id="contactType" name="contactType" value="{{old('contactType')}}">
                                @error('contactType')
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
                $('#storeContactType').validate({
                    rules: {
                        contactType: {
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