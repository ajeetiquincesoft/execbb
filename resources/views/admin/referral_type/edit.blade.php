
   
@extends('admin.layout.master')
@section('content')
        <div class="container-fluid content bg-light">
            <div class="row card p-4">
                <form id="editReferralType" action="{{ route('update.referral-type',$referral_type->RefTypeID) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div>
                        <h1>Categories:</h1>
                        <hr>
                        <div class="row mb-2">
                            <div class="col-md-6 mb-3">
                                <label for="categoryName">Referral Type</label>
                                <input type="text" class="form-control" id="referralType" name="referralType" value="{{$referral_type->RefTypeDescript}}">
                                @error('referralType')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex justify-content-center align-items-center" style="overflow:auto;">
                                    <div>
                                        <button class="btn-primary" type="submit" id="prevBtn">Update</button>
                                    </div>
                                </div>
                            </div>
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
                $('#editReferralType').validate({
                    rules: {
                        referralType: {
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