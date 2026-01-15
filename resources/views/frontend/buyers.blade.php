@extends('frontend.layout.master')

@section('content')
    <!-- Breadcrumb Section -->
    <div class="breadcrumb-container py-3">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    @foreach ($breadcrumbs as $breadcrumb)
                        <li class="breadcrumb-item">
                            <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['title'] }}</a>
                        </li>
                    @endforeach
                    <!--  <li class="breadcrumb-item"><a href="#">Home</a></li>
                                                <li class="breadcrumb-item"><a href="#">Buy a Business</a></li>
                                                <li class="breadcrumb-item active" aria-current="page">Buyers</li> -->
                </ol>
            </nav>
        </div>
    </div>
    <!-- Main Section -->
    <section class="main-section" style="background-color: #F8F8F8;">
        <div class="container remove-mobile-padding">
            <div class="content-box-ebb">
                <!-- Heading and Description -->
                <div class="text-center mb-5">
                    <h1 class="fw-bold">In Pursuit of the Right Business</h1>
                    <p class="text-muted">
                        Finding the right business for you may take more time than you expect. We offer several tools to
                        expedite your search.
                        If you are a first-time buyer, make sure you are prepared and understand what buying a business
                        entails.
                    </p>
                </div>
                <hr class="pursuit_hr mb-5">
                <!-- Content Section -->
                <div class="row">
                    <!-- Left Section -->
                    <div class="col-lg-6 col-md-12 mb-4">
                        <img src="{{ asset('assets/images/shutterstock.png') }}" alt="Magnifying Glass"
                            class="img-fluid rounded">
                    </div>
                    <!-- Right Section -->
                    <div class="col-lg-6 col-md-12">
                        <h2 class="text-gold fw-bold">Start Your Search Now</h2>
                        <p class="text-muted">
                            If you are already aware of the <a href="{{ route('busbuyphase') }}"
                                class="text-gold">process</a>, you can start your search by:
                        </p>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-check-circle-fill icon-purple"></i><a
                                    href="{{ route('register.with.ebb') }}" class="text-gold"> Registering with EBB</a></li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill icon-purple"></i> Looking through our <a
                                    href="{{ route('business.listings') }}" class="text-gold">business listings</a></li>
                            {{-- <li class="mb-2"><i class="bi bi-check-circle-fill icon-purple"></i> Joining the <a
                                    href="{{ route('preferred.buyers.program') }}" class="text-gold">EBB Preferred Buyer
                                    Program</a> For Serious Buyers Only!</li> --}}
                            <li><i class="bi bi-check-circle-fill icon-purple"></i> Ask EBB’s <a
                                    href="{{ route('mergers.and.acquisitions') }}" class="text-gold">M&A Experts</a> for
                                help</li>
                        </ul>
                    </div>
                </div>
                <!-- Bottom Section -->
                <div class="row mt-5 align-items-center">
                    <div class="col-lg-6 col-md-12">
                        <h3 class="fw-bold">Familiarize Yourself with the Buying Process</h3>
                        <p class="text-muted">
                            A large portion of your success will depend largely on how you select a business. There are many
                            important
                            <a href="{{ route('considerations') }}" class="text-gold">factors to consider</a>. Some of the
                            more critical ones include:
                        </p>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-check-circle-fill icon-purple"></i> Knowing why you want to
                                own a business</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill icon-purple"></i> Identifying the type of
                                business</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill icon-purple"></i> Distinguishing the type
                                of business organization</li>
                            <li><i class="bi bi-check-circle-fill icon-purple"></i> Determining whether you want an
                                established business, a franchise, or a start-up</li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <img src="{{ asset('assets/images/shutterstock2.png') }}" alt="Key Handover"
                            class="img-fluid rounded">
                    </div>
                </div>
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

        .content-box-ebb {
            background-color: #FFFFFF;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
    </style>
@endsection
