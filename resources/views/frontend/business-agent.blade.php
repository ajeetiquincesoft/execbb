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
    <section class="main-section our_services" style="background-color: #F8F8F8;">
        <div class="container py-5 container-padding"
            style="background-color: #FFFFFF; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
            <!-- Heading and Description -->
            <div class="text-center mb-5">
                <h1 class="fw-bold">Agent Profile</h1>
            </div>
            <hr class="pursuit_hr mb-5">
            <form action="{{ route('all.brokers') }}" method="get" class="">
                <div class="row agent_search mb-5">
                    <div class="col-12 col-sm-8 col-md-10">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Find Agent" name="query"
                                value="{{ request('query') }}" required="">
                        </div>
                    </div>
                    <div class="col-12 col-sm-2 col-md-2 d-md-flex align-items-end brksearch">
                        <button type="submit" name="brk_search">Search</button>
                    </div>
                </div>
            </form>

            <div class="text-center mb-5">
                <h1 class="fw-bold ebb_offer">EBB's Strength is Our Brokers</h1>
                <p class="text-muted ser_content">Our team of professionals was recruited for their knowledge and qualified
                    service orientation. The passion of our people is critical to our success. Together we share a common
                    set of values that are rooted in integrity, professionalism and excellence.</p>
            </div>

            <!-- Content Section -->
            <div class="row row-cols-1 row-cols-md-3 g-4 my-3">
                <!-- Agent Card 1 -->
                @foreach ($agents as $agent)
                    @php
                        $text = strip_tags($agent->Comments);
                        $words = explode(' ', $text);
                        $limitedComment = implode(' ', array_slice($words, 0, 11));

                        if (count($words) > 11) {
                            $limitedComment .= '...';
                        }
                    @endphp
                    <div class="col">
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
                            <a href="{{ route('view.broker.profile', $agent->AgentUserRegisterId) }}"
                                class="agent_btn">Contact Agent</a>
                        </div>
                    </div>
                @endforeach

            </div>

            <div id="pagination" class="d-flex justify-content-end">
                {{ $agents->appends(request()->query())->links('vendor.pagination.custom') }}
            </div>



        </div>
    </section>
    <style>
        .text-gold {
            color: #333333;
        }

        .fw-bold {
            font-weight: 700;
        }

        .main-section {
            background-color: #fff;
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
            padding: 15px;
            height: 110px;
        }

        .contact_agent {
            text-align: center;
            margin-top: 15px;
        }

        a.agent_btn {
            border: 1px solid #806132;
            color: #806132;
            padding: 10px 80px;
            text-decoration: none;
            font-size: 20px;
            font-weight: bold;
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
