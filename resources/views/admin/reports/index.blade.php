@extends('admin.layout.master')
@section('content')
<div class="container-fluid content bg-light">
    <div class="row card p-4">
        <form id="reports" action="{{route('export.reports')}}" method="post">
            @csrf
            <div>
                <h1>Reports</h1>
                <hr>
                <div class="row mb-2">
                    <div class="col-md-6 mb-3">
                        <label for="categoryName">Reports</label>
                        <select id="report" name="report" class="form-select">
                            <option value="" selected="">Choose Reports</option>
                            <option value="listing">Listing</option>
                            <option value="leads">Leads</option>
                            <option value="offer">Offer</option>
                            <option value="agent">Agent</option>
                            <option value="buyer">Buyer</option>
                            <option value="contact">Contact</option>
                            <option value="referral">Referral</option>
                        </select>
                        @error('report')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center" style="overflow:auto;">
                <div>
                    <button class="btn-primary" type="submit" id="prevBtn">Download</button>
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
        $('#reports').validate({
            rules: {
                report: {
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