@extends('agent-dashboard.layout.master')

@section('content')
    <div class="container-fluid content bg-light agent-dashboard">

        {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}
        <div class="dashboard-header">

            <div>

                <h1>Electronic Broker Information System</h1>

                <p class="sub-heading">
                    Agent Dashboard
                </p>

            </div>


            <div class="dashboard-date">

                <div class="date-icon">
                    <i class="fa fa-calendar"></i>
                </div>

                <div>
                    <span>Dashboard Overview</span>
                    <strong>{{ now()->format('F d, Y') }}</strong>
                </div>

            </div>

        </div>


        {{-- =========================================================
        DASHBOARD OVERVIEW
    ========================================================== --}}
        <div class="dashboard-section">

            <div class="section-heading">

                <div>
                    <h2>Overview</h2>

                    <p>
                        Your current business activity
                    </p>
                </div>

            </div>


            <div class="row dashboard-cards">


                {{-- =================================================
                TOTAL LISTINGS
            ================================================= --}}
                <div class="col-sm-6 col-lg-6 col-xl-3">

                    <a href="{{ route('agent.all.listing') }}" class="dashboard-card-link">

                        <div class="dashboard-card">

                            <div class="card-content">

                                <span class="card-label">
                                    Total Listings
                                </span>

                                <h3>
                                    {{ number_format($listingsCount) }}
                                </h3>

                                <span class="card-description">
                                    Your listings
                                </span>

                            </div>


                            <div class="card-icon listing-icon">

                                <img src="{{ url('assets/images/Active-Listings.svg') }}" alt="Listings">

                            </div>

                        </div>

                    </a>

                </div>


                {{-- =================================================
                TOTAL BUYERS
            ================================================= --}}
                <div class="col-sm-6 col-lg-6 col-xl-3">

                    <a href="{{ route('agent.list.buyer') }}" class="dashboard-card-link">

                        <div class="dashboard-card">

                            <div class="card-content">

                                <span class="card-label">
                                    Total Buyers
                                </span>

                                <h3>
                                    {{ number_format($buyersCount) }}
                                </h3>

                                <span class="card-description">
                                    Your buyers
                                </span>

                            </div>


                            <div class="card-icon buyer-icon">

                                <img src="{{ url('assets/images/Total-Buyers.svg') }}" alt="Buyers">

                            </div>

                        </div>

                    </a>

                </div>


                {{-- =================================================
                TOTAL LEADS
            ================================================= --}}
                <div class="col-sm-6 col-lg-6 col-xl-3">

                    <a href="{{ route('agent.all.leads') }}" class="dashboard-card-link">

                        <div class="dashboard-card">

                            <div class="card-content">

                                <span class="card-label">
                                    Total Leads
                                </span>

                                <h3>
                                    {{ number_format($leadsCount) }}
                                </h3>

                                <span class="card-description">
                                    Your leads
                                </span>

                            </div>


                            <div class="card-icon lead-icon">

                                <img src="{{ url('assets/images/Total-Leads.svg') }}" alt="Leads">

                            </div>

                        </div>

                    </a>

                </div>


                {{-- =================================================
                BUYERS VISIT LISTING
            ================================================= --}}
                <div class="col-sm-6 col-lg-6 col-xl-3">

                    <a href="{{ route('agent.buyer.listing.visit') }}" class="dashboard-card-link">

                        <div class="dashboard-card">

                            <div class="card-content">

                                <span class="card-label">
                                    Buyers Visit Listing
                                </span>

                                <h3>
                                    {{ number_format($buyerViewListingCount) }}
                                </h3>

                                <span class="card-description">
                                    Unique buyer visits
                                </span>

                            </div>


                            <div class="card-icon visit-icon">

                                <img src="{{ url('assets/images/Total-Buyers.svg') }}" alt="Buyer Visits">

                            </div>

                        </div>

                    </a>

                </div>

            </div>

        </div>


        {{-- =========================================================
        INFORMATION PANEL
    ========================================================== --}}
        <div class="dashboard-information">

            <div class="information-icon">
                <i class="fa fa-info-circle"></i>
            </div>

            <div>

                <h4>Dashboard Overview</h4>

                <p>
                    Use the dashboard cards above to quickly access your
                    listings, buyers, leads and buyer listing visits.
                </p>

            </div>

        </div>

    </div>


    {{-- =============================================================
    AGENT DASHBOARD STYLES
============================================================= --}}
    <style>
        /* =========================================================
                           MAIN DASHBOARD
                        ========================================================== */

        .agent-dashboard {
            min-height: calc(100vh - 100px);

            padding: 28px 30px 45px;

            background: #f7f8fa !important;
        }


        /* =========================================================
                           HEADER
                        ========================================================== */

        .dashboard-header {

            display: flex;

            align-items: flex-end;

            justify-content: space-between;

            gap: 25px;

            margin-bottom: 28px;
        }





        .dashboard-header h1 {

            margin: 0;

            color: #20242a;

            font-size: 27px;

            font-weight: 600;

            line-height: 1.3;
        }


        .dashboard-header .sub-heading {

            margin: 5px 0 0;

            color: #858c95;

            font-size: 14px;

            font-weight: 400;
        }


        /* =========================================================
                           DATE BOX
                        ========================================================== */

        .dashboard-date {

            display: flex;

            align-items: center;

            gap: 11px;

            padding: 10px 14px;

            background: #ffffff;

            border: 1px solid #e4e7eb;

            border-radius: 8px;

            box-shadow: 0 2px 8px rgba(0, 0, 0, .025);
        }


        .date-icon {

            width: 36px;

            height: 36px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 7px;

            background: #f8eef2;

            color: #7e183f;

            font-size: 15px;
        }


        .dashboard-date span {

            display: block;

            color: #8a9199;

            font-size: 10px;

            font-weight: 500;

            text-transform: uppercase;

            letter-spacing: .4px;
        }


        .dashboard-date strong {

            display: block;

            margin-top: 2px;

            color: #30353b;

            font-size: 13px;

            font-weight: 600;
        }


        /* =========================================================
                           SECTION
                        ========================================================== */

        .dashboard-section {

            margin-bottom: 24px;
        }


        .section-heading {

            display: flex;

            align-items: center;

            justify-content: space-between;

            margin-bottom: 14px;
        }


        .section-heading h2 {

            margin: 0;

            color: #252a31;

            font-size: 17px;

            font-weight: 600;
        }


        .section-heading p {

            margin: 3px 0 0;

            color: #9298a0;

            font-size: 12px;
        }


        /* =========================================================
                           CARD GRID
                        ========================================================== */

        .dashboard-cards {

            margin-left: -7px;

            margin-right: -7px;
        }


        .dashboard-cards>div {

            padding-left: 7px;

            padding-right: 7px;

            margin-bottom: 14px;
        }


        /* =========================================================
                           CARD LINK
                        ========================================================== */

        .dashboard-card-link {

            display: block;

            color: inherit;

            text-decoration: none;
        }


        /* =========================================================
                           DASHBOARD CARD
                        ========================================================== */

        .dashboard-card {

            position: relative;

            min-height: 142px;

            display: flex;

            align-items: center;

            justify-content: space-between;

            padding: 20px 18px;

            background: #ffffff;

            border: 1px solid #e4e7eb;

            border-radius: 9px;

            overflow: hidden;

            transition:
                transform .2s ease,
                box-shadow .2s ease,
                border-color .2s ease;
        }


        .dashboard-card::before {

            content: "";

            position: absolute;

            left: 0;

            top: 0;

            bottom: 0;

            width: 3px;

            background: #7e183f;

            opacity: 0;

            transition: opacity .2s ease;
        }


        .dashboard-card-link:hover .dashboard-card {

            transform: translateY(-3px);

            border-color: #dedfe3;

            box-shadow: 0 8px 22px rgba(26, 31, 36, .07);
        }


        .dashboard-card-link:hover .dashboard-card::before {

            opacity: 1;
        }


        /* =========================================================
                           CARD CONTENT
                        ========================================================== */

        .card-content {

            min-width: 0;
        }


        .card-label {

            display: block;

            margin-bottom: 9px;

            color: #737b84;

            font-size: 12px;

            font-weight: 500;
        }


        .card-content h3 {

            margin: 0;

            color: #343a41;

            font-size: 28px;

            font-weight: 600;

            line-height: 1.1;
        }


        .card-description {

            display: block;

            margin-top: 9px;

            color: #a0a6ad;

            font-size: 10px;
        }


        /* =========================================================
                           CARD ICON
                        ========================================================== */

        .card-icon {

            width: 53px;

            height: 53px;

            display: flex;

            align-items: center;

            justify-content: center;

            flex: 0 0 53px;

            margin-left: 12px;

            border-radius: 50%;

            background: #faf5f7;
        }


        .card-icon img {

            width: 29px;

            height: 29px;

            object-fit: contain;
        }


        .listing-icon,
        .buyer-icon,
        .lead-icon,
        .visit-icon {

            background: #faf3f5;
        }


        /* =========================================================
                           INFORMATION PANEL
                        ========================================================== */

        .dashboard-information {

            display: flex;

            align-items: center;

            gap: 13px;

            padding: 16px 18px;

            background: #ffffff;

            border: 1px solid #e4e7eb;

            border-radius: 9px;
        }


        .information-icon {

            width: 38px;

            height: 38px;

            display: flex;

            align-items: center;

            justify-content: center;

            flex: 0 0 38px;

            border-radius: 7px;

            background: #f8eef2;

            color: #7e183f;

            font-size: 16px;
        }


        .dashboard-information h4 {

            margin: 0 0 3px;

            color: #343a41;

            font-size: 13px;

            font-weight: 600;
        }


        .dashboard-information p {

            margin: 0;

            color: #8a9199;

            font-size: 11px;

            line-height: 1.5;
        }


        /* =========================================================
                           RESPONSIVE
                        ========================================================== */

        @media (max-width: 1199px) {

            .agent-dashboard {

                padding-left: 20px;

                padding-right: 20px;
            }


            .dashboard-header h1 {

                font-size: 24px;
            }

        }


        @media (max-width: 767px) {

            .agent-dashboard {

                padding: 20px 15px 35px;
            }


            .dashboard-header {

                display: block;

                margin-bottom: 22px;
            }


            .dashboard-date {

                display: inline-flex;

                margin-top: 15px;
            }


            .dashboard-header h1 {

                font-size: 22px;
            }


            .dashboard-card {

                min-height: 125px;

                padding: 17px 15px;
            }


            .card-content h3 {

                font-size: 25px;
            }


            .card-icon {

                width: 47px;

                height: 47px;

                flex-basis: 47px;
            }


            .card-icon img {

                width: 25px;

                height: 25px;
            }

        }


        @media (max-width: 575px) {

            .dashboard-header h1 {

                font-size: 20px;
            }


            .dashboard-header .sub-heading {

                font-size: 13px;
            }


            .dashboard-card {

                min-height: 115px;
            }


            .card-label {

                font-size: 11px;
            }


            .card-content h3 {

                font-size: 23px;
            }


            .dashboard-information {

                align-items: flex-start;
            }

        }
    </style>
@endsection
