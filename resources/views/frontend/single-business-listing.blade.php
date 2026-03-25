@extends('frontend.layout.master')

@section('content')
    <!-- Check if there's an error message in the session -->

    <!-- Breadcrumb Section -->
    <div class="breadcrumb-container py-3">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('business.listings') }}">Business Listing</a></li>
                    <li class="breadcrumb-item active"><a href="#">Listing View</a></li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Main Post Section -->
    <div class="container-fluid listing-modern">
        <div class="container">
            <div class="row g-4">

                <!-- LEFT SIDE -->
                <div class="col-lg-8">

                    <!-- TITLE -->
                    <div class="listing-header">
                        <h2>{{ $listing->CorpName ?? $listing->DBA }}</h2>
                        <p>{{ $listing->City }}, {{ $listing->State }}</p>
                    </div>

                    <!-- IMAGE + OVERLAY -->
                    <div class="listing-image-box">

                        @if (!empty($listing->imagepath))
                            <img src="{{ asset('assets/uploads/images/' . $listing->imagepath) }}">
                        @else
                            <img src="{{ asset('assets/images/business_image.jpg') }}">
                        @endif
                        @php
                            $cash_flow = $listing->GrossRevenue - $listing->TotalExpenses;
                        @endphp
                        <!-- PRICE BAR -->
                        <div class="price-overlay">
                            <div>Asking Price <strong>${{ number_format($listing->REAskingPrice) }}</strong></div>
                            <div>Cash Flow <strong>${{ number_format($listing->cash_flow) }}</strong></div>
                        </div>

                        <!-- LISTING ID -->
                        <div class="listing-id">
                            Listing ID: {{ $listing->ListingID }}
                        </div>
                    </div>

                    <!-- SHARE BUTTONS -->
                    @if (auth()->check() && (auth()->user()->role_name == 'admin' || auth()->user()->role == 'agent'))
                        <div class="share-bar">
                            <button onclick="window.print()" class="btn btn-sm custom-btn-listing">
                                <i class="fa fa-print"></i> Print
                            </button>

                            <button class="btn btn-sm custom-btn-listing" data-bs-toggle="modal"
                                data-bs-target="#shareModal">
                                <i class="fa fa-share"></i> Share Factsheet
                            </button>
                        </div>
                    @endif
                    @if (auth()->check() && auth()->user()->role_name === 'buyer')
                        <div class="like-card" data-listing-id="{{ $listing->ListingID }}">

                            <div class="like-header">
                                <span>Do you like this listing?</span>
                            </div>

                            <div class="like-actions">
                                <button class="like-btn {{ $likeVal == 1 ? 'active' : '' }}" data-type="like">
                                    <i class="fa fa-thumbs-up"></i>
                                    <span>Like</span>
                                </button>

                                <button class="dislike-btn {{ $likeVal == 2 ? 'active' : '' }}" data-type="dislike">
                                    <i class="fa fa-thumbs-down"></i>
                                    <span>Dislike</span>
                                </button>
                            </div>

                            <div class="like-count">
                                👍 <span id="likeCount">{{ $likeCount }}</span> Likes
                            </div>

                        </div>
                    @endif
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="tags single-badge">
                            <span class="badge">{{ $listing->BusType }}</span>
                            <span class="badge">{{ $subCatName }}</span>
                        </div>
                        <div class="share-bar">
                            <a href="{{ route('register.with.ebb') }}" class="btn btn-sm custom-btn-listing">
                                <i class="fa fa-user-plus"></i> Register for more information
                            </a>
                        </div>
                        @if (Auth::check() && auth()->user()->role_name === 'buyer')
                            <div class="favorite-action">
                                @if ($isFavorite != 0)
                                    <form action="{{ route('buyer.favorites.remove', $listing->ListingID) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-heart-broken"></i> Remove from Favorites
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('buyer.favorites.add', $listing->ListingID) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-heart"></i> Add to Favorites
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @endif
                    </div>
                    <!-- OVERVIEW -->
                    <div class="listing-box">
                        <h4>Business Overview</h4>
                        <p>{!! $listing->Comments !!}</p>
                    </div>

                    <!-- DETAILS -->
                    <div class="listing-box">
                        <h4> Business Info</h4>
                        <div class="row">
                            <div class="col-6">Building Size</div>
                            <div class="col-6 text-end">{{ $listing->BldgSize }}</div>

                            <div class="col-6">Parking</div>
                            <div class="col-6 text-end">{{ $listing->Parking ?? 'N/A' }}</div>

                            <div class="col-6">License Required</div>
                            <div class="col-6 text-end">{{ $listing->LicenseReq ?? 'N/A' }}</div>

                            <div class="col-6">Base Month Rent</div>
                            <div class="col-6 text-end">${{ number_format($listing->BaseMonthRent) }}</div>

                            <div class="col-6">House Of Operations</div>
                            <div class="col-6 text-end">{{ $listing->HoursOfOp }}</div>
                        </div>
                    </div>
                    <!-- Pricing Info -->
                    <div class="listing-box">
                        <h4> Pricing Info</h4>
                        <div class="row">
                            <div class="col-6"> Listing Type</div>
                            <div class="col-6 text-end">{{ getListingTypeName($listing->ListType) }}</div>

                            <div class="col-6"> List Price</div>
                            <div class="col-6 text-end">${{ number_format($listing->ListPrice) }}</div>

                            <div class="col-6"> Pur. Price</div>
                            <div class="col-6 text-end">${{ number_format($listing->PurPrice) }}</div>

                            <div class="col-6">Down Pay</div>
                            <div class="col-6 text-end">${{ number_format($listing->DownPay) }}</div>

                        </div>
                    </div>
                    <!-- FINANCIAL -->
                    @auth
                        <div class="listing-box">
                            <h4>Financial Info</h4>
                            <div class="row">
                                <div class="col-6">Annual Sales</div>
                                <div class="col-6 text-end">${{ number_format($listing->AnnualSales) }}</div>

                                <div class="col-6">Gross Profit</div>
                                <div class="col-6 text-end">${{ number_format($listing->GrossProfit) }}</div>

                                <div class="col-6"> Total Expenses</div>
                                <div class="col-6 text-end">${{ number_format($listing->TotalExpenses) }}</div>

                                <div class="col-6">Operating Profit</div>
                                <div class="col-6 text-end">${{ number_format($listing->AnnualNetProfit) }}</div>

                                <div class="col-6">Annual Net Profit</div>
                                <div class="col-6 text-end">${{ number_format($listing->AnnualNetProfit) }}</div>
                            </div>
                        </div>
                    @endauth

                    <div class="inquiry-listing">

                        <h3 class="inquiry-title">Listing Inquiry:</h3>

                        <form id="contactForm" method="POST" action="{{ route('send.inquiry') }}">
                            @csrf

                            <div class="row g-3">

                                <div class="col-md-6">
                                    <input type="text" name="first_name" class="form-control inquiry-input"
                                        placeholder="First Name">
                                    <small class="text-danger error" id="error_first_name"></small>
                                </div>

                                <div class="col-md-6">
                                    <input type="text" name="last_name" class="form-control inquiry-input"
                                        placeholder="Last Name">
                                    <small class="text-danger error" id="error_last_name"></small>
                                </div>

                                <div class="col-12">
                                    <input type="email" name="email" class="form-control inquiry-input"
                                        placeholder="Your Email">
                                    <small class="text-danger error" id="error_email"></small>
                                </div>

                                <div class="col-md-6">
                                    <input type="text" name="phone" class="form-control inquiry-input"
                                        placeholder="Phone">
                                    <small class="text-danger error" id="error_phone"></small>
                                </div>

                                <div class="col-md-6">
                                    <input type="text" name="zipcode" class="form-control inquiry-input"
                                        placeholder="Zipcode">
                                </div>

                                <div class="col-12">
                                    <input type="text" name="budget" class="form-control inquiry-input"
                                        placeholder="Dollar Amount You're Ready To Invest?">
                                </div>

                                <div class="col-12">
                                    <select name="timeframe" class="form-control inquiry-input">
                                        <option value="">Purchase Time Frame?</option>
                                        <option>Immediately</option>
                                        <option>1-3 Months</option>
                                        <option>3-6 Months</option>
                                        <option>6+ Months</option>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <textarea name="message" rows="4" class="form-control inquiry-input" placeholder="Message"></textarea>
                                </div>

                            </div>

                            <div class="mt-4 text-center">
                                <button type="submit" class="btn inquiry-btn">Send Message</button>
                            </div>

                        </form>
                        <div class="show-inquiry-message">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                        </div>

                    </div>

                </div>

                <!-- RIGHT SIDEBAR -->
                <div class="col-lg-4">
                    <div class="sticky-sidebar">

                        @foreach ($listings as $item)
                            @php
                                $cash_flow = $listing->GrossRevenue - $listing->TotalExpenses;
                            @endphp
                            <a href="{{ route('view.business.listing', $item->ListingID) }}" class="card-link">
                                <div class="sidebar-card">
                                    @if (!empty($item->imagepath))
                                        <img src="{{ asset('assets/uploads/images/' . $item->imagepath) }}">
                                    @else
                                        <img src="{{ asset('assets/images/business_image.jpg') }}">
                                    @endif

                                    <div class="sidebar-content">
                                        <h6>{{ $item->CorpName ?? $item->DBA }}</h6>
                                        <p>{{ $item->City }}, {{ $item->State }}</p>

                                        <div class="sidebar-price">
                                            <div>
                                                <small>Asking Price</small>
                                                <strong>${{ number_format($item->REAskingPrice) }}</strong>
                                            </div>

                                            <div>
                                                <small>Cash Flow</small>
                                                <strong>${{ number_format($item->cash_flow) }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach

                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="modal fade" id="shareModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content custom-modal">

                <!-- Header -->
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold">Share Listing with Buyer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Body -->
                <div class="modal-body">

                    <label class="form-label fw-semibold mb-2">
                        Select Buyer
                    </label>

                    <select id="buyerSelect" class="form-control select2"></select>

                    <input type="hidden" id="listing_id" value="{{ $listing->ListingID }}">

                </div>

                <!-- Footer -->
                <div class="modal-footer border-0 d-flex justify-content-between">

                    <button class="btn btn-light px-4" data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button class="btn btn-primary px-4" id="sendShare">
                        <span id="btnText">Send</span>
                        <span id="btnLoader" class="spinner-border spinner-border-sm d-none"></span>
                    </button>

                </div>

            </div>
        </div>
    </div>



    <style>
        .listing-modern {

            padding: 40px 0;
        }

        /* HEADER */
        .listing-header h2 {
            font-size: 26px;
            font-weight: 600;
            color: #333;
        }

        .listing-header p {
            color: #806132;
            font-weight: 500;
        }

        /* IMAGE */
        .listing-image-box {
            position: relative;
            margin: 15px 0px;
        }

        .listing-image-box img {
            width: 100%;
            border-radius: 6px;
        }

        /* OVERLAY */
        .price-overlay {
            position: absolute;
            bottom: 0;
            width: 100%;
            background: rgb(22 28 35 / 64%);
            color: #fff;
            display: flex;
            justify-content: space-between;
            padding: 20px 20px;
        }

        /* LISTING ID */
        .listing-id {
            position: absolute;
            right: 10px;
            bottom: 80px;
            background: #806132;
            color: #fff;
            padding: 5px 10px;
            font-size: 12px;
        }

        /* SHARE */
        .share-bar {
            margin: 10px 0px;
        }

        .share-bar .btn {
            margin-right: 10px;
        }

        .custom-btn-listing {
            border: 1px solid #7F2149;
            color: #7F2149;
            background: transparent;
        }

        .custom-btn-listing:hover {
            background: #7F2149;
            color: #fff;
        }

        /* BOX */
        .listing-box {
            background: #fff;
            padding: 20px;
            margin-top: 20px;
            border-left: 4px solid #806132;
        }

        .listing-box h4 {
            color: #7F2149;
            font-size: 24px;
            line-height: 1em;
            margin: 0px -15px 15px -15px;
            padding: 10px 15px;
            background: rgba(127, 33, 73, 0.08);
        }

        /* SIDEBAR */

        /* CARD */
        .sidebar-card {
            background: #fff;
            margin-bottom: 20px;
            border-radius: 6px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .sidebar-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        /* IMAGE */
        .sidebar-card img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        /* CONTENT */
        .sidebar-content {
            padding: 15px;
        }

        .sidebar-content h6 {
            font-size: 18px;
            font-weight: 600;
        }

        .sidebar-content p {
            font-size: 16px;
            color: #666;
            line-height: 0.8;
            margin: 0;
        }

        /* PRICE */
        .sidebar-price {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .sidebar-price small {
            display: block;
            font-size: 14px;
            font-weight: bold;
        }

        .sidebar-price strong {
            font-size: 14px;
            color: #7F2149;
        }

        .card-link {
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .card-link:hover {
            text-decoration: none;
            color: inherit;
        }


        /* RESPONSIVE */
        @media(max-width:768px) {
            .sticky-sidebar {
                position: static;
            }
        }

        .inquiry-listing {
            background: #fff;
            padding: 20px;
            margin-top: 20px;
        }

        /* Title */
        .inquiry-title {
            color: #7f2149;
            font-weight: 500;
            margin-bottom: 25px;
            font-size: 24px;
        }

        /* Inputs */
        .inquiry-input {
            background: transparent;
            border: 1px solid #2a3b55;
            color: #fff;
            padding: 12px;
            border-radius: 4px;
        }

        .inquiry-input::placeholder {
            color: #aaa;
        }

        .inquiry-input:focus {
            border-color: #806132;
            box-shadow: none;
            background: transparent;
            color: #fff;
        }

        /* Select dropdown */
        select.inquiry-input {
            appearance: none;
        }

        /* Button */
        .inquiry-btn {
            background: #7f2149;
            color: #fff;
            padding: 12px 30px;
            border-radius: 5px;
            font-weight: 600;
            border: none;
            transition: 0.3s;
        }

        .inquiry-btn:hover {
            background: #806132;
            color: #fff;
        }

        /* Responsive */
        @media(max-width:768px) {
            .listing-inquiry-section {
                padding: 40px 15px;
            }
        }


        #shareModal .modal-dialog {
            max-width: 600px;
        }

        #shareModal .modal-content {
            height: 250px;
        }

        @media (min-width: 768px) {
            #shareModal.full-modal .modal-dialog {
                max-width: 90%;
            }

            #shareModal.full-modal .modal-content {
                height: 80vh;
            }
        }

        /* Modal container */
        .custom-modal {
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            padding: 10px;
        }

        /* Header */
        .modal-header {
            border-bottom: none;
        }

        /* Body spacing */
        .modal-body {
            padding: 10px 10px;
        }

        .modal-body .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 8px !important;
        }

        /* Footer */
        .modal-footer {
            border-top: none;
        }

        /* Select2 styling */
        .select2-container .select2-selection--single {
            height: 45px;
            border-radius: 8px;
            padding: 8px;
        }

        /* Button hover */
        .btn-primary {
            transition: 0.3s;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .show-inquiry-message {
            padding-top: 14px;
            text-align: center;
        }

        .single-badge .badge {
            border: 1px solid #7F2149;
            color: #7F2149;
            background: transparent;
        }

        .tags .badge {
            margin-right: 8px;
        }

        /* like and dislike css */
        .like-card {
            border: 1px solid #eee;
            padding: 15px;
            border-radius: 10px;
            background: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin: 15px 0px;
        }

        .like-header {
            font-weight: 600;
            margin-bottom: 10px;
        }

        .like-actions {
            display: flex;
            gap: 10px;
        }

        .like-btn,
        .dislike-btn {
            flex: 1;
            padding: 8px;
            border-radius: 6px;
            border: 1px solid #ddd;
            background: #f9f9f9;
            cursor: pointer;
            transition: 0.3s;
        }

        .like-btn:hover {
            background: #e6f4ea;
            border-color: #7F2149;
        }

        .dislike-btn:hover {
            background: #fdecea;
            border-color: #dc3545;
        }

        .like-btn.active {
            background: #7F2149;
            color: #fff;
        }

        .dislike-btn.active {
            background: #dc3545;
            color: #fff;
        }

        .like-count {
            margin-top: 10px;
            font-size: 14px;
            color: #555;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(function() {

            console.log("jQuery version:", $.fn.jquery);

            if (!$.fn.select2) {
                console.error('❌ Select2 NOT loaded');
                return;
            }

            console.log('✅ Select2 loaded successfully');

            $('#buyerSelect').select2({
                placeholder: 'Search buyer...',
                minimumInputLength: 2,
                width: '100%',
                dropdownParent: $('#shareModal'),
                ajax: {
                    url: "{{ route('buyers.search') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.map(item => ({
                                id: item.BuyerID,
                                text: item.BuyerID + ' ' + item.FName + ' ' + item.LName +
                                    ' (' + item.Email + ')'
                            }))
                        };
                    },
                    cache: true
                }
            });

            $('#sendShare').on('click', function() {

                let buyer_id = $('#buyerSelect').val();
                let listing_id = $('#listing_id').val();

                if (!buyer_id) {
                    Swal.fire('Error', 'Please select buyer', 'warning');
                    return;
                }
                // Show loader
                $('#btnText').text('Sending...');
                $('#btnLoader').removeClass('d-none');
                $('#sendShare').prop('disabled', true);
                $.ajax({
                    url: "{{ route('listing.share') }}",
                    type: "POST",
                    data: {
                        buyer_id: buyer_id,
                        listing_id: listing_id
                    },
                    success: function(res) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Email Sent!',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function() {
                        Swal.fire('Error', 'Error sending email', 'error');
                    }
                });

            });

            document.querySelector("#contactForm").addEventListener("submit", function(e) {

                let isValid = true;

                // Clear all errors
                document.querySelectorAll(".error").forEach(el => el.innerText = '');

                // Get values
                let firstName = document.querySelector('[name="first_name"]');
                let lastName = document.querySelector('[name="last_name"]');
                let email = document.querySelector('[name="email"]');
                let phone = document.querySelector('[name="phone"]');


                // First Name
                if (firstName.value.trim() === '') {
                    document.getElementById('error_first_name').innerText = 'First name is required';
                    isValid = false;
                }
                // Last Name
                if (lastName.value.trim() === '') {
                    document.getElementById('error_last_name').innerText = 'Last name is required';
                    isValid = false;
                }

                // Email
                if (email.value.trim() === '') {
                    document.getElementById('error_email').innerText = 'Email is required';
                    isValid = false;
                } else if (!/^\S+@\S+\.\S+$/.test(email.value)) {
                    document.getElementById('error_email').innerText = 'Enter valid email';
                    isValid = false;
                }

                // Phone
                if (phone.value.trim() === '') {
                    document.getElementById('error_phone').innerText = 'Phone is required';
                    isValid = false;
                } else if (phone.value.length < 8) {
                    document.getElementById('error_phone').innerText = 'Enter valid phone';
                    isValid = false;
                }


                if (!isValid) {
                    e.preventDefault();
                }

            });


            // ✅ Remove error while typing
            document.querySelectorAll("input, textarea").forEach(input => {
                input.addEventListener("input", function() {
                    let errorId = "error_" + this.name;
                    let errorElement = document.getElementById(errorId);

                    if (errorElement) {
                        errorElement.innerText = '';
                    }
                });
            });

        });
    </script>
    <script>
        $(document).on('click', '.like-btn, .dislike-btn', function() {

            let parent = $(this).closest('.like-card');
            let listingId = parent.data('listing-id');

            // determine value (same as old system)
            let likedVal = $(this).data('type') === 'like' ? 1 : 2;

            $.ajax({
                url: "{{ route('listing.like') }}", // SAME as old working
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    liked: likedVal, // IMPORTANT: keep same param
                    listing_id: listingId
                },
                success: function(response) {

                    if (response.success) {

                        // update count
                        parent.find('#likeCount').text(response.like_count);

                        // remove active state
                        parent.find('.like-btn, .dislike-btn').removeClass('active');

                        // apply active state
                        if (response.liked == 1) {
                            parent.find('.like-btn').addClass('active');
                        } else if (response.liked == 2) {
                            parent.find('.dislike-btn').addClass('active');
                        }

                        // update attribute (important for future clicks)
                        parent.attr('data-liked', response.liked);

                    } else {
                        alert('Something went wrong. Please try again.');
                    }
                },
                error: function() {
                    alert('Something went wrong. Please try again.');
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            var form = $('.buyer-comment');
            form.validate({
                rules: {
                    user_email: {
                        required: true,
                        email: true
                    },
                    user_name: {
                        required: true
                    },
                    user_comment: {
                        required: true
                    }
                },
                messages: {},
                submitHandler: function(form) {
                    form.submit(); // Proceed with form submission if valid
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            let page = 2;
            var listing_id = <?php echo $listing->ListingID; ?>;
            let loading = false;


            $('#loading').on('click', function() {

                if (!loading) {
                    loading = true;
                    $('#loading').text('Loading...');


                    $.ajax({
                        url: "{{ route('load.more.comments') }}",
                        type: 'GET',
                        data: {
                            _token: "{{ csrf_token() }}", // CSRF token
                            listing_id: listing_id,
                            page: page // Send the current page number
                        },
                        success: function(response) {
                            if (response.comments.length > 0) {
                                // Append the new comments to the container
                                response.comments.forEach(function(comment) {
                                    $('#comments-container').append(`
                                <div class="media mb-4 buycomment">
                                    <img src="{{ asset('assets/images/user.png') }}" class="img-fluid rounded-circle mb-3 comment_image" alt="User Avatar">
                                    <div class="media-body">
                                        <h5 class="mt-0">${comment.Name}</h5>
                                        <p>${comment.Comment}</p>
                                        <small>Posted on ${comment.formatted_date}</small>
                                    </div>
                                </div>
                            `);
                                });

                                // Increment the page for the next request
                                page++;
                            }

                            // Hide the loading indicator and reset button text
                            $('#loading').text('Loading more comments...').hide();
                            loading = false;
                        },
                        error: function() {
                            console.log('Error loading comments');
                            loading = false;
                            $('#loading').text('Error, try again').show();
                        }
                    });
                }
            });
        });
    </script>
@endsection
