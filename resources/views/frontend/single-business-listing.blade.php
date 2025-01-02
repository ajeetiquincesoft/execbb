@extends('frontend.layout.master')

@section('content')
<!-- Check if there's an error message in the session -->

<!-- Breadcrumb Section -->
<div class="breadcrumb-container py-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Business Listing</a></li>
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
                <h1 class="mb-4">{{ucfirst($listing->SellerCorpName)}}</h1>
                <p class="text-muted">By {{ucfirst($userName)}} | {{ \Carbon\Carbon::parse($listing->created_at)->format('F d, Y') }}</p>
                <!-- <img src="https://via.placeholder.com/1200x600" class="img-fluid mb-4" alt="Post Image"> -->
                @if(!empty($listing->imagepath))
                <img src="{{asset('assets/uploads/images/'. $listing->imagepath)}}" alt="" class="business_listing_image">
                @else
                <img src="{{ asset('assets/images/business_image.jpg') }}" alt="" class="business_listing_image">
                @endif
                <p>{{$listing->Comments}}</p>

                <hr>
                <div class="tags">
                    <span class="badge bg-primary">Technology</span>
                    <span class="badge bg-secondary">Web Development</span>
                    <span class="badge bg-success">Bootstrap</span>
                </div>
            </article>

            <!-- Comments Section -->
            <section class="mt-5">
                <h4>Comments</h4>
                @forelse($comments as $comment)
                <div class="media mb-4">
                    <img src="{{asset('assets/images/user.png')}}" class="img-fluid rounded-circle mb-3 comment_image" alt="User Avatar">
                    <div class="media-body">
                        <h5 class="mt-0">{{ucfirst($comment->Name)}}</h5>
                        <p>{{$comment->Comment}}</p>
                        <small>Posted on {{ \Carbon\Carbon::parse($comment->CommentDate)->format('F d, Y') }}</small>
                    </div>
                </div>
                @empty
                <p>There is no comments for a listing.</p>
                @endforelse
                <hr>
                @if(auth()->check())
                @if(auth()->user()->role_name === 'buyer')
                <!-- Comment Form -->
                <h5>Leave a Comment</h5>
                <form class="buyer-comment" name="buyer-comment" method="POST" action="{{ route('buyer.comment', $listing->ListingID) }}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="user_name" name="user_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="user_email" name="user_email" required>
                    </div>
                    <div class="mb-3">
                        <label for="comment" class="form-label">Comment</label>
                        <textarea class="form-control" id="user_comment" rows="4" name="user_comment" required></textarea>
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
                        <img src="{{asset('assets/images/user.png')}}" class="img-fluid rounded-circle mb-3" alt="Author Image">
                        <h5 class="card-title">{{ucfirst($userName)}}</h5>
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
                                    <td><img src="{{ url('assets/images/company.svg') }}" alt="" class="icon"> Company</td>
                                    <td class="text-end">{{ $listing->SellerCorpName }}</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('assets/images/phone.png') }}" alt="" class="icon"> Phone</td>
                                    <td class="text-end">{{ $listing->SHomePh }}</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('assets/images/email.png') }}" alt="" class="icon"> Email</td>
                                    <td class="text-end">{{ $listing->Email }}</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('assets/images/fax.png') }}" alt="" class="icon"> Fax</td>
                                    <td class="text-end">{{ $listing->SHomeFax }}</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('assets/images/location.png') }}" alt="" class="icon"> Address</td>
                                    <td class="text-end">{{ $listing->SHomeAdd1 }}</td>
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
                                    <td><img src="{{ url('assets/images/building.png') }}" alt="" class="icon"> Building Size</td>
                                    <td class="text-end">{{ $listing->BldgSize }}</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('assets/images/parking.png') }}" alt="" class="icon"> Parking</td>
                                    <td class="text-end">{{ $listing->Parking }}</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('assets/images/license.png') }}" alt="" class="icon"> License Required</td>
                                    <td class="text-end">{{ $listing->LicenseReq }}</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('assets/images/base_month_rent.png') }}" alt="" class="icon"> Base Month Rent</td>
                                    <td class="text-end">{{ $listing->BaseMonthRent }}</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('assets/images/house_of_operation.png') }}" alt="" class="icon"> House Of Operations</td>
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
                                    <td><img src="{{ url('assets/images/listing_date.png') }}" alt="" class="icon"> Listing Date</td>
                                    <td class="text-end">{{ $listing->ListDate }}</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('assets/images/exp_date.png') }}" alt="" class="icon"> Exp Date</td>
                                    <td class="text-end">{{ $listing->ExpDate }}</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('assets/images/listing_type.png') }}" alt="" class="icon"> Listing Type</td>
                                    <td class="text-end">{{ $listing->ListType }}</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('assets/images/price.png') }}" alt="" class="icon"> List Price</td>
                                    <td class="text-end">{{ $listing->ListPrice }}</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('assets/images/price.png') }}" alt="" class="icon"> Pur. Price</td>
                                    <td class="text-end">{{ $listing->PurPrice }}</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('assets/images/price.png') }}" alt="" class="icon"> Down Pay</td>
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
                                    <td><img src="{{ url('assets/images/annual_sale.png') }}" alt="" class="icon"> Annual Sales</td>
                                    <td class="text-end">{{ $listing->AnnualSales }}</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('assets/images/gross_profit.png') }}" alt="" class="icon"> Gross Profit</td>
                                    <td class="text-end">{{ $listing->GrossProfit }}</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('assets/images/total_expenses.png') }}" alt="" class="icon"> Total Expenses</td>
                                    <td class="text-end">{{ $listing->TotalExpenses }}</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('assets/images/operating_profit.png') }}" alt="" class="icon"> Operating Profit</td>
                                    <td class="text-end">{{ $listing->AnnualNetProfit }}</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('assets/images/annual_net_profit.png') }}" alt="" class="icon">Annual Net Profit</td>
                                    <td class="text-end">{{ $listing->AnnualNetProfit }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">Recent Business listing</div>
                    <ul class="list-group list-group-flush recent_listing">
                        @foreach($listings as $listing)
                        <li class="list-group-item"><a href="{{route('view.business.listing',$listing->ListingID)}}">{{$listing->SellerCorpName}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
<style>
    .breadcrumb-container {
        background-color: #F8F8F8;
    }

    .breadcrumb-item a {
        text-decoration: none;
        color: #333333;
    }

    .breadcrumb-item.active {
        color: #333333;
    }

    .business_listing_image {
        width: 100%;
        padding-bottom: 20px;
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
        font-size: 18px;
        font-weight: bold;
        color: #7F2149;
        font-family: 'Urbanist';
        text-transform: capitalize;
    }
    .listing_sidebar img{
        width: 15px;
        margin-right: 10px;

    }
    .listing_sidebar .text-end{
        font-size: 15px;
    }
    .listing_sidebar td{
        font-size: 15px;
    }
    
</style>
@endsection