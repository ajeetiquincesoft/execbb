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
    <div class="container mt-5">
        <div class="row">
            <!-- Main Post Content -->
            <div class="col-lg-8">
                <article>
                    <h1 class="mb-4">{{ ucwords($listing->SellerCorpName) }}</h1>
                    <p class="text-muted">By {{ ucfirst($userName) }} |
                        {{ \Carbon\Carbon::parse($listing->created_at)->format('F d, Y') }}</p>
                    <!-- <img src="https://via.placeholder.com/1200x600" class="img-fluid mb-4" alt="Post Image"> -->
                    @if (!empty($listing->imagepath))
                        <img src="{{ asset('assets/uploads/images/' . $listing->imagepath) }}" alt=""
                            class="business_listing_image">
                    @else
                        <img src="{{ asset('assets/images/business_image.jpg') }}" alt=""
                            class="business_listing_image">
                    @endif
                    <p>{!! $listing->Comments !!}</p>
                    @if (auth()->check())
                        @if (auth()->user()->role_name === 'buyer')
                            <div class="icon-container" data-listing-id="{{ $listing->ListingID }}"
                                data-liked="{{ $likeVal ?? 0 }}">
                                <i class="fa fa-thumbs-o-up icon-text thumbs-up {{ $activeClass }}" aria-hidden="true"></i>
                                <span class="text {{ $activeClass }}">Like</span>
                                <p class="total_likes">Total Likes: <span>{{ $likeCount }}</span></p>

                            </div>
                        @endif
                    @endif
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="tags single-badge">
                            <span class="badge">{{ $listing->BusType }}</span>
                            <span class="badge">{{ $subCatName }}</span>
                        </div>
                        @if (Auth::check())
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
                    <hr>
                </article>

                <!-- Comments Section -->
                <section class="mt-5">
                    <h4>Comments</h4>
                    <div id="comments-container">
                        @foreach ($buyerComments as $comment)
                            <div class="media mb-4 buycomment">
                                <img src="{{ asset('assets/images/user.png') }}"
                                    class="img-fluid rounded-circle mb-3 comment_image" alt="User Avatar">
                                <div class="media-body">
                                    <h5 class="mt-0">{{ ucfirst($comment->Name) }}</h5>
                                    <p>{{ $comment->Comment }}</p>
                                    <small>Posted on
                                        {{ \Carbon\Carbon::parse($comment->CommentDate)->format('F d, Y') }}</small>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if ($buyerCommentsCount > 5)
                        <div id="loading">Loading more comments...</div>
                    @endif
                    <hr>
                    @if (auth()->check())
                        @if (auth()->user()->role_name === 'buyer')
                            <!-- Comment Form -->
                            <h5>Leave a Comment</h5>
                            <form class="buyer-comment" name="buyer-comment" method="POST"
                                action="{{ route('buyer.comment', $listing->ListingID) }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="user_name" name="user_name">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="user_email" name="user_email">
                                </div>
                                <div class="mb-3">
                                    <label for="comment" class="form-label">Comment</label>
                                    <textarea class="form-control" id="user_comment" rows="4" name="user_comment"></textarea>
                                </div>
                                <button type="submit" class="comment_btn">Comment</button>
                            </form>
                        @else
                            <p>You must be logged in as a buyer to post a comment.</p>
                        @endif
                    @else
                        <p>You must be logged in to post a comment.</p>
                    @endif


                </section>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="sticky-top1">
                    <!--   <div class="card mb-4">
                            <div class="card-header">About Author</div>
                            <div class="card-body">
                                <img src="{{ asset('assets/images/user.png') }}" class="img-fluid rounded-circle mb-3" alt="Author Image">
                                <h5 class="card-title">{{ ucfirst($userName) }}</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ut nisi quam. Morbi
                                    ac lacus nec purus lacinia tempor.</p>
                            </div>
                        </div> -->
                    <div class="card mb-4">
                        <div class="card-header">
                            General Info
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <tbody class="listing_sidebar">
                                    <tr>
                                        <td><img src="{{ url('assets/images/company.svg') }}" alt=""
                                                class="icon"> Company</td>
                                        <td class="text-end">{{ $listing->SellerCorpName }}</td>
                                    </tr>
                                    <tr>
                                        <td><img src="{{ url('assets/images/phone.png') }}" alt=""
                                                class="icon"> Phone</td>
                                        <td class="text-end">{{ $listing->Phone }}</td>
                                    </tr>
                                    <tr>
                                        <td><img src="{{ url('assets/images/email.png') }}" alt=""
                                                class="icon"> Email</td>
                                        <td class="text-end">{{ $listing->Email }}</td>
                                    </tr>
                                    <tr>
                                        <td><img src="{{ url('assets/images/fax.png') }}" alt="" class="icon">
                                            Fax</td>
                                        <td class="text-end">{{ $listing->Fax }}</td>
                                    </tr>
                                    <tr>
                                        <td><img src="{{ url('assets/images/location.png') }}" alt=""
                                                class="icon"> Address</td>
                                        <td class="text-end">{{ $listing->Address1 }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Business Info -->
                    <div class="card mb-4">
                        <div class="card-header">
                            Business Info
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <tbody class="listing_sidebar">
                                    <tr>
                                        <td><img src="{{ url('assets/images/building.png') }}" alt=""
                                                class="icon"> Building Size</td>
                                        <td class="text-end">{{ $listing->BldgSize }}</td>
                                    </tr>
                                    <tr>
                                        <td><img src="{{ url('assets/images/parking.png') }}" alt=""
                                                class="icon"> Parking</td>
                                        <td class="text-end">{{ $listing->Parking }}</td>
                                    </tr>
                                    <tr>
                                        <td><img src="{{ url('assets/images/license.png') }}" alt=""
                                                class="icon"> License Required</td>
                                        <td class="text-end">{{ $listing->LicenseReq }}</td>
                                    </tr>
                                    <tr>
                                        <td><img src="{{ url('assets/images/base_month_rent.png') }}" alt=""
                                                class="icon"> Base Month Rent</td>
                                        <td class="text-end">{{ $listing->BaseMonthRent }}</td>
                                    </tr>
                                    <tr>
                                        <td><img src="{{ url('assets/images/house_of_operation.png') }}" alt=""
                                                class="icon"> House Of Operations</td>
                                        <td class="text-end">{{ $listing->HoursOfOp }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Pricing Info -->
                    <div class="card mb-4">
                        <div class="card-header">
                            Pricing Info
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <tbody class="listing_sidebar">
                                    <tr>
                                        <td><img src="{{ url('assets/images/listing_date.png') }}" alt=""
                                                class="icon"> Listing Date</td>
                                        <td class="text-end">{{ $listing->ListDate }}</td>
                                    </tr>
                                    <tr>
                                        <td><img src="{{ url('assets/images/exp_date.png') }}" alt=""
                                                class="icon"> Exp Date</td>
                                        <td class="text-end">{{ $listing->ExpDate }}</td>
                                    </tr>
                                    <tr>
                                        <td><img src="{{ url('assets/images/listing_type.png') }}" alt=""
                                                class="icon"> Listing Type</td>
                                        <td class="text-end">{{ $listing->ListType }}</td>
                                    </tr>
                                    <tr>
                                        <td><img src="{{ url('assets/images/price.png') }}" alt=""
                                                class="icon"> List Price</td>
                                        <td class="text-end">{{ $listing->ListPrice }}</td>
                                    </tr>
                                    <tr>
                                        <td><img src="{{ url('assets/images/price.png') }}" alt=""
                                                class="icon"> Pur. Price</td>
                                        <td class="text-end">{{ $listing->PurPrice }}</td>
                                    </tr>
                                    <tr>
                                        <td><img src="{{ url('assets/images/price.png') }}" alt=""
                                                class="icon"> Down Pay</td>
                                        <td class="text-end">{{ $listing->DownPay }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Financial Info -->
                    <div class="card mb-4">
                        <div class="card-header">
                            Financial Info
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <tbody class="listing_sidebar">
                                    <tr>
                                        <td><img src="{{ url('assets/images/annual_sale.png') }}" alt=""
                                                class="icon"> Annual Sales</td>
                                        <td class="text-end">{{ $listing->AnnualSales }}</td>
                                    </tr>
                                    <tr>
                                        <td><img src="{{ url('assets/images/gross_profit.png') }}" alt=""
                                                class="icon"> Gross Profit</td>
                                        <td class="text-end">{{ $listing->GrossProfit }}</td>
                                    </tr>
                                    <tr>
                                        <td><img src="{{ url('assets/images/total_expenses.png') }}" alt=""
                                                class="icon"> Total Expenses</td>
                                        <td class="text-end">{{ $listing->TotalExpenses }}</td>
                                    </tr>
                                    <tr>
                                        <td><img src="{{ url('assets/images/operating_profit.png') }}" alt=""
                                                class="icon"> Operating Profit</td>
                                        <td class="text-end">{{ $listing->AnnualNetProfit }}</td>
                                    </tr>
                                    <tr>
                                        <td><img src="{{ url('assets/images/annual_net_profit.png') }}" alt=""
                                                class="icon">Annual Net Profit</td>
                                        <td class="text-end">{{ $listing->AnnualNetProfit }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">Recent Business listing</div>
                        <ul class="list-group list-group-flush recent_listing">
                            @foreach ($listings as $businessListing)
                                <li class="list-group-item"><a
                                        href="{{ route('view.business.listing', $businessListing->ListingID) }}">{{ $businessListing->SellerCorpName }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <style>
        .business_listing_image {
            width: 100%;
            padding-bottom: 20px;
            height: auto;
            max-height: 500px;
            object-fit: cover;
            display: block;
        }

        img.img-fluid.rounded-circle.mb-3.comment_image {
            width: 45px;
        }

        .comment_btn {
            background-color: #7F2149;
            font-size: 16px;
            line-height: 24px;
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 0px;
        }

        .sticky-top1 {
            padding-top: 112px;
        }

        ul.list-group.list-group-flush.recent_listing li a {
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
            color: #7F2149;
            font-family: 'Urbanist';
            text-transform: capitalize;
            text-decoration-line: underline;
        }

        .listing_sidebar img {
            width: 15px;
            margin-right: 10px;

        }

        .listing_sidebar .text-end {
            font-size: 15px;
        }

        .listing_sidebar td {
            font-size: 15px;
        }

        .card-header {
            background-color: #806132;
            color: #ffffff;
            border-radius: 0 !important;
        }

        .card.mb-4 {
            border-radius: 0;
        }

        .single-badge .badge {
            background-color: #D9D9D9;
            padding: 14px;
            color: #333333;
            border-radius: 1px;
            font-size: 15px;
        }

        /* Styling for each icon and text */

        .icon-container {
            cursor: pointer;
            margin-bottom: 10px;
        }

        .icon-text {
            margin-right: 5px;
            font-size: 16px;
        }

        .text {
            font-size: 16px;
            font-weight: bold;
        }

        .icon-text,
        .text {
            color: #333333;
        }

        .active {
            color: #4169E1;

        }

        .total_likes {
            float: right;
            font-size: 16px;
            font-weight: bold;
            width: 14%;
            display: block;
            margin: 0;
        }

        .total_likes span {
            color: #4169E1;
        }

        .buycomment {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        #loading {
            display: inline-block;
            cursor: pointer;
            padding: 10px 20px;
            background-color: #7F2149;
            color: white;
            border: none;
            border-radius: 5px;
            text-align: center;
            font-size: 16px;
        }

        #loading:hover {
            background-color: #806132;
        }

        .favorite-action button {
            padding: 8px 20px;
            font-size: 14px;
            border-radius: 5px;
        }

        .favorite-action i {
            margin-right: 8px;
        }

        .tags .badge {
            margin-right: 8px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.icon-container').click(function() {
                var listing_id = $(this).attr('data-listing-id');
                var like_val = $(this).attr('data-liked');
                $(this).find('.icon-text, .text').toggleClass('active');
                $.ajax({
                    url: "{{ route('listing.like') }}", // Make sure to update the route
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}", // CSRF token
                        liked: like_val,
                        listing_id: listing_id
                    },
                    success: function(response) {
                        if (response.success) {
                            $('.icon-container').attr('data-liked', response.liked);
                            $('.total_likes span').text(response.like_count);
                        } else {
                            alert('Something went wrong. Please try again.');
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Something went wrong. Please try again.');
                    }
                });
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
            let page = 2; // Start from page 2 since page 1 is already loaded
            var listing_id = <?php echo $listing->ListingID; ?>;
            let loading = false;

            // Listen for the "Loading more comments" button click
            $('#loading').on('click', function() {
                // Check if the AJAX request is already in progress
                if (!loading) {
                    loading = true; // Set loading flag to true
                    $('#loading').text('Loading...'); // Change button text to "Loading..."

                    // Load more comments via AJAX
                    $.ajax({
                        url: "{{ route('load.more.comments') }}", // Endpoint for loading more comments
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
