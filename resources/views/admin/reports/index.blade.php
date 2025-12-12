@extends('admin.layout.master')
@section('content')
    <div class="container-fluid content bg-light">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <div class="row card p-4">
            <form id="reports" action="{{ route('export.reports') }}" method="GET" target="_blank">
                @csrf
                <div>
                    <h1>Reports</h1>
                    <hr>
                    <!-- Report Dropdowns -->
                    <div class="row
                mb-2">
                        <div class="col-md-6 mb-3">
                            <label for="report">Reports</label>
                            <select id="report" name="report" class="form-select">
                                <option value="">Choose Reports</option>
                                @foreach ($reports as $report)
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
                    <!-- Data filter for buyers -->
                    <div class="buyer_filter">
                        <div class="row mb-2">
                            <div class="col-md-6 mb-3" data-filter="buyer" style="display: none;">
                                <label>Buyers:</label>
                                <input type="text" id="buyerSearch" class="form-control mb-2"
                                    placeholder="Search buyers...">
                                <select class="form-select" name="buyer_id" id="dropdown" size=10
                                    onscroll="handleScroll(this)">
                                    <option value="all">All</option>
                                    @foreach ($initialItems as $item)
                                        <option value="{{ $item->BuyerID }}">{{ $item->FName }} {{ $item->LName }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3" data-filter="category" style="display: none;">
                                <label>Category:</label>
                                <select class="form-select" name="category" id="business_cat">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->CategoryID }}">{{ $category->BusinessCategory }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3" data-filter="sub category" style="display: none;">
                                <label>Sub Categories:</label>
                                <select class="form-select" name="subcategory" id="business_sub_cat">
                                    <option value="">Select Sub Category</option>
                                    @foreach ($subcategories as $subcategory)
                                        <option value="{{ $subcategory->SubCatID }}">{{ $subcategory->SubCategory }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3" data-filter="agent" style="display: none;">
                                <label>Agent:</label>
                                <select class="form-select" name="agent">
                                    <option value="">Select Agent</option>
                                    @foreach ($agents as $agent)
                                        <option value="{{ $agent->AgentID }}">{{ $agent->FName }} {{ $agent->LName }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3" data-filter="listing dba" style="display: none;">
                                <label>DBA:</label>
                                <select class="form-select" name="listing_dba">
                                    <option value="">Select DBA</option>
                                    @foreach ($listingDBA as $listingData)
                                        <option value="{{ $listingData->DBA }}">{{ $listingData->DBA }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3" data-filter="dba listing" style="display: none;">
                                <label>DBA:</label>
                                <select class="form-select" name="dba_listing">
                                    <option value="">Select DBA</option>
                                    @foreach ($listingDBA as $listingData)
                                        <option value="{{ $listingData->ListingID }}">{{ $listingData->DBA }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3" data-filter="status" style="display: none;">
                                <label>Status:</label>
                                <select class="form-select" name="status">
                                    <option value="">Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                    <option value="valid">Valid</option>
                                    <option value="">Solo-Exclusive</option>
                                    <option value="expired">Expired</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3" data-filter="buyerstatus" style="display: none;">
                                <label>Status:</label>
                                <select class="form-select" name="buyer_status">
                                    <option value="">Select Status</option>
                                    <option value="1">Hot</option>
                                    <option value="2">Medium</option>
                                    <option value="3">Cool</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3" data-filter="checkboxstatus" style="display: none;">
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
                            <div class="col-md-6 mb-3" data-filter="location" style="display: none;">
                                <label>Location:</label>
                                <select class="form-select" name="location">
                                    <option value="">Select Location</option>
                                    @foreach ($counties as $country)
                                        <option value="{{ $country->CountyID }}">{{ $country->County }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3" id="contact-dropdown" data-filter="contact"
                                style="display: none;">
                                <label for="contact">Contact</label>
                                <select id="contact" name="contact" class="form-select">
                                    <option value="">Select Contact</option>
                                    @foreach ($contacts as $contact)
                                        <option value="{{ $contact->ContactID }}">{{ $contact->FName }}
                                            {{ $contact->LName }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Contact Type Dropdown (Blank) -->
                            <div class="col-md-6 mb-3" id="contact-type-dropdown" data-filter="contact type"
                                style="display: none;">
                                <label for="contact_type">Type</label>
                                <select id="contact_type" name="contact_type" class="form-select">
                                    <option value="">Select Contact Type</option>
                                    @foreach ($contactTypes as $contactType)
                                        <option value="{{ $contactType->Type }}">{{ $contactType->Description }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3" id="lead-business-dropdown" data-filter="leadBusiness"
                                style="display: none;">
                                <label for="leadBusiness">Business Name</label>
                                <select id="leadBusiness" name="lead_business_name" class="form-select">
                                    <option value="">Select Business Name</option>
                                    @foreach ($leadBusinessNames as $leadBusinessName)
                                        <option value="{{ $leadBusinessName->LeadID }}">{{ $leadBusinessName->BusName }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3" data-filter="listListed" style="display: none;">
                                <label>Listed:</label>
                                <select class="form-select" name="list_listed">
                                    <option value="">Select Listed Status</option>
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3" data-filter="seller_first_name" style="display: none;">
                                <label>Seller First Name:</label>
                                <input type="text" name="seller_first_name" class="form-control"
                                    placeholder="First Name">
                            </div>
                            <div class="col-md-6 mb-3" data-filter="seller_last_name" style="display: none;">
                                <label>Seller Last Name:</label>
                                <input type="text" name="seller_last_name" class="form-control"
                                    placeholder="Last Name">
                            </div>
                            <div class="col-md-6 mb-3" data-filter="lead_city" style="display: none;">
                                <label>City:</label>
                                <input type="text" name="lead_city" class="form-control" placeholder="City">
                            </div>
                            <div class="col-md-6 mb-3" data-filter="offer_status" style="display: none;">
                                <label for="offer_status">Status</label>
                                <select class="form-select" id="offer_status" name="offer_status">
                                    <option value="" selected="">Select Status</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Accepted">Accepted</option>
                                    <option value="Closed">Closed</option>
                                    <option value="Dead">Dead</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3" data-filter="referral_status" style="display: none;">
                                <label for="referral_status">Status</label>
                                <select class="form-select" id="referral_status" name="referral_status">
                                    <option value="" selected="">Select Status</option>
                                    <option value="1">Borrower</option>
                                    <option value="2">Seller</option>
                                    <option value="3">Buyer</option>
                                    <option value="4">One Party</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3" data-filter="referral_name" style="display: none;">
                                <label for="referral_name">Status</label>
                                <select class="form-select" id="referral_name" name="referral_name">
                                    <option value="" selected="">Select company</option>
                                    @foreach ($referralsNames as $referralsName)
                                        <option value="{{ $referralsName->RefID }}">{{ $referralsName->RefCompany }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </div>
                    <!-- Data filter for buyers end  -->

                    <!-- Date Range Option Radios -->
                    <div class="row mb-2" id="date-option-section" data-filter="date range" style="display: none;">
                        <div class="col-md-12 text-center">
                            <label class="mb-2 d-block">Date Range</label>
                            <div class="d-flex justify-content-center gap-4">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="date_option" id="past_month"
                                        value="past_month" checked>
                                    <label class="form-check-label" for="past_month">Past Month</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="date_option" id="past_year"
                                        value="past_year">
                                    <label class="form-check-label" for="past_year">Past Year</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="date_option" id="custom"
                                        value="custom">
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
                    <!-- Submit -->
                    <div class="text-center">
                        <button class="btn btn-primary" type="submit">Download</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <style>
        #dropdown {
            height: 150px !important;
            overflow-y: auto !important;
        }
    </style>
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        const reportFilterConfig = {
            5: ['date range'],
            6: ['agent'],
            8: ['agent', 'date range'],
            9: ['buyer', 'location', 'agent', 'buyerstatus', 'date range'],
            10: ['buyer', 'date range'],
            11: ['buyer', 'date range'],
            12: ['agent', 'date range'],
            13: ['buyer', 'agent', 'date range'],
            14: ['buyer'],
            16: ['buyer', 'sub category', 'location', 'buyerstatus', 'date range'],
            17: ['agent', 'date range'],
            18: ['agent'],
            19: ['buyer'],
            23: ['listing dba', 'buyer', 'agent', 'date range'],
            24: ['listing dba', 'buyer', 'agent', 'date range'],
            25: ['contact', 'contact type'],
            26: ['contact', 'contact type'],
            28: ['buyer'],
            29: ['buyer'],
            31: ['leadBusiness', 'agent', 'listListed', 'seller_first_name', 'seller_last_name', 'lead_city',
                'date range'
            ],
            32: ['leadBusiness'],
            33: ['sub category'],
            35: ['category', 'sub category', 'agent', 'status', 'checkboxstatus', 'date range'],
            36: ['listing dba', 'category', 'sub category', 'status'],
            41: ['category', 'sub category', 'agent', 'status', 'checkboxstatus', 'date range'],
            45: ['dba listing'],
            46: ['dba listing', 'date range'],
            51: ['category', 'sub category', 'agent', 'status', 'checkboxstatus', 'date range'],
            53: ['dba listing', 'buyer', 'offer_status', 'agent', 'date range'],
            54: ['dba listing', 'buyer', 'offer_status', 'agent', 'date range'],
            55: ['referral_status'],
            56: ['referral_name'],
            57: ['referral_status'],
        };
        let currentPage = 2; // Initial 10 are already loaded
        let loading = false;
        let allLoaded = false;
        let searchQuery = '';

        const dropdown = document.getElementById('dropdown');
        const searchInput = document.getElementById('buyerSearch');

        function handleScroll(dropdown) {
            if (loading || allLoaded) return;

            // Check if user scrolled to bottom
            if (dropdown.scrollTop + dropdown.clientHeight >= dropdown.scrollHeight - 5) {
                loadMoreOptions();
            }
        }

        function loadMoreOptions(reset = false) {
            if (reset) {
                currentPage = 1;
                allLoaded = false;
                dropdown.innerHTML = '<option value="all">All</option>'; // reset options
            }

            loading = true;

            fetch(`{{ route('dropdown.data') }}?page=${currentPage}&search=${encodeURIComponent(searchQuery)}`)
                .then(response => response.json())
                .then(data => {
                    if (data.length === 0) {
                        if (currentPage === 1) {
                            dropdown.innerHTML = '<option disabled>No buyers found</option>';
                        }
                        allLoaded = true;
                    } else {
                        data.forEach(item => {
                            const option = document.createElement('option');
                            option.value = item.BuyerID;
                            option.textContent = item.FName + ' ' + item.LName;
                            dropdown.appendChild(option);
                        });
                        currentPage++;
                    }
                    loading = false;
                })
                .catch(err => {
                    console.error('Error loading more data:', err);
                    loading = false;
                });
        }
        searchInput.addEventListener('input', function() {
            searchQuery = this.value;
            loadMoreOptions(true); // reset + load with search
        });
    </script>
    <script>
        function toggleDateRange() {
            const reportSelected = $('#report').val() !== '';
            const reportTypeSelected = $('#report2').val() !== '';
            if (reportSelected && reportTypeSelected) {
                $('#date-option-section').show();
                setDateRange($('input[name="date_option"]:checked').val());
            } else {
                $('#date-option-section').hide();
                $('#date-range-section').hide();
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
                $('#date-range-section').hide();
            } else if (option === 'past_year') {
                const pastYear = new Date();
                pastYear.setFullYear(pastYear.getFullYear() - 1);
                fromDate = pastYear.toISOString().split('T')[0];
                $('#date-range-section').hide();
            } else if (option === 'custom') {
                $('#date-range-section').show();
                return;
            }
            $('#from_date').val(fromDate);
            $('#to_date').val(toDate);
        }

        function toggleDynamicFilters() {
            const selectedReport2 = $('#report2').val();

            // Always hide all filters first
            $('[data-filter]').hide();

            // If nothing selected, just stop
            if (!selectedReport2) return;

            const allowedFilters = reportFilterConfig[selectedReport2] || [];

            allowedFilters.forEach(filter => {
                $(`[data-filter="${filter}"]`).show();
            });
        }
        $(document).ready(function() {
            $('#report, #report2').on('change', function() {
                toggleDateRange();
                toggleDynamicFilters();
            });
            $('input[name="date_option"]').on('change', function() {
                setDateRange(this.value);
            });
            $('#report').change(function() {
                var id = $(this).val();
                if (id) {
                    $.ajax({
                        url: '{{ route('get.subreports') }}',
                        type: 'GET',
                        dataType: 'json',
                        data: {
                            report_id: id
                        },
                        success: function(data) {
                            $('#report2').empty().append(
                                '<option value="">Select Report Type</option>');
                            $.each(data, function(key, value) {
                                $('#report2').append('<option value="' + value.id +
                                    '">' + value.name + '</option>');
                            });
                            toggleDateRange();
                            toggleDynamicFilters();
                        }
                    });
                } else {
                    $('#report2').empty().append('<option value="">Select Report Type</option>');
                    toggleDateRange();
                    toggleDynamicFilters();
                }
            });

            $('#business_cat').change(function() {
                var id = $(this).val();
                if (id) {
                    $.ajax({
                        url: '{{ route('get.business.sub.categories') }}',
                        type: 'GET',
                        dataType: 'json',
                        data: {
                            business_cat_id: id
                        },
                        success: function(data) {
                            $('#business_sub_cat').empty().append(
                                '<option value="">select sub category</option>');
                            $.each(data, function(key, value) {
                                $('#business_sub_cat').append('<option value="' + value
                                    .SubCatID + '">' + value.SubCategory +
                                    '</option>');
                            });
                            toggleDateRange();
                        }
                    });
                } else {
                    $('#business_sub_cat').empty().append('<option value="">select sub category</option>');
                    toggleDateRange();
                }
            });
        });
    </script>
@endsection
