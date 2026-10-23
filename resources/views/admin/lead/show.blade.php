@extends('admin.layout.master')

@section('content')
    <style>
        .listing-page {
            --lp-maroon: #790b32;
            --lp-maroon-dark: #5e0826;
            --lp-ink: #17243a;
            --lp-muted: #718096;
            --lp-border: #dfe5ee;
            --lp-bg: #f4f6fa;
            /*  background: var(--lp-bg); */
            padding: 22px 28px 36px;
            color: var(--lp-ink);
            min-height: calc(100vh - 80px)
        }

        .listing-page * {
            box-sizing: border-box
        }

        .listing-page-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 20px;
            margin: 0 auto 24px;
            max-width: 1600px
        }

        .back-link {
            font-size: 13px;
            color: #667b98;
            text-decoration: none;
            display: inline-flex;
            gap: 8px;
            align-items: center;
            margin-bottom: 10px
        }

        .back-link:hover {
            color: var(--lp-maroon)
        }

        .listing-page-header h1 {
            font-size: 25px;
            line-height: 1.25;
            font-weight: 750;
            margin: 0 0 6px;
            color: var(--lp-ink)
        }

        .listing-page-header p {
            font-size: 13px;
            color: var(--lp-muted);
            margin: 0
        }

        .header-dot {
            padding: 0 5px;
            color: #a4adba
        }

        .btn-outline-maroon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border: 1px solid var(--lp-maroon);
            border-radius: 7px;
            padding: 10px 15px;
            background: transparent;
            color: var(--lp-maroon);
            text-decoration: none;
            font-size: 14px;
            line-height: 1.25;
            white-space: nowrap;
            transition: background .2s, color .2s, border-color .2s;
            cursor: pointer
        }

        .btn-outline-maroon:hover {
            background: var(--lp-maroon);
            color: #fff;
            border-color: var(--lp-maroon)
        }

        .btn-small {
            padding: 8px 11px;
            font-size: 12px
        }

        .listing-layout {
            max-width: 1600px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: minmax(0, 2fr) minmax(290px, 1fr);
            gap: 16px;
            align-items: start
        }

        .listing-main-column,
        .listing-side-column {
            display: grid;
            gap: 16px;
            min-width: 0
        }

        .listing-card {
            background: #fff;
            border: 1px solid var(--lp-border);
            border-radius: 13px;
            padding: 24px;
            box-shadow: 0 2px 5px rgba(22, 34, 55, .025);
            min-width: 0
        }

        .listing-card h2 {
            font-size: 17px;
            line-height: 1.35;
            font-weight: 750;
            color: var(--lp-ink);
            margin: 0 0 15px
        }

        .asking-topline {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 15px
        }

        .eyebrow,
        .financial-item span,
        .side-info-item span {
            display: block;
            font-size: 12px;
            color: var(--lp-muted);
            margin-bottom: 5px
        }

        .asking-price {
            font-size: 38px;
            line-height: 1.15;
            font-weight: 800;
            letter-spacing: -.7px;
            color: #101d32
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            border-radius: 6px;
            background: #f8edf1;
            color: var(--lp-maroon);
            font-size: 11px;
            font-weight: 700;
            padding: 4px 9px;
            margin-top: 1px
        }

        .card-rule {
            height: 1px;
            background: #e1e5eb;
            margin: 18px 0
        }

        .asking-card h2 {
            margin-bottom: 7px
        }

        .overview-copy {
            font-size: 13px;
            line-height: 1.7;
            color: #667b98;
            margin: 0
        }

        .document-link {
            display: inline-flex;
            gap: 7px;
            align-items: center;
            margin-top: 14px;
            color: var(--lp-maroon);
            font-size: 13px;
            text-decoration: none
        }

        .document-link:hover {
            text-decoration: underline
        }

        .financial-card h2 {
            margin-bottom: 20px
        }

        .financial-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 18px
        }

        .financial-item {
            min-width: 0
        }

        .financial-item strong {
            font-size: 19px;
            font-weight: 750;
            line-height: 1.35;
            color: #101d32;
            overflow-wrap: anywhere
        }

        .side-card h2 {
            font-size: 16px;
            margin-bottom: 18px
        }

        .side-info-item {
            margin-bottom: 17px
        }

        .side-info-item:last-child {
            margin-bottom: 0
        }

        .side-info-item strong {
            display: block;
            font-size: 13px;
            font-weight: 650;
            color: #152238;
            overflow-wrap: anywhere
        }

        .section-heading-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 4px
        }

        .section-heading-row h2 {
            margin-bottom: 14px
        }

        .details-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 22px 28px
        }

        .detail-group h3 {
            font-size: 14px;
            font-weight: 750;
            padding-bottom: 10px;
            margin: 0 0 3px;
            border-bottom: 1px solid #edf0f4;
            color: #24334a
        }

        .detail-list {
            margin: 0
        }

        .detail-list>div {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 15px;
            padding: 10px 0;
            border-bottom: 1px solid #f0f2f6
        }

        .detail-list>div:last-child {
            border-bottom: 0
        }

        .detail-list dt {
            font-size: 12px;
            font-weight: 500;
            color: var(--lp-muted);
            margin: 0
        }

        .detail-list dd {
            font-size: 12px;
            font-weight: 650;
            color: #1b2940;
            text-align: right;
            margin: 0;
            max-width: 60%;
            overflow-wrap: anywhere
        }

        .image-card form {
            display: flex;
            flex-direction: column;
            align-items: stretch
        }

        .listing-image-preview {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 170px;
            border: 1px dashed #d7deea;
            border-radius: 10px;
            background: #f8f9fc;
            overflow: hidden;
            cursor: pointer;
            margin: 0 0 12px
        }

        .listing-image-preview img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: contain
        }

        .image-card input[type=file] {
            font-size: 12px;
            max-width: 100%;
            margin: 0 0 8px;
            color: #58677c
        }

        .listing-image-error {
            font-size: 12px;
            color: #dc3545;
            margin: 0 0 8px
        }

        .upload-button {
            width: 100%
        }

        .image-help {
            font-size: 11px;
            color: var(--lp-muted);
            margin: 10px 0 0;
            text-align: center
        }

        .workflow-copy {
            font-size: 12px;
            line-height: 1.6;
            color: var(--lp-muted);
            margin: -7px 0 14px
        }

        .workflow-button {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            min-height: 39px;
            padding: 9px 12px;
            margin-top: 8px;
            border: 1px solid var(--lp-maroon);
            border-radius: 7px;
            color: var(--lp-maroon);
            text-decoration: none;
            font-size: 13px;
            background: #fff;
            transition: background .2s, color .2s
        }

        .workflow-button:hover {
            background: var(--lp-maroon);
            color: #fff
        }

        .quick-action {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 12px 0;
            border-top: 1px solid #edf0f4;
            color: #26354b;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600
        }

        .quick-action:first-of-type {
            border-top: 0;
            padding-top: 0
        }

        .quick-action>span {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 31px;
            height: 31px;
            border-radius: 8px;
            background: #f8edf1;
            color: var(--lp-maroon)
        }

        .quick-action>.fa-chevron-right {
            margin-left: auto;
            font-size: 11px;
            color: #9aa5b5
        }

        .quick-action:hover {
            color: var(--lp-maroon)
        }

        @media(max-width:1100px) {
            .listing-layout {
                grid-template-columns: minmax(0, 1.5fr) minmax(260px, 1fr)
            }

            .financial-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                row-gap: 18px
            }
        }

        @media(max-width:767px) {
            .listing-page {
                padding: 16px 12px 26px
            }

            .listing-page-header {
                margin-bottom: 18px
            }

            .listing-page-header h1 {
                font-size: 21px
            }

            .listing-page-header>.btn-outline-maroon {
                padding: 9px 10px;
                font-size: 12px
            }

            .listing-layout {
                grid-template-columns: 1fr
            }

            .listing-main-column {
                order: 1
            }

            .listing-side-column {
                order: 2
            }

            .listing-card {
                padding: 18px
            }

            .asking-price {
                font-size: 32px
            }

            .financial-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr))
            }

            .details-grid {
                grid-template-columns: 1fr;
                gap: 20px
            }

            .section-heading-row {
                align-items: flex-start;
                flex-wrap: wrap
            }
        }

        @media(max-width:420px) {
            .listing-page-header {
                gap: 10px
            }

            .listing-page-header h1 {
                font-size: 19px
            }

            .listing-page-header>.btn-outline-maroon {
                font-size: 11px;
                padding: 8px
            }

            .financial-item strong {
                font-size: 17px
            }
        }
    </style>
    <div class="listing-page container-fluid">

        {{-- Page header --}}
        <div class="listing-page-header">
            <div>
                <a href="{{ route('all.lead') }}" class="back-link">
                    <i class="fa fa-arrow-left"></i> Back to leads
                </a>

                <h1>
                    {{ trim(($lead->SellerFName ?? '') . ' ' . ($lead->SellerLName ?? '')) ?: 'Lead details' }}
                </h1>

                <p>
                    Lead #{{ $lead->LeadID }}
                    <span class="header-dot">·</span>
                    {{ $lead->BusName ?: 'Business name not provided' }}
                </p>
            </div>

            <a href="{{ route('edit.lead', $lead->LeadID) }}" class="btn-outline-maroon">
                <i class="fa fa-pencil"></i> Edit lead
            </a>
        </div>

        {{-- Previous / Next navigation --}}
        <div class="d-flex justify-content-between align-items-center gap-3 mb-4">

            <div>
                @if ($previous)
                    <a href="{{ route('show.lead', $previous->LeadID) }}" class="btn-outline-maroon btn-small">
                        <i class="fa fa-chevron-left"></i>
                        Previous lead
                    </a>
                @endif
            </div>

            <div>
                @if ($next)
                    <a href="{{ route('show.lead', $next->LeadID) }}" class="btn-outline-maroon btn-small">
                        Next lead
                        <i class="fa fa-chevron-right"></i>
                    </a>
                @endif
            </div>

        </div>

        <div class="listing-layout">

            {{-- Main column --}}
            <main class="listing-main-column">

                {{-- Lead overview --}}
                <section class="listing-card asking-card">

                    <div class="asking-topline">
                        <div>
                            <span class="eyebrow">Lead overview</span>

                            <div class="asking-price">
                                {{ $lead->BusName ?: 'Business name not provided' }}
                            </div>
                        </div>

                        <span class="status-pill">
                            Lead #{{ $lead->LeadID }}
                        </span>
                    </div>

                    <div class="card-rule"></div>

                    <h2>Business overview</h2>

                    <p class="overview-copy">
                        @if (!empty($lead->BusName))
                            {{ $lead->BusName }}
                        @else
                            Business name not provided
                        @endif

                        @if (!empty($lead->Address))
                            is located at {{ $lead->Address }}.
                        @endif
                    </p>

                </section>

                {{-- Financial overview --}}
                <section class="listing-card financial-card">

                    <h2>Financial overview</h2>

                    <div class="financial-grid">

                        <div class="financial-item">
                            <span>Annual sales</span>
                            <strong>
                                @if ($lead->AnnSales !== null && $lead->AnnSales !== '')
                                    ${{ number_format((float) $lead->AnnSales, 2) }}
                                @else
                                    —
                                @endif
                            </strong>
                        </div>

                        <div class="financial-item">
                            <span>Real estate asking price</span>
                            <strong>
                                @if ($lead->REAsking !== null && $lead->REAsking !== '')
                                    ${{ number_format((float) $lead->REAsking, 2) }}
                                @else
                                    —
                                @endif
                            </strong>
                        </div>

                        <div class="financial-item">
                            <span>Years in business</span>
                            <strong>{{ $lead->YearsInBus ?: '—' }}</strong>
                        </div>

                        <div class="financial-item">
                            <span>Facility size</span>
                            <strong>{{ $lead->SizeOfFacility ?: '—' }}</strong>
                        </div>

                    </div>
                </section>

                {{-- General information --}}
                <section class="listing-card details-card">

                    <h2>General information</h2>

                    <div class="details-grid">

                        {{-- Contact details --}}
                        <div class="detail-group">
                            <h2>Contact information</h2>

                            <dl class="detail-list">

                                <div>
                                    <dt>First name</dt>
                                    <dd>{{ $lead->SellerFName ?: '—' }}</dd>
                                </div>

                                <div>
                                    <dt>Last name</dt>
                                    <dd>{{ $lead->SellerLName ?: '—' }}</dd>
                                </div>

                                <div>
                                    <dt>Phone</dt>
                                    <dd>{{ $lead->Phone ?: '—' }}</dd>
                                </div>

                                <div>
                                    <dt>Address</dt>
                                    <dd>{{ $lead->Address ?: '—' }}</dd>
                                </div>

                                <div>
                                    <dt>Business name</dt>
                                    <dd>{{ $lead->BusName ?: '—' }}</dd>
                                </div>

                            </dl>
                        </div>

                        {{-- Business details --}}
                        <div class="detail-group">
                            <h2>Business information</h2>

                            <dl class="detail-list">

                                <div>
                                    <dt>Category</dt>
                                    <dd>{{ $lead->category_name ?? '—' }}</dd>
                                </div>

                                <div>
                                    <dt>Present owner</dt>
                                    <dd>{{ $lead->PresentOwner ?: '—' }}</dd>
                                </div>

                                <div>
                                    <dt>Years in business</dt>
                                    <dd>{{ $lead->YearsInBus ?: '—' }}</dd>
                                </div>

                                <div>
                                    <dt>Facility size</dt>
                                    <dd>{{ $lead->SizeOfFacility ?: '—' }}</dd>
                                </div>

                                <div>
                                    <dt>FSBO</dt>
                                    <dd>{{ $lead->FSBO ?: '—' }}</dd>
                                </div>

                            </dl>
                        </div>

                    </div>
                </section>

                {{-- Advertisement details --}}
                <section class="listing-card details-card">

                    <h2>Advertisement details</h2>

                    <div class="details-grid">

                        <div class="detail-group">
                            <dl class="detail-list">

                                <div>
                                    <dt>Advertisement date</dt>
                                    <dd>
                                        @if (!empty($lead->AdDate))
                                            {{ \Carbon\Carbon::parse($lead->AdDate)->format('m/d/Y') }}
                                        @else
                                            —
                                        @endif
                                    </dd>
                                </div>

                                <div>
                                    <dt>Advertisement source</dt>
                                    <dd>{{ $lead->Source ?? '—' }}</dd>
                                </div>

                            </dl>
                        </div>

                        <div class="detail-group">
                            <dl class="detail-list">

                                <div>
                                    <dt>Advertisement copy</dt>
                                    <dd>{{ $lead->AdCopy ?: '—' }}</dd>
                                </div>

                            </dl>
                        </div>

                    </div>
                </section>

            </main>

            {{-- Sidebar --}}
            <aside class="listing-side-column">

                {{-- Lead information --}}
                <section class="listing-card">

                    <h2>Lead information</h2>

                    <div class="side-info-item">
                        <span>Lead ID</span>
                        <strong>{{ $lead->LeadID }}</strong>
                    </div>

                    <div class="side-info-item">
                        <span>Assigned agent</span>
                        <strong>
                            {{ trim(($lead->agent_fname ?? '') . ' ' . ($lead->agent_lname ?? '')) ?: 'Unassigned' }}
                        </strong>
                    </div>

                    <div class="side-info-item">
                        <span>Category</span>
                        <strong>{{ $lead->category_name ?? '—' }}</strong>
                    </div>

                    <div class="side-info-item">
                        <span>Business name</span>
                        <strong>{{ $lead->BusName ?: '—' }}</strong>
                    </div>

                </section>

                {{-- Appointment information --}}
                <section class="listing-card">

                    <h2>Appointment information</h2>

                    <div class="side-info-item">
                        <span>Appointment date</span>
                        <strong>
                            @if (!empty($lead->AppointmentDate))
                                {{ \Carbon\Carbon::parse($lead->AppointmentDate)->format('m/d/Y') }}
                            @else
                                —
                            @endif
                        </strong>
                    </div>

                    <div class="side-info-item">
                        <span>Appointment time</span>
                        <strong>{{ $lead->AppointmentTime ?? '—' }}</strong>
                    </div>

                    <div class="side-info-item">
                        <span>Present owner</span>
                        <strong>{{ $lead->PresentOwner ?: '—' }}</strong>
                    </div>

                </section>

                {{-- Quick actions --}}
                <section class="listing-card">

                    <h2>Quick actions</h2>

                    <a href="{{ route('edit.lead', $lead->LeadID) }}" class="quick-action">
                        <span>
                            <i class="fa fa-pencil"></i>
                        </span>
                        Edit lead
                        <i class="fa fa-chevron-right"></i>
                    </a>

                    <a href="{{ route('all.lead') }}" class="quick-action">
                        <span>
                            <i class="fa fa-list"></i>
                        </span>
                        All leads
                        <i class="fa fa-chevron-right"></i>
                    </a>

                </section>

            </aside>

        </div>
    </div>
@endsection
