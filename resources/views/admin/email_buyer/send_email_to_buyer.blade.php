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
                    <div class="col-12 col-md-6 mb-3 rep_email">
                        <label for="Recipient Email">Recipient Email <span class="text-danger">*</span></label>
                        <select id="recipientEmailBuyer" name="recipientEmail[]" class="form-select" multiple>
                            <!-- @foreach($buyers as $key=>$buyer)
                            <option value="{{$buyer->Email}}">{{$buyer->FName}} | {{$buyer->HomePhone}} | {{$buyer->Email}}</option>
                            @endforeach -->
                        </select>
                        @error('recipientEmail')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <label for="Subject">Subject <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm" id="subject" name="subject" value="{{old('subject')}}">
                        @error('subject')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-12 mb-3 em_content">
                        <label for="Content">Content <span class="text-danger">*</span></label>
                        <textarea class="form-control ckeditor" id="emai_content" name="email_content" required>{{ old('email_content') }}</textarea>
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
<style>
    .ck-editor__editable {
        min-height: 300px !important;
        /* Set the min-height to whatever you need */
    }

    .rep_email .select2-container {
        width: 100% !important;
        /* Ensures the Select2 container takes up full width */
    }
</style>

<script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>

<script>
    // Initialize CKEditor for the email content field
    ClassicEditor
        .create(document.querySelector('#emai_content'))
        .then(editor => {
            // Bind the CKEditor content change to manually update the textarea and trigger validation
            editor.model.document.on('change:data', function() {
                // Update the hidden textarea with CKEditor content
                const emailContent = editor.getData();
                $('#emai_content').val(emailContent);

                // Trigger validation after content update
                $('#emailBuyer').valid();
            });
        })
        .catch(error => {
            console.error(error);
        });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $.validator.addMethod('requiredMultiSelect', function(value, element) {
            // Check if any option is selected
            return this.optional(element) || $(element).val().length > 0;
        }, 'Please select at least one recipient');
        $('#emailBuyer').validate({

            rules: {
                "recipientEmail[]": {
                    required: true,
                    requiredMultiSelect: true
                },
                subject: {
                    required: true
                },
                email_content: {
                    required: true
                },

            },
            ignore: ":disabled",
            messages: {
                "recipientEmail[]": {
                    requiredMultiSelect: "Please select at least one recipient"
                }

            },
            errorPlacement: function(error, element) {
                // Place the error messages directly under the respective fields
                if (element.attr("name") == "recipientEmail[]") {
                    error.appendTo(element.closest(".rep_email")); // Put the error after the field
                } else if (element.attr("name") == "email_content") {
                    error.appendTo(element.closest(".em_content")); // Put the error after the field
                } else {
                    error.insertAfter(element); // Default placement for other fields
                }
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
        $('#recipientEmailBuyer').on('change', function() {
            // Validate the form when the selection changes
            $('#recipientEmailBuyer').valid();
        });
        //script for email to buyers
        $('#recipientEmailBuyer').select2({
            placeholder: 'Search by Name, Phone, or Email',
            minimumInputLength: 1,
            ajax: {
                url: '{{ route("buyers.email.ajax") }}',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term,
                        page: params.page || 1
                    };
                },
                processResults: function(data, params) {
                    params.page = params.page || 1;
                    return {
                        results: data.items,
                        pagination: {
                            more: data.pagination.more
                        }
                    };
                },
                cache: true
            }
        });
        //end script for emails to buyers
    });
</script>
@endsection