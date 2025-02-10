@extends('admin.layout.master')
@section('content')
        @if(Session::has('error_message'))
        <div class="alert alert-danger alert-block" id="alert-success">
          <button type="button" class="close" data-dismiss="alert">×</button> 
            <strong>{{ Session::get('error_message') }}</strong>
        </div>
        @endif
        <div class="container-fluid content bg-light">
            <div class="row card p-4">
                <form id="addnewliststep5" action="{{ route('store.listing.step5') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ session('formData.listing_id') ? session('formData.listing_id') : '' }}">
                    <!-- One "tab" for each step in the form: -->
                   
                    <div class="tab" style="display: block;">
                        <h4>Comments </h4>
                        <hr>
                        <div class="comment-area w-100">
                            <div class="row mb-3">
                                <!-- Highlights -->
                                <div class="col lis_highlights">
                                    <label for="highlights" class="form-label">Highlights</label>
                                    <textarea class="form-control" id="highlights" name="highlights" rows="4">{{ old('highlights') }}</textarea>
                                    @error('highlights')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <!-- Directions -->
                                <div class="col">
                                    <label for="directions" class="form-label">Directions</label>
                                    <textarea class="form-control" id="directions" name="directions" rows="4">{{ old('directions') }}</textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <!-- Comments -->
                                <div class="col lis_comment">
                                    <label for="comments" class="form-label">Comments</label>
                                    <textarea class="form-control" id="comments" name="comments" rows="4">{{ old('comments') }}</textarea>
                                    @error('comments')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <!-- Lead ID -->
                                <div class="col">
                                    <label for="leadId" class="form-label">Lead ID</label>
                                    <select id="leadId" name="leadId" class="form-select">
                                        <option value="" selected="">Select lead</option>
                                        @foreach($leads as $key=>$lead)
                                        <option value="{{$lead->LeadID}}" {{ (old('leadId') == $lead->LeadID || session('formData.leadId') == $lead->LeadID) ? 'selected' : '' }}>{{$lead->LeadID}}</option>
                                        @endforeach
                                    </select>
                                    @error('leadId')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center" style="overflow:auto;">
                        <div>
                        <a href="{{route('create.listing.step4')}}"><button class="btn-primary" type="button" id="prevBtn">Previous</button></a>
                            <button class="btn-primary" type="submit" id="nextBtn">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div p-8="">
            <p>&nbsp;</p>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
        <script>
        ClassicEditor
            .create(document.querySelector('#comments'))
            .then(editor => {
            editor.model.document.on('change:data', function() {
                const emailContent = editor.getData();
                $('#comments').val(emailContent);
                $('#addnewliststep5').valid();
            });
        })
        .catch(error => {
            console.error(error);
        });
        ClassicEditor
            .create(document.querySelector('#highlights'))
            .then(editor => {
            editor.model.document.on('change:data', function() {
                const emailContent = editor.getData();
                $('#highlights').val(emailContent);
                $('#addnewliststep5').valid();
            });
        })
        .catch(error => {
            console.error(error);
        });
        ClassicEditor
            .create(document.querySelector('#directions'))
            .catch(error => {
                console.error(error);
            });
    </script>
        <script>
           $(document).ready(function () {
                $('#addnewliststep5').validate({
                    rules: { 
                    },
                    ignore: ":disabled",
                    messages: {
                
                    },
                    errorPlacement: function(error, element) {
                      if (element.attr("name") == "comments") {
                            error.appendTo(element.closest(".lis_comment")); // Put the error after the field
                        } else if (element.attr("name") == "highlights") {
                            error.appendTo(element.closest(".lis_highlights")); // Put the error after the field
                        }
                        else {
                            error.insertAfter(element);
                        }
                    },
                    submitHandler: function (form) { 
                        form.submit();
                    }
                });
});

            </script>
        <style>
        .form-check-input[type=checkbox] {
            position: absolute !important;
            top: 40% !important;
            left: 5% !important;
            margin: 0;
        }

        h4.form-sec {
            font-family: inter;
            font-weight: 600;
            font-size: 1.1rem;
            color: #000;
        }

        .tab h3 {
            font-size: 23px;
            font-weight: 600;
            font-family: 'Inter';
            color: #000;
        }

        .tab label {
            font-weight: 600;
            color: #444444;
            font-size: 13px;
            font-family: 'Inter';
        }

        button#nextBtn,
        button#prevBtn {
            padding: 10px 45px;
            border-radius: 5px;
            box-shadow: unset;
        }
        input:not([type=checkbox]) {
            padding: 0.7rem !important;
            border-radius: 0px !important;
        }

        .form-control {
            height: unset !important;
        }

        .form-check label.form-check-label {
            margin: 7px 20px 7px 7px;
        }

        input:focus,
        select:focus {
            border-color: #5d1229 !important;
            box-shadow: unset !important;
            border-radius: 0px !important;
        }

        .comment-area {
            width: 55% !important;
            margin: auto;
        }

        /* upload button style */
        .upload-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .upload-btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
        }

        .thumbnail {
            width: 200px;
            height: 200px;
            object-fit: cover;
            margin-top: 20px;
            display: none;
        }

        .file-info {
            display: none;
            font-size: 14px;
            margin-top: 10px;
        }

        .upload-button {
            background-color: #620022 !important;
            /* Burgundy color */
            padding: 10px 20px !important;
            border-radius: 5px !important;
            cursor: pointer !important;
            color: #ffff !important;
        }

        .button-text {
            display: inline-block;
        }

        #imagePreview {
            margin-top: 20px;
            display: none;
        }

        #imagePreview img {
            max-width: 100px;
        }

        #fileLink {
            cursor: pointer;
            font-weight: 600;
        }

        span.button-text img {
            margin-right: 10px;
            width: 18px;
        }

        span.button-text {
            font-size: 0.80rem;
            font-weight: 400;
            font-family: 'Inter';
            letter-spacing: 0.50px;
        }
        </style>
@endsection