@extends('frontend.layout.master')

@section('content')
<!-- Breadcrumb Section -->
<div class="breadcrumb-container py-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Business Agent</a></li>
                <li class="breadcrumb-item active"><a href="#">Profile View</a></li>
            </ol>
        </nav>
    </div>
</div>
<!-- Main Section -->
<section class="main-section our_services" style="background-color: #F8F8F8;">
    <div class="container py-5 container-padding" style="background-color: #FFFFFF; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
        <!-- Heading and Description -->
        <div class="text-center mb-5">
            <h1 class="fw-bold">Profile View</h1>
        </div>
        <hr class="pursuit_hr mb-5">

        <div class="row mb-5">
            <div class="col-md-4">
                <div class="ag_img">
                    <!-- <img src="{{ asset('assets/images/howard_goldberg_01.png') }}" alt="agent_image" class="agent_profile_image" /> -->
                    @if(!empty($agent->image))
                    <img src="{{asset('assets/uploads/images/'. $agent->image)}}" alt="{{$agent->FName}} {{$agent->LName}}" class="agent_profile_image">
                    @else
                    <img src="{{asset('assets/images/avatar.png')}}" alt="{{$agent->FName}} {{$agent->LName}}" class="agent_profile_image">
                    @endif
                </div>
            </div>
            <div class="col-md-8">
                <div class="profile_content">
                    <h3>{{$agent->FName}} {{$agent->LName}}</h3>
                    <p>{!! $agent->Comments !!}</p>
                </div>
                <div class="content_information">
                    <h3>Contact Information</h3>
                    <hr class="pursuit_hr mb-2">
                    <div class="con_img d-inline-block">
                        <img src="{{ asset('assets/images/contact_img.png') }}" alt="agent_image" class="info_image" />
                        <span>Office: {{$agent->Telephone}}, ext. {{$agent->Extension}}</span>
                    </div>
                    <div class="ph_img d-inline-block">
                        <img src="{{ asset('assets/images/message_img.png') }}" alt="agent_image" class="info_image" />
                        <span>{{$agent->Email}}</span>
                    </div>
                    <hr class="pursuit_hr mb-2">
                </div>
            </div>
        </div>
        <hr class="pursuit_hr mb-5">
        <!-- Content Section -->
        <h3 class="fw-bold ebb_offer">More Agents</h3>
        <div class="row row-cols-1 row-cols-md-3 g-4 my-3">
            <!-- Agent Card 1 -->
            @foreach($agents as $more_agent)
            @php
                $text = strip_tags($more_agent->Comments);
                $words = explode(' ',$text);
                $limitedComment = implode(' ', array_slice($words, 0, 15));

                if(count($words) > 15) {
                    $limitedComment .= '...';
                }
            @endphp
            <div class="col">
                <div class="agent-info d-flex">
                @if(!empty($more_agent->image))
                    <img src="{{asset('assets/uploads/images/'. $more_agent->image)}}" alt="{{$more_agent->FName}} {{$more_agent->LName}}" class="agent-image">
                    @else
                    <img src="{{asset('assets/images/avatar.png')}}" alt="{{$more_agent->FName}} {{$more_agent->LName}}" class="agent-image">
                    @endif
                    <div class="leading_agent">
                        <h5 class="mb-1">{{$more_agent->FName}} {{$more_agent->LName}}</h5>
                        <p class="mb-0">{{$limitedComment}}</p>
                    </div>
                </div>
                <div class="contact_agent">
                    <a href="{{route('view.broker.profile', $more_agent->AgentUserRegisterId)}}" class="agent_btn">Contact Agent</a>
                </div>
            </div>
            @endforeach
        </div>




    </div>
</section>
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
    }

    .agent-info {
        padding: 15px;
        height: 120px;
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
        border-radius: 0px;
        object-fit: cover;
        margin-right: 15px;
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