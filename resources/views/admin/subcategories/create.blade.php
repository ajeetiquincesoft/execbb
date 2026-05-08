@extends('admin.layout.master')
@section('content')
    <div class="container-fluid content bg-light">
        <div class="row card p-4">
            <form id="storeSubCategory" action="{{ route('store.sub.category') }}" method="post">
                @csrf
                <div>
                    <h1>Add Sub Category</h1>
                    <hr>
                    <div class="row mb-2">
                        <div class="col-md-6 mb-3">
                            <label for="subCategoryName">Sub Category Name</label>
                            <input type="text" class="form-control" id="subCategoryName" name="subCategoryName"
                                value="{{ old('subCategoryName') }}">
                            @error('subCategoryName')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="assignCategory">Assign To Category</label>

                            <select name="parentCategory" class="form-control">

                                <option value="">Select Category</option>

                                @foreach ($categories as $category)
                                    <option value="{{ $category->CategoryID }}">
                                        {{ $category->BusinessCategory }}
                                    </option>
                                @endforeach

                            </select>
                            @error('parentCategory')
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
        $(document).ready(function() {
            $('#storeSubCategory').validate({
                rules: {
                    subCategoryName: {
                        required: true
                    },

                },
                messages: {

                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
@endsection
