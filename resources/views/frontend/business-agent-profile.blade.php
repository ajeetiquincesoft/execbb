@extends('frontend.layout.master')

@section('content')
    <!-- Breadcrumb Section -->
    <div class="breadcrumb-container py-3">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('all.brokers') }}">Business Agent</a></li>
                    <li class="breadcrumb-item active"><a href="#">Profile View</a></li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Main Section -->
    <section class="main-section our_services">
        <div class="container py-5 container-padding"
            style="background-color: #FFFFFF; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
            <!-- Heading and Description -->
            <div class="text-center mb-5">
                <h1 class="fw-bold">Profile View</h1>
            </div>
            <hr class="pursuit_hr mb-5">

            <div class="row mb-5">
                <div class="col-md-4">
                    <div class="ag_img">
                        <!-- <img src="{{ asset('assets/images/howard_goldberg_01.png') }}" alt="agent_image" class="agent_profile_image" /> -->
                        @if (!empty($agent->image))
                            <img src="{{ asset('assets/uploads/images/' . $agent->image) }}"
                                alt="{{ $agent->FName }} {{ $agent->LName }}" class="agent_profile_image">
                        @else
                            <img src="{{ asset('assets/images/avatar.png') }}" alt="{{ $agent->FName }} {{ $agent->LName }}"
                                class="agent_profile_image">
                        @endif
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="profile_content">
                        <h3>{{ ucfirst($agent->FName) }} {{ ucfirst($agent->LName) }}</h3>
                        <p>{!! $agent->Comments !!}</p>
                    </div>
                    <div class="content_information">
                        <h3>Contact Information</h3>
                        <hr class="pursuit_hr mb-2">
                        <div class="con_img d-inline-block">
                            <img src="{{ asset('assets/images/contact_img.png') }}" alt="agent_image" class="info_image" />
                            <span>Office: {{ $agent->Telephone }}, ext. {{ $agent->Extension }}</span>
                        </div>
                        <div class="ph_img d-inline-block">
                            <img src="{{ asset('assets/images/message_img.png') }}" alt="agent_image" class="info_image" />
                            <span>{{ $agent->Email }}</span>
                        </div>
                        <hr class="pursuit_hr mb-2">
                    </div>
                </div>
            </div>
            <hr class="pursuit_hr mb-5">
            <!-- Content Section -->
            <h3 class="fw-bold ebb_offer">More Agents</h3>
            <div class="card-container">
                @foreach ($agents as $more_agent)
                    @php
                        $text = strip_tags($more_agent->Comments);
                        $words = explode(' ', $text);
                        $limitedComment = implode(' ', array_slice($words, 0, 11));

                        if (count($words) > 11) {
                            $limitedComment .= '...';
                        }
                    @endphp
                    <div class="card">
                        <div class="agent-info">
                            @php
                                $imagePath = public_path('assets/uploads/images/' . $more_agent->image);
                            @endphp
                            @if (!empty($more_agent->image) && file_exists($imagePath))
                                <img src="{{ asset('assets/uploads/images/' . $more_agent->image) }}"
                                    alt="{{ $more_agent->FName }} {{ $more_agent->LName }}" class="agent-image">
                            @else
                                <img src="{{ asset('assets/images/avatar.png') }}"
                                    alt="{{ $more_agent->FName }} {{ $more_agent->LName }}" class="agent-image">
                            @endif
                            <div class="leading_agent">
                                <h5 class="mb-1">{{ ucfirst($more_agent->FName) }} {{ ucfirst($more_agent->LName) }}
                                </h5>
                                <p class="mb-0">{!! $limitedComment !!}</p>
                            </div>
                        </div>
                        <div class="contact_agent">
                            <div class="agent_btn">
                                <a href="{{ route('view.broker.profile', $more_agent->AgentUserRegisterId) }}">Contact
                                    Agent</a>
                            </div>

                        </div>
                    </div>
                @endforeach
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

        .our_services_sec h3 {
            padding: 20px 0;
            font-size: 25px;
        }

        .our_services h1 {
            font-size: 25px;
        }

        .fw-bold.ebb_offer {
            margin-bottom: 20px;
            font-family: 'Gilroy';
            text-align: center;
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

        img.agent_profile_image {
            height: 100%;
            width: 100%;
        }

        .con_img.d-inline-block {
            margin-right: 30px;
        }

        .content_information h3 {
            color: #806132;
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 25px;
            font-family: 'Mulish';
        }

        img.info_image {
            height: 30px;
            width: 30px;
            margin-right: 10px;
        }

        .profile_content h3 {
            font-family: 'Gilroy';
        }

        .con_img span {
            font-family: 'Mulish';
            font-size: 15px;
            color: #333333;
            font-weight: 600;
        }

        .ph_img span {
            font-family: 'Mulish';
            font-size: 15px;
            color: #333333;
            font-weight: 600;
        }

        .profile_content p {
            font-family: 'Mulish';
            color: #5D5D5D;
            margin-top: 20px;
        }
    </style>
@endsection
