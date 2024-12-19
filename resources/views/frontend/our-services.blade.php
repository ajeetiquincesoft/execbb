@extends('frontend.layout.master')

@section('content')
<!-- Breadcrumb Section -->
<div class="breadcrumb-container py-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active"><a href="#">Services</a></li>
            </ol>
        </nav>
    </div>
</div>
<!-- Main Section -->
<section class="main-section our_services" style="background-color: #F8F8F8;">
    <div class="container py-5 container-padding" style="background-color: #FFFFFF; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
        <!-- Heading and Description -->
        <div class="text-center mb-5">
            <h1 class="fw-bold">Our Services</h1>
        </div>
        <hr class="pursuit_hr mb-5">
        <div class="text-center mb-5">
            <h1 class="fw-bold ebb_offer">EBB Offers Buyers/Sellers 1 Stop Shopping</h1>
            <p class="text-muted ser_content">The sale of a business is complicated, which is why we offer in-house services associated with buying/selling a business. This simplifies the process by eliminating the need for you to work with  multiple outside service providers to facilitate the transaction.</p>
            <p class="text-muted ser_content">EBB’s services are available to any buyer or seller. This includes individuals who are interested in a business listed with us, as well as parties who are purchasing elsewhere and are looking for consulting services.</p>
        </div>
        <!-- Content Section -->
        <div class="row our_services_sec px-5">
            <!-- Left Section -->
            <div class="col-lg-6 col-md-6 mb-4">
                <img src="{{ asset('assets/images/services_4.png') }}">
                <h3 class="text-gold fw-bold">Financing</h3>
                <p class="text-muted">
                If you are purchasing an EBB listed business, consider financing it through one of our mortgage affiliates instead of working with a third party.
                </p>
            </div>
            <div class="col-lg-6 col-md-6 mb-4">
                <img src="{{ asset('assets/images/services_5.png') }}">
                <h3 class="text-gold fw-bold">Consulting</h3>
                <p class="text-muted">
                Executive Business Brokers (EBB) offers consulting services for any aspect of buying/selling a business. We work with buyers and sellers to
                </p>
            </div>
            <div class="col-lg-6 col-md-6 mb-4">
                <img src="{{ asset('assets/images/services_6.png') }}">
                <h3 class="text-gold fw-bold">Business Valuations</h3>
                <p class="text-muted">
                Valuing a business is not an exact science. There is no right way to determine price, as there are many methods of doing so. Many factors play into  value
                </p>
            </div>
            <div class="col-lg-6 col-md-6 mb-4">
                <img src="{{ asset('assets/images/services_7.png') }}">
                <h3 class="text-gold fw-bold">Mergers & Acquisitions</h3>
                <p class="text-muted">
                In most cases it is more profitable for a business to grow by acquisition. It is also faster, more economical, less risky and easier to finance.
                </p>
            </div>
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
</style>
@endsection