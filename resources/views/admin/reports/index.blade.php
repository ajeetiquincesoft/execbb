@extends('admin.layout.master')
@section('content')
<div class="container-fluid content bg-light">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="row card p-4">
        <form id="reports" action="{{ route('export.reports') }}" method="POST">
            @csrf
            <div>
                <h1>Reports</h1>
                <hr>
                <!-- Report Dropdowns -->
                <div class="row mb-2">
                    <div class="col-md-6 mb-3">
                        <label for="report">Reports</label>
                        <select id="report" name="report" class="form-select">
                            <option value="">Choose Reports</option>
                            @foreach($reports as $report)
                            <option value="{{ $report->id }}">{{ $report->name }}</option>
                            @endforeach
                        </select>
                        @error('report')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="report2">Select Report Type</label>
                        <select id="report2" name="report2" class="form-select">
                            <option value="">Select Report Type</option>
                        </select>
                        @error('report2')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Date Range Option Radios -->
                <div class="row mb-2" id="date-option-section" style="display: none;">
                    <div class="col-md-12 text-center">
                        <label class="mb-2 d-block">Date Range</label>
                        <div class="d-flex justify-content-center gap-4">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="date_option" id="past_month" value="past_month" checked>
                                <label class="form-check-label" for="past_month">Past Month</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="date_option" id="past_year" value="past_year">
                                <label class="form-check-label" for="past_year">Past Year</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="date_option" id="custom" value="custom">
                                <label class="form-check-label" for="custom">Custom</label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Date Range Fields -->
                <div id="date-range-section" style="display: none;">
                    <div class="row mb-2">
                        <div class="col-md-6 mb-3">
                            <label for="from_date">From Date</label>
                            <input type="date" id="from_date" name="from_date" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="to_date">To Date</label>
                            <input type="date" id="to_date" name="to_date" class="form-control">
                        </div>
                    </div>
                </div>
                <!--  Listing-Specific Dropdowns + Checkboxes -->
                <div id="listing-extra-filters" style="display: none;">
                    <div class="row mb-2">
                        <div class="col-md-6 mb-3">
                            <label>Category:</label>
                            <select class="form-select" name="category" id="business_cat">
                                <option value="">select category</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->CategoryID }}">{{ $category->BusinessCategory }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Sub Category:</label>
                            <select class="form-select" name="subcategory" id="business_sub_cat">
                                <option value="">select sub category</option>
                                @foreach($subcategories as $subcategory)
                                <option value="{{ $subcategory->SubCatID}}">{{ $subcategory->SubCategory }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6 mb-3">
                            <label>Agent:</label>
                            <select class="form-select" name="agent">
                                <option value="">select agent</option>
                                @foreach($agents as $agent)
                                <option value="{{ $agent->AgentID }}">{{ $agent->FName }} {{ $agent->LName }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Status:</label>
                            <select class="form-select" name="status">
                                <option value="">select status</option>
                                <option value="valid">Valid</option>
                                <option value="invalid">Invalid</option>
                                <option value="expired">Expired</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>
                            <input type="hidden" name="franchise" value="0">
                            <input type="checkbox" name="franchise" value="1"> Franchise
                        </label><br>

                        <label>
                            <input type="hidden" name="real_estate_inc" value="0">
                            <input type="checkbox" name="real_estate_inc" value="1"> Real Estate Inc
                        </label><br>

                        <label>
                            <input type="hidden" name="best_buy" value="0">
                            <input type="checkbox" name="best_buy" value="1"> Best Buy
                        </label>
                    </div>
                </div>
                <!-- Submit -->
                <div class="text-center">
                    <button class="btn btn-primary" type="submit">Download</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function toggleDateRange() {
        const reportSelected = $('#report').val() !== '';
        const reportTypeSelected = $('#report2').val() !== '';
        if (reportSelected && reportTypeSelected) {
            $('#date-option-section').slideDown();
            setDateRange($('input[name="date_option"]:checked').val());
        } else {
            $('#date-option-section').slideUp();
            $('#date-range-section').slideUp();
        }
    }

    function setDateRange(option) {
        const now = new Date();
        let fromDate = '';
        let toDate = new Date().toISOString().split('T')[0];
        if (option === 'past_month') {
            const pastMonth = new Date();
            pastMonth.setMonth(pastMonth.getMonth() - 1);
            fromDate = pastMonth.toISOString().split('T')[0];
            $('#date-range-section').slideUp();
        } else if (option === 'past_year') {
            const pastYear = new Date();
            pastYear.setFullYear(pastYear.getFullYear() - 1);
            fromDate = pastYear.toISOString().split('T')[0];
            $('#date-range-section').slideUp();
        } else if (option === 'custom') {
            $('#date-range-section').slideDown();
            return;
        }
        $('#from_date').val(fromDate);
        $('#to_date').val(toDate);
    }

    function toggleListingExtras() {
        const reportName = $('#report option:selected').text().trim().toLowerCase();
        const report2Selected = $('#report2').val() !== '';
        if (reportName === 'listing' && report2Selected) {
            $('#listing-extra-filters').slideDown();
        } else {
            $('#listing-extra-filters').slideUp();
        }
    }
    $(document).ready(function() {
        $('#report, #report2').on('change', function() {
            toggleDateRange();
            toggleListingExtras();
        });
        $('input[name="date_option"]').on('change', function() {
            setDateRange(this.value);
        });
        $('#report').change(function() {
            var id = $(this).val();
            if (id) {
                $.ajax({
                    url: '{{ route("get.subreports") }}',
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        report_id: id
                    },
                    success: function(data) {
                        $('#report2').empty().append('<option value="">Select Report Type</option>');
                        $.each(data, function(key, value) {
                            $('#report2').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                        toggleDateRange();
                        toggleListingExtras();
                    }
                });
            } else {
                $('#report2').empty().append('<option value="">Select Report Type</option>');
                toggleDateRange();
                toggleListingExtras();
            }
        });

        $('#business_cat').change(function() {
            var id = $(this).val();
            if (id) {
                $.ajax({
                    url: '{{ route("get.business.sub.categories") }}',
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        business_cat_id: id
                    },
                    success: function(data) {
                        $('#business_sub_cat').empty().append('<option value="">select sub category</option>');
                        $.each(data, function(key, value) {
                            $('#business_sub_cat').append('<option value="' + value.SubCatID + '">' + value.SubCategory + '</option>');
                        });
                        toggleDateRange();
                        toggleListingExtras();
                    }
                });
            } else {
                $('#business_sub_cat').empty().append('<option value="">select sub category</option>');
                toggleDateRange();
                toggleListingExtras();
            }
        });
    });
</script>
@endsection