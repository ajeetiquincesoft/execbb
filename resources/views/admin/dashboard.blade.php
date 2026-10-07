@extends('admin.layout.master')

@section('content')
    <div class="container-fluid content bg-light ebb-dashboard">

        {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}
        <div class="dashboard-header">

            <div>
                <h1>Electronic Broker Information System</h1>

                <p class="sub-heading">
                    Administration Dashboard
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
        STATISTICS
    ========================================================== --}}
        <div class="dashboard-section">

            <div class="section-heading">
                <div>
                    <h2>Overview</h2>
                    <p>Key business statistics</p>
                </div>
            </div>


            <div class="row dashboard-cards">


                {{-- =================================================
                TOTAL LISTINGS
            ================================================= --}}
                <div class="col-sm-6 col-lg-4 col-xl-3">

                    <a href="{{ route('all.listing') }}" class="dashboard-card-link">

                        <div class="dashboard-card">

                            <div class="card-content">

                                <span class="card-label">
                                    Total Listings
                                </span>

                                <h3>
                                    {{ number_format($listings) }}
                                </h3>

                                <span class="card-description">
                                    Listings
                                </span>

                            </div>

                            <div class="card-icon listing-icon">
                                <img src="{{ url('assets/images/Active-Listings.svg') }}" alt="Listings">
                            </div>

                        </div>

                    </a>

                </div>


                {{-- =================================================
                TOTAL AGENTS
            ================================================= --}}
                <div class="col-sm-6 col-lg-4 col-xl-3">

                    <a href="{{ route('list.agent') }}" class="dashboard-card-link">

                        <div class="dashboard-card">

                            <div class="card-content">

                                <span class="card-label">
                                    Total Agents
                                </span>

                                <h3>
                                    {{ number_format($agents) }}
                                </h3>

                                <span class="card-description">
                                    Agents
                                </span>

                            </div>

                            <div class="card-icon agent-icon">
                                <img src="{{ url('assets/images/Total-Agents.svg') }}" alt="Agents">
                            </div>

                        </div>

                    </a>

                </div>


                {{-- =================================================
                TOTAL BUYERS
            ================================================= --}}
                <div class="col-sm-6 col-lg-4 col-xl-3">

                    <a href="{{ route('list.buyer') }}" class="dashboard-card-link">

                        <div class="dashboard-card">

                            <div class="card-content">

                                <span class="card-label">
                                    Total Buyers
                                </span>

                                <h3>
                                    {{ number_format($buyers) }}
                                </h3>

                                <span class="card-description">
                                    Buyers
                                </span>

                            </div>

                            <div class="card-icon buyer-icon">
                                <img src="{{ url('assets/images/Total-Buyers.svg') }}" alt="Buyers">
                            </div>

                        </div>

                    </a>

                </div>


                {{-- =================================================
                SHOWINGS
            ================================================= --}}
                <div class="col-sm-6 col-lg-4 col-xl-3">

                    <a href="{{ route('all.showing') }}" class="dashboard-card-link">

                        <div class="dashboard-card">

                            <div class="card-content">

                                <span class="card-label">
                                    Showings
                                </span>

                                <h3>
                                    {{ number_format($showings) }}
                                </h3>

                                <span class="card-description">
                                    Property showings
                                </span>

                            </div>

                            <div class="card-icon showing-icon">
                                <img src="{{ url('assets/images/Showings.svg') }}" alt="Showings">
                            </div>

                        </div>

                    </a>

                </div>


                {{-- =================================================
                OFFERS
            ================================================= --}}
                <div class="col-sm-6 col-lg-4 col-xl-3">

                    <a href="{{ route('all.offer') }}" class="dashboard-card-link">

                        <div class="dashboard-card">

                            <div class="card-content">

                                <span class="card-label">
                                    Offers
                                </span>

                                <h3>
                                    {{ number_format($offers) }}
                                </h3>

                                <span class="card-description">
                                    Active offers
                                </span>

                            </div>

                            <div class="card-icon offer-icon">
                                <img src="{{ url('assets/images/Offers.svg') }}" alt="Offers">
                            </div>

                        </div>

                    </a>

                </div>


                {{-- =================================================
                TOTAL LEADS
            ================================================= --}}
                <div class="col-sm-6 col-lg-4 col-xl-3">

                    <a href="{{ route('all.lead') }}" class="dashboard-card-link">

                        <div class="dashboard-card">

                            <div class="card-content">

                                <span class="card-label">
                                    Total Leads
                                </span>

                                <h3>
                                    {{ number_format($leads) }}
                                </h3>

                                <span class="card-description">
                                    Business leads
                                </span>

                            </div>

                            <div class="card-icon lead-icon">
                                <img src="{{ url('assets/images/Total-Leads.svg') }}" alt="Leads">
                            </div>

                        </div>

                    </a>

                </div>


                {{-- =================================================
                CLOSINGS
            ================================================= --}}
                <div class="col-sm-6 col-lg-4 col-xl-3">

                    <div class="dashboard-card">

                        <div class="card-content">

                            <span class="card-label">
                                Closings
                            </span>

                            <h3>
                                {{ number_format($closeListings) }}
                            </h3>

                            <span class="card-description">
                                Closed transactions
                            </span>

                        </div>

                        <div class="card-icon closing-icon">
                            <img src="{{ url('assets/images/Closings.svg') }}" alt="Closings">
                        </div>

                    </div>

                </div>


                {{-- =================================================
                ASSIGNED
            ================================================= --}}
                <div class="col-sm-6 col-lg-4 col-xl-3">

                    <div class="dashboard-card">

                        <div class="card-content">

                            <span class="card-label">
                                Assigned
                            </span>

                            <h3>
                                {{ number_format($assignListings) }}
                            </h3>

                            <span class="card-description">
                                Assigned listings
                            </span>

                        </div>

                        <div class="card-icon assigned-icon">
                            <img src="{{ url('assets/images/Assigned.svg') }}" alt="Assigned">
                        </div>

                    </div>

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
                    Use the dashboard cards above to quickly access listings,
                    agents, buyers, showings, offers and leads.
                </p>
            </div>

        </div>

    </div>


    {{-- =============================================================
    DASHBOARD STYLES
============================================================= --}}
    <style>
        /* =========================================================
               DASHBOARD
            ========================================================== */

        .ebb-dashboard {
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
               SECTION HEADING
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
               CARD
            ========================================================== */

        .dashboard-card-link {
            display: block;

            color: inherit;
            text-decoration: none;
        }

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

        .dashboard-card-link:hover .dashboard-card,
        .dashboard-card:hover {
            transform: translateY(-3px);

            border-color: #dedfe3;

            box-shadow: 0 8px 22px rgba(26, 31, 36, .07);
        }

        .dashboard-card-link:hover .dashboard-card::before,
        .dashboard-card:hover::before {
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

        .listing-icon {
            background: #faf3f5;
        }

        .agent-icon {
            background: #f8f2f5;
        }

        .buyer-icon {
            background: #f9f3f5;
        }

        .showing-icon {
            background: #faf4f6;
        }

        .offer-icon {
            background: #f9f2f4;
        }

        .lead-icon {
            background: #faf4f6;
        }

        .closing-icon {
            background: #f9f3f5;
        }

        .assigned-icon {
            background: #faf4f6;
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

            .ebb-dashboard {
                padding-left: 20px;
                padding-right: 20px;
            }

            .dashboard-header h1 {
                font-size: 24px;
            }

        }


        @media (max-width: 767px) {

            .ebb-dashboard {
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
