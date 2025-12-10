@extends('frontend.layout.master')

@section('content')
    <!-- Breadcrumb Section -->
    <div class="breadcrumb-container py-3">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="#">Business Agent</a></li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Main Section -->
    <section class="main-section our_services">
        <div class="container py-5 container-padding"
            style="background-color: #fff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
            <!-- Heading and Description -->
            <div class="text-center mb-5">
                <h1 class="fw-bold">Agent Profile</h1>
            </div>
            <hr class="pursuit_hr">
            <form action="{{ route('all.brokers') }}" method="get" class="">
                {{-- <div class="row agent_search mb-5">
                    <div class="col-12 col-sm-8 col-md-10">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Find Agent" name="query"
                                value="{{ request('query') }}" required="">
                        </div>
                    </div>
                    <div class="col-12 col-sm-2 col-md-2 d-md-flex align-items-end brksearch">
                        <button type="submit" name="brk_search">Search</button>
                    </div>
                </div> --}}
                <div class="input-group mb-3 shadow-sm rounded-pill overflow-hidden">
                    <input type="text" class="form-control border-0 py-3 px-4" aria-label="Search term"
                        placeholder="Find Agent ...." name="query" value="{{ request('query') }}" required="">
                    <button class="btn btn-primary px-4 search-btn" type="submit" name="brk_search">
                        <i class="bi bi-search animated-icon"></i>
                    </button>
                </div>
            </form>

            <div class="text-center mb-5">
                <h1 class="fw-bold ebb_offer">EBB's Strength is Our Brokers</h1>
                <p class="text-muted ser_content">Our team of professionals was recruited for their knowledge and qualified
                    service orientation. The passion of our people is critical to our success. Together we share a common
                    set of values that are rooted in integrity, professionalism and excellence.</p>
            </div>

            <!-- Content Section -->




            <div class="card-container">
                @foreach ($agents as $agent)
                    @php
                        $text = strip_tags($agent->Comments);
                        $words = explode(' ', $text);
                        $limitedComment = implode(' ', array_slice($words, 0, 11));

                        if (count($words) > 11) {
                            $limitedComment .= '...';
                        }
                    @endphp
                    <div class="card">
                        <div class="agent-info">
                            @php
                                $imagePath = public_path('assets/uploads/images/' . $agent->image);
                            @endphp
                            @if (!empty($agent->image) && file_exists($imagePath))
                                <img src="{{ asset('assets/uploads/images/' . $agent->image) }}"
                                    alt="{{ $agent->FName }} {{ $agent->LName }}" class="agent-image">
                            @else
                                <img src="{{ asset('assets/images/avatar.png') }}"
                                    alt="{{ $agent->FName }} {{ $agent->LName }}" class="agent-image">
                            @endif
                            <div class="leading_agent">
                                <h5 class="mb-1">{{ ucfirst($agent->FName) }} {{ ucfirst($agent->LName) }}</h5>
                                <p class="mb-0">{!! $limitedComment !!}</p>
                            </div>
                        </div>
                        <div class="contact_agent">
                            <div class="agent_btn">
                                <a href="{{ route('view.broker.profile', $agent->AgentUserRegisterId) }}">Contact Agent</a>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
            <div id="pagination" class="d-flex justify-content-end pagination-wrapper">
                {{ $agents->appends(request()->query())->links('vendor.pagination.custom') }}
            </div>



        </div>
    </section>
    <style>
        .card-container {
            align-items: start;
            display: grid;
            grid-gap: 16px;
            grid-template-columns: repeat(auto-fit, 385px);
            justify-content: center;
        }

        .card {
            border: 1px solid #ccc;
            padding: 24px 0 16px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.12);
            transition: all .3s ease;
        }

        .card:hover {
            transform: scale(1.02);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
        }

        .pagination-wrapper {
            display: flex;
            justify-content: flex-end;
            /* desktop right */
            width: 100%;
        }

        @media (max-width: 768px) {
            .pagination-wrapper {
                justify-content: center;
                /* mobile center */
            }
        }

        /* Tablet adjustments */
        @media (max-width: 992px) {
            .card-container {
                grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
                padding: 0px 10px;
            }

        }

        /* Mobile adjustments */
        @media (max-width: 576px) {
            .card-container {
                grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            }
        }
    </style>
    <style>
        .text-gold {
            color: #333333;
        }

        .fw-bold {
            font-weight: 700;
        }

        .text-muted {
            color: #7F8C8D;
        }

        .icon {
            font-size: 1.2em;
        }

        .list-unstyled li {
            margin-bottom: 10px;
        }

        .img-fluid {
            max-width: 100%;
            height: 289px;
            ;
            border-radius: 8px;
        }

        .breadcrumb {
            background: transparent;
        }

        /* Only change icon color to purple, leave text color unaffected */
        .icon-purple {
            color: #800080;
            /* Purple color for the icon */
        }

        .our_services_sec h3 {
            padding: 20px 0;
            font-size: 25px;
        }

        .our_services h1 {
            font-size: 25px;
        }

        h1.fw-bold.ebb_offer {
            margin-bottom: 20px;
        }

        p.text-muted.ser_content {
            margin: 0;
            line-height: 25px;
        }

        .agent-info {
            padding: 15px 28px;
            height: 110px;
        }

        .contact_agent {
            text-align: center;
        }

        .agent_btn {
            border: 1px solid #806132;
            padding: 10px 0px;
            font-size: 18px;
            font-weight: bold;
            width: 50%;
            margin: 0 auto;
            border-radius: 30px;

        }

        .agent_btn a {
            color: #806132;
            text-decoration: none;
        }

        .agent-info .agent-image {
            object-fit: cover;
            margin-right: 15px;
            width: 80px;
            height: 80px;
            display: block;
            float: left;
        }

        a.see_all_agent {
            border: 1px solid #7F2149;
            background-color: #7F2149;
            color: #ffffff;
            padding: 10px 30px;
            text-decoration: none;
            font-size: 16px;
            font-weight: 500;
        }

        .see_agent {
            margin-top: 100px;
            text-align: center;
        }

        .agent_search button {
            background-color: #7F2149;
            font-size: 16px;
            line-height: 24px;
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 0px;
        }

        .agent_search input.form-control {
            width: 100%;
            display: inline-block;
            height: 45px;
            border: 1px solid #B3B3B3;
        }

        @media screen and (min-width: 575px) and (max-width: 768px) {
            .agent_search input.form-control {
                width: 100% !important;
                margin-bottom: 0px;
            }

            .row.agent_search.mb-5 {
                justify-content: center;
            }
        }
    </style>
@endsection
