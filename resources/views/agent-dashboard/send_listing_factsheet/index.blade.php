@extends('agent-dashboard.layout.master')
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
            <form id="shareListingBuyer" action="{{ route('agent.share.listing.factsheet.with.buyer') }}" method="post">
                @csrf
                <div>
                    <h1>Share Listing Factsheet to Buyer:</h1>
                    <hr>
                    <div class="row mb-2">
                        <div class="col-12 col-md-6 mb-3 rep_email">
                            <label for="Recipient Email">Buyer Email <span class="text-danger">*</span></label>
                            <select id="recipientEmailShareListing" name="recipientEmail[]" class="form-select" multiple>
                                <!-- @foreach ($buyers as $key => $buyer)
    <option value="{{ $buyer->Email }}">{{ $buyer->Email }}</option>
    @endforeach -->
                            </select>
                            @error('recipientEmail')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-md-6 mb-3 lis_name">
                            <label for="Subject">Listing <span class="text-danger">*</span></label>
                            <select id="listingName" name="listingName[]" class="form-select" multiple>
                                @foreach ($listings as $key => $listing)
                                    @if (!empty($listing->CorpName))
                                        <option value="{{ $listing->ListingID }}">{{ $listing->CorpName }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('listingName')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-3 em_content">
                            <label for="Content">Content</label>
                            <textarea class="form-control ckeditor" id="email_content" name="email_content">{{ old('email_content') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center" style="overflow:auto;">
                    <div>
                        {{-- <button class="btn-primary" type="submit" id="prevBtn">Submit</button> --}}
                        <button class="btn btn-primary" type="submit" id="prevBtn">
                            <span class="btn-text">Submit</span>
                            <span class="btn-loading d-none">Submitting...</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div p-8="">
        <p>&nbsp;</p>
    </div>
    <style>
        #prevBtn[disabled] {
            opacity: 0.7;
            cursor: not-allowed;
        }

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
        ClassicEditor
            .create(document.querySelector('#email_content'))
            .catch(error => {
                console.error(error);
            });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let isSubmitting = false;
            $.validator.addMethod('requiredMultiSelect', function(value, element) {
                return this.optional(element) || $(element).val().length > 0;
            }, 'Please select at least one recipient');
            $.validator.addMethod('requiredMultiSelectListing', function(value, element) {
                return this.optional(element) || $(element).val().length > 0;
            }, 'Please select at least one listing');
            $('#shareListingBuyer').validate({

                rules: {
                    "recipientEmail[]": {
                        required: true,
                        requiredMultiSelect: true
                    },
                    "listingName[]": {
                        required: true,
                        requiredMultiSelectListing: true
                    },

                },
                ignore: ":disabled",
                messages: {
                    "recipientEmail[]": {
                        requiredMultiSelect: "Please select at least one recipient"
                    },
                    "listingName[]": {
                        requiredMultiSelect: "Please select at least one listing"
                    }

                },
                errorPlacement: function(error, element) {
                    // Place the error messages directly under the respective fields
                    if (element.attr("name") == "recipientEmail[]") {
                        error.appendTo(element.closest(".rep_email")); // Put the error after the field
                    } else if (element.attr("name") == "listingName[]") {
                        error.appendTo(element.closest(".lis_name")); // Put the error after the field
                    } else {
                        error.insertAfter(element); // Default placement for other fields
                    }
                },
                submitHandler: function(form) {
                    if (isSubmitting) {
                        return false;
                    }

                    isSubmitting = true;

                    // Disable button + show loader
                    const btn = $('#prevBtn');
                    btn.prop('disabled', true);
                    btn.find('.btn-text').addClass('d-none');
                    btn.find('.btn-loading').removeClass('d-none');

                    form.submit();
                },
                invalidHandler: function() {
                    enableSubmitButton(); // Re-enable if validation fails
                }
            });
            // Re-enable button helper
            function enableSubmitButton() {
                isSubmitting = false;
                const btn = $('#prevBtn');
                btn.prop('disabled', false);
                btn.find('.btn-text').removeClass('d-none');
                btn.find('.btn-loading').addClass('d-none');
            }
            $('#recipientEmailShareListing').on('change', function() {
                // Validate the form when the selection changes
                $('#recipientEmailShareListing').valid();
            });
            $('#listingName').on('change', function() {
                // Validate the form when the selection changes
                $('#listingName').valid();
            });
            //script for ajax search and loading buyers
            $('#recipientEmailShareListing').select2({
                placeholder: 'Search Buyer Email',
                minimumInputLength: 1,
                ajax: {
                    url: "{{ route('agent.get.buyers.ajax') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term, // Search term
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
            //end script for ajax search and loading buyers
        });
    </script>
@endsection
