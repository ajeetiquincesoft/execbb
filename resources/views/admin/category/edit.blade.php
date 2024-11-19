
   
@extends('admin.layout.master')
@section('content')
        <div class="container-fluid content bg-light">
            <div class="row card p-4">
                <form id="editCategory" action="{{ route('update.categories',$categoryData->CategoryID) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div>
                        <h1>Categories:</h1>
                        <hr>
                        <div class="row mb-2">
                            <div class="col-md-6 mb-3">
                                <label for="categoryName">Category Name</label>
                                <input type="text" class="form-control" id="categoryName" name="categoryName" value="{{$categoryData->BusinessCategory}}">
                                @error('categoryName')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="master">Master</label>
                                <input type="text" class="form-control" id="master" name="master"  value="{{$categoryData->master}}">
                                @error('master')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center" style="overflow:auto;">
                        <div>
                            <button class="btn-primary" type="submit" id="prevBtn">Update</button>
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
                $('#editCategory').validate({
                    rules: {
                        categoryName: {
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