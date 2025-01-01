@extends('frontend.layout.master')

@section('content')
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
                <p class="text-muted">By <strong>{{ucfirst($userName)}}</strong> | {{ \Carbon\Carbon::parse($listing->created_at)->format('F d, Y') }}</p>
                <!-- <img src="https://via.placeholder.com/1200x600" class="img-fluid mb-4" alt="Post Image"> -->
                @if(!empty($listing->imagepath))
                <img src="{{asset('assets/uploads/images/'. $listing->imagepath)}}" alt="" class="business_listing_image">
                @else
                <img src="{{ asset('assets/images/business_image.jpg') }}" alt="" class="business_listing_image">
                @endif
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam non urna nec neque luctus dapibus. Morbi
                    congue mauris libero, in luctus ex pretium et. Integer efficitur, sapien vel tincidunt tincidunt, risus
                    purus interdum metus, vitae faucibus justo ante id quam. Sed pretium tortor vel orci consectetur, et
                    ullamcorper libero iaculis. Nam bibendum gravida dui, a tempor turpis scelerisque ac. Donec ut quam at
                    nulla aliquet volutpat. Ut venenatis dolor eu justo malesuada, vitae aliquam justo sollicitudin. Donec
                    consectetur, mauris at fermentum feugiat, lectus ipsum condimentum augue, non efficitur odio erat sit amet
                    ligula.</p>

                <p>Phasellus fringilla convallis augue non tristique. Curabitur dictum lectus quis risus hendrerit, in pretium
                    justo placerat. Cras venenatis erat id nulla lacinia, vitae feugiat arcu egestas. Nam vehicula mi non urna
                    feugiat, ut pretium ante placerat. Etiam tristique, eros eu vestibulum faucibus, erat ligula lacinia purus,
                    at cursus odio lorem vel risus.</p>

                <hr>
                <div class="tags">
                    <span class="badge bg-primary">Technology</span>
                    <span class="badge bg-secondary">Web Development</span>
                    <span class="badge bg-success">Bootstrap</span>
                </div>
            </article>

            <!-- Comments Section -->
            <section class="mt-5">
                <h4>3 Comments</h4>

                <div class="media mb-4">
                <img src="{{asset('assets/images/user.png')}}" class="img-fluid rounded-circle mb-3 comment_image" alt="User Avatar">


                    <div class="media-body">
                        <h5 class="mt-0">John Doe</h5>
                        <p>This is a great post! I really learned a lot.</p>
                        <small>Posted on December 31, 2024</small>
                    </div>
                </div>

                <div class="media mb-4">
                <img src="{{asset('assets/images/user.png')}}" class="img-fluid rounded-circle mb-3 comment_image" alt="User Avatar">


                    <div class="media-body">
                        <h5 class="mt-0">Jane Smith</h5>
                        <p>Thanks for sharing this! Can't wait to apply these tips.</p>
                        <small>Posted on December 31, 2024</small>
                    </div>
                </div>

                <div class="media mb-4">
                <img src="{{asset('assets/images/user.png')}}" class="img-fluid rounded-circle mb-3 comment_image" alt="User Avatar">


                    <div class="media-body">
                        <h5 class="mt-0">Tom Brown</h5>
                        <p>I disagree with some points, but overall it's a helpful post!</p>
                        <small>Posted on December 31, 2024</small>
                    </div>
                </div>

                <hr>

                <!-- Comment Form -->
                <h5>Leave a Comment</h5>
                <form>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="comment" class="form-label">Comment</label>
                        <textarea class="form-control" id="comment" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="comment_btn">Comment</button>
                </form>
            </section>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <div class="sticky-top">
                <div class="card mb-4">
                    <div class="card-header">About Author</div>
                    <div class="card-body">
                        <img src="{{asset('assets/images/user.png')}}" class="img-fluid rounded-circle mb-3" alt="Author Image">
                        <h5 class="card-title">{{ucfirst($userName)}}</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ut nisi quam. Morbi
                            ac lacus nec purus lacinia tempor.</p>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">Recent Business listing</div>
                    <ul class="list-group list-group-flush">
                        @foreach($listings as $listing)
                        <li class="list-group-item"><a href="{{route('view.business.listing',$listing->ListingID)}}">{{$listing->SellerCorpName}}</a></li>
                        @endforeach
                    </ul>
                </div>

                <div class="card mb-4">
                    <div class="card-header">Tags</div>
                    <div class="card-body">
                        <span class="badge bg-primary">Technology</span>
                        <span class="badge bg-secondary">Web Development</span>
                        <span class="badge bg-success">Bootstrap</span>
                        <span class="badge bg-danger">Tutorial</span>
                    </div>
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
    </style>
@endsection