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

        .avatar_img_upload {
            display: none !important;
        }
    </style>
    {{--  <div class="container-fluid content bg-light">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-5 mb-5 mb-xl-0">
                <div class="card">
                    <div class="card-body">
                        <div class="profile-info">
                            <div class="text-end">
                                <a href="{{ route('edit.listing.form', $listing->ListingID) }}"><i
                                        class="fa fa-edit edit-icon"></i></a>
                            </div>
                            <div class="text-center">
                                <form action="{{ route('upload.listing.avatar', $listing->ListingID) }}" method="POST"
                                    enctype="multipart/form-data" id="listing_show_form">
                                    @csrf
                                    @method('PUT')
                                    <div class="avatar-upload">
                                        <input type="file" id="avatar" name="avatar" accept="image/*"
                                            onchange="previewImage(event)">
                                        <label for="avatar" class="circular-image">
                                            @if ($listing->imagepath)
                                                <img id="avatar-preview"
                                                    src="{{ asset('assets/uploads/images/' . $listing->imagepath) }}"
                                                    alt="Avatar Preview" class="avatar">
                                            @else
                                                <img id="avatar-preview" src="{{ asset('assets/images/avatar.png') }}"
                                                    alt="Avatar Preview" class="avatar">
                                            @endif
                                        </label>
                                    </div>
                                    <div id="listingImgError" style="color:#dc3545;"></div>
                                    <button class="avatar_img_upload" type="button"
                                        onclick="confirmImage(this.form)">Confirm Image</button>
                                </form>
                                <h5>{{ $listing->DBA }}</h5>
                                <h6>Listing ID: {{ $listing->ListingID }}</h6>
                            </div>
                            <div class="table-responsive">
                                <div
                                    style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                    <h6 style="margin: 0;">General Info</h6>
                                    <a href="{{ route('listing.admin.factsheet.preview', $listing->ListingID) }}"
                                        class="btn btn-sm btn-primary" target="_blank">
                                        Listing Factsheet
                                    </a>
                                </div>
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td><img src="{{ url('assets/images/company.svg') }}" alt=""><span
                                                    class="ml-2 fw-600">Company</span></td>
                                            <td class="text-end">{{ $listing->DBA }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/accountant.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Listing Agent</span></td>
                                            <td class="text-end">
                                                {{ trim(($listing->AgentFName ?? '') . ' ' . ($listing->AgentLName ?? '')) ?: 'N/A' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/phone.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Phone</span></td>
                                            <td class="text-end">{{ $listing->Phone }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/email.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Email</span></td>
                                            <td class="text-end">{{ $listing->Email }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/fax.png') }}" alt=""><span
                                                    class="ml-2 fw-600">fax</span></td>
                                            <td class="text-end">{{ $listing->Fax }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/location.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Address</span></td>
                                            <td class="text-end">{{ $listing->Address1 }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div>
                                    <h6>Business</h6>
                                </div>
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td><img src="{{ url('assets/images/building.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Building Size</span></td>
                                            <td class="text-end">{{ $listing->BldgSize }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/parking.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Parking</span></td>
                                            <td class="text-end">{{ $listing->Parking }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/license.png') }}" alt=""><span
                                                    class="ml-2 fw-600">License Required</span></td>
                                            <td class="text-end">{{ $listing->LicenseReq }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/base_month_rent.png') }}"
                                                    alt=""><span class="ml-2 fw-600">Base Month Rent</span></td>
                                            <td class="text-end">${{ number_format($listing->BaseMonthRent) }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/house_of_operation.png') }}"
                                                    alt=""><span class="ml-2 fw-600">House Of Operations</span></td>
                                            <td class="text-end">{{ $listing->HoursOfOp }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div>
                                    <h6>Pricing</h6>
                                </div>
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td><img src="{{ url('assets/images/listing_date.png') }}"
                                                    alt=""><span class="ml-2 fw-600">Listing Date</span></td>
                                            <td class="text-end">
                                                {{ \Carbon\Carbon::parse($listing->ListDate)->format('m/d/Y') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/exp_date.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Exp Date</span></td>
                                            <td class="text-end">
                                                {{ \Carbon\Carbon::parse($listing->ExpDate)->format('m/d/Y') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/listing_type.png') }}"
                                                    alt=""><span class="ml-2 fw-600">Listing Type</span></td>
                                            <td class="text-end">{{ getListingTypeName($listing->ListType) }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/price.png') }}" alt=""><span
                                                    class="ml-2 fw-600">List Price</span></td>
                                            <td class="text-end">${{ number_format($listing->ListPrice) }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/price.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Pur. Price</span></td>
                                            <td class="text-end">${{ number_format($listing->PurPrice) }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/price.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Down Pay</span></td>
                                            <td class="text-end">${{ number_format($listing->DownPay) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div>
                                    <h6>Financial</h6>
                                </div>
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td><img src="{{ url('assets/images/annual_sale.png') }}"
                                                    alt=""><span class="ml-2 fw-600">Annual Sales</span></td>
                                            <td class="text-end">${{ number_format($listing->AnnualSales) }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/gross_profit.png') }}"
                                                    alt=""><span class="ml-2 fw-600">Gross Profit</span></td>
                                            <td class="text-end">${{ number_format($listing->GrossProfit) }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/total_expenses.png') }}"
                                                    alt=""><span class="ml-2 fw-600">Total Expenses</span></td>
                                            <td class="text-end">${{ number_format($listing->TotalExpenses) }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/operating_profit.png') }}"
                                                    alt=""><span class="ml-2 fw-600">Operating Profit</span></td>
                                            <td class="text-end">${{ number_format($listing->AnnualNetProfit) }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/annual_net_profit.png') }}"
                                                    alt=""><span class="ml-2 fw-600">Annual Net Profit</span></td>
                                            <td class="text-end">${{ number_format($listing->AnnualNetProfit) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            @if (!empty($listing->document_path))
                                <p class="mt-2">
                                    Listing Document File:
                                    <a href="{{ asset('storage/' . $listing->document_path) }}" target="_blank">View
                                        Document</a>
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-12 col-xl-7">
                <div class="card">
                    <div class="card-header">
                        <h5>Activities</h5>
                    </div>
                    <div class="card-body scrollable-activity">
                        @foreach ($activities as $activity)
                            <div class="activity mt-2">
                                @php
                                    $user = App\Models\User::find($activity->user_id);
                                @endphp
                                <div class="activity-title fw-bold">{{ $activity->action }} by {{ ucfirst($user->name) }}
                                </div>
                                <div class="activity-time"><small
                                        class="profile-time">{{ $activity->created_at->format('H:i') }}
                                        @if ($activity->created_at->isYesterday())
                                            Yesterday
                                        @else
                                            {{ $activity->created_at->diffForHumans() }}
                                        @endif
                                    </small></div>
                                <div class="activity-content ">
                                    {{ ucfirst($user->name) }} {{ $activity->details }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div id="pagination" class="d-flex justify-content-end">
                        {{ $activities->appends(request()->query())->links('vendor.pagination.custom') }}
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="listing-page container-fluid">
        <div class="listing-page-header">
            <div>
                <a href="{{ url()->previous() }}" class="back-link"><i class="fa fa-arrow-left"></i> Back to listings</a>
                <h1>{{ $listing->DBA ?: 'Business listing' }}</h1>
                <p>Listing #{{ $listing->ListingID }} <span class="header-dot">·</span>
                    {{ getListingTypeName($listing->ListType) }}</p>
            </div>
            <a href="{{ route('edit.listing.form', $listing->ListingID) }}" class="btn-outline-maroon"><i
                    class="fa fa-pencil"></i> Edit listing</a>
        </div>
        {{-- Previous / Next navigation --}}
        <div class="d-flex justify-content-between align-items-center gap-3 mb-4">

            <div>
                @if ($previous)
                    <a href="{{ route('show.listing', $previous->ListingID) }}" class="btn-outline-maroon btn-small">
                        <i class="fa fa-chevron-left"></i>
                        Previous listing
                    </a>
                @endif
            </div>

            <div>
                @if ($next)
                    <a href="{{ route('show.listing', $next->ListingID) }}" class="btn-outline-maroon btn-small">
                        Next listing
                        <i class="fa fa-chevron-right"></i>
                    </a>
                @endif
            </div>

        </div>
        <div class="listing-layout">
            <main class="listing-main-column">
                <section class="listing-card asking-card">
                    <div class="asking-topline">
                        <div>
                            <span class="eyebrow">Asking price</span>
                            <div class="asking-price">${{ number_format((float) ($listing->ListPrice ?? 0)) }}</div>
                        </div>
                        <span
                            class="status-pill">{{ !empty($listing->ExpDate) && \Carbon\Carbon::parse($listing->ExpDate)->isPast() ? 'Expired' : 'Active' }}</span>
                    </div>
                    <div class="card-rule"></div>
                    <h2>Business overview</h2>
                    <p class="overview-copy">{{ $listing->DBA ?: 'Business listing details' }}@if (!empty($listing->Address1))
                            is located at {{ $listing->Address1 }}.
                            @endif @if (!empty($listing->HoursOfOp))
                                Operating hours: {{ $listing->HoursOfOp }}.
                            @endif
                    </p>
                    @if (!empty($listing->document_path))
                        <a class="document-link" href="{{ asset('storage/' . $listing->document_path) }}" target="_blank"
                            rel="noopener"><i class="fa fa-file-pdf-o"></i> View listing document</a>
                    @endif
                </section>

                <section class="listing-card financial-card">
                    <h2>Financial overview</h2>
                    <div class="financial-grid">
                        <div class="financial-item"><span>Annual
                                sales</span><strong>${{ number_format((float) ($listing->AnnualSales ?? 0)) }}</strong>
                        </div>
                        <div class="financial-item"><span>Gross
                                profit</span><strong>${{ number_format((float) ($listing->GrossProfit ?? 0)) }}</strong>
                        </div>
                        <div class="financial-item"><span>Annual net
                                profit</span><strong>${{ number_format((float) ($listing->AnnualNetProfit ?? 0)) }}</strong>
                        </div>
                        <div class="financial-item"><span>Down
                                payment</span><strong>${{ number_format((float) ($listing->DownPay ?? 0)) }}</strong></div>
                    </div>
                </section>

                <section class="listing-card details-card">
                    <div class="section-heading-row">
                        <h2>General information</h2>
                        <a href="{{ route('listing.admin.factsheet.preview', $listing->ListingID) }}"
                            class="btn-outline-maroon btn-small" target="_blank" rel="noopener"><i
                                class="fa fa-file-text-o"></i> Listing factsheet</a>
                    </div>
                    <div class="details-grid">
                        <div class="detail-group">
                            <dl class="detail-list">
                                <div>
                                    <dt>Company</dt>
                                    <dd>{{ $listing->DBA ?: '—' }}</dd>
                                </div>
                                <div>
                                    <dt>Listing agent</dt>
                                    <dd>{{ trim(($listing->AgentFName ?? '') . ' ' . ($listing->AgentLName ?? '')) ?: 'Unassigned' }}
                                    </dd>
                                </div>
                                <div>
                                    <dt>Phone</dt>
                                    <dd>{{ $listing->Phone ?: '—' }}</dd>
                                </div>
                            </dl>
                        </div>
                        <div class="detail-group">
                            <dl class="detail-list">
                                <div>
                                    <dt>Email</dt>
                                    <dd>{{ $listing->Email ?: '—' }}</dd>
                                </div>
                                <div>
                                    <dt>Fax</dt>
                                    <dd>{{ $listing->Fax ?: '—' }}</dd>
                                </div>
                                <div>
                                    <dt>Address</dt>
                                    <dd>{{ $listing->Address1 ?: '—' }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </section>

                <section class="listing-card details-card">
                    <h2>Business information</h2>
                    <div class="details-grid">
                        <div class="detail-group">
                            <dl class="detail-list">
                                <div>
                                    <dt>Building size</dt>
                                    <dd>{{ $listing->BldgSize ?: '—' }}</dd>
                                </div>
                                <div>
                                    <dt>Parking</dt>
                                    <dd>{{ $listing->Parking ?: '—' }}</dd>
                                </div>
                                <div>
                                    <dt>License required</dt>
                                    <dd>{{ $listing->LicenseReq ?: '—' }}</dd>
                                </div>
                            </dl>
                        </div>
                        <div class="detail-group">
                            <dl class="detail-list">
                                <div>
                                    <dt>Base monthly rent</dt>
                                    <dd>${{ number_format((float) ($listing->BaseMonthRent ?? 0)) }}</dd>
                                </div>
                                <div>
                                    <dt>Hours of operation</dt>
                                    <dd>{{ $listing->HoursOfOp ?: '—' }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </section>

                <section class="listing-card details-card">
                    <h2>Pricing &amp; dates</h2>
                    <div class="details-grid">
                        <div class="detail-group">
                            <dl class="detail-list">
                                <div>
                                    <dt>Listing date</dt>
                                    <dd>{{ $listing->ListDate ? \Carbon\Carbon::parse($listing->ListDate)->format('M d, Y') : '—' }}
                                    </dd>
                                </div>
                                <div>
                                    <dt>Expiration date</dt>
                                    <dd>{{ $listing->ExpDate ? \Carbon\Carbon::parse($listing->ExpDate)->format('M d, Y') : '—' }}
                                    </dd>
                                </div>
                                <div>
                                    <dt>Listing type</dt>
                                    <dd>{{ getListingTypeName($listing->ListType) ?: '—' }}</dd>
                                </div>
                            </dl>
                        </div>
                        <div class="detail-group">
                            <dl class="detail-list">
                                <div>
                                    <dt>Asking price</dt>
                                    <dd>${{ number_format((float) ($listing->ListPrice ?? 0)) }}</dd>
                                </div>
                                <div>
                                    <dt>Purchase price</dt>
                                    <dd>${{ number_format((float) ($listing->PurPrice ?? 0)) }}</dd>
                                </div>
                                <div>
                                    <dt>Down payment</dt>
                                    <dd>${{ number_format((float) ($listing->DownPay ?? 0)) }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </section>

                <section class="listing-card details-card">
                    <h2>Financial details</h2>
                    <div class="details-grid">
                        <div class="detail-group">
                            <dl class="detail-list">
                                <div>
                                    <dt>Annual sales</dt>
                                    <dd>${{ number_format((float) ($listing->AnnualSales ?? 0)) }}</dd>
                                </div>
                                <div>
                                    <dt>Gross profit</dt>
                                    <dd>${{ number_format((float) ($listing->GrossProfit ?? 0)) }}</dd>
                                </div>
                                <div>
                                    <dt>Total expenses</dt>
                                    <dd>${{ number_format((float) ($listing->TotalExpenses ?? 0)) }}</dd>
                                </div>
                            </dl>
                        </div>
                        <div class="detail-group">
                            <dl class="detail-list">
                                <div>
                                    <dt>Operating profit</dt>
                                    <dd>${{ number_format((float) ($listing->AnnualNetProfit ?? 0)) }}</dd>
                                </div>
                                <div>
                                    <dt>Annual net profit</dt>
                                    <dd>${{ number_format((float) ($listing->AnnualNetProfit ?? 0)) }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </section>
            </main>

            <aside class="listing-side-column">
                <section class="listing-card side-card">
                    <h2>Listing information</h2>
                    <div class="side-info-item"><span>Listing ID</span><strong>{{ $listing->ListingID }}</strong></div>
                    <div class="side-info-item"><span>Assigned
                            agent</span><strong>{{ trim(($listing->AgentFName ?? '') . ' ' . ($listing->AgentLName ?? '')) ?: 'Unassigned' }}</strong>
                    </div>
                    <div class="side-info-item"><span>Listing
                            expires</span><strong>{{ $listing->ExpDate ? \Carbon\Carbon::parse($listing->ExpDate)->format('M d, Y') : 'Not specified' }}</strong>
                    </div>
                    <div class="side-info-item"><span>Listing
                            type</span><strong>{{ getListingTypeName($listing->ListType) ?: '—' }}</strong></div>
                </section>

                <section class="listing-card side-card image-card">
                    <h2>Listing image</h2>
                    <form action="{{ route('upload.listing.avatar', $listing->ListingID) }}" method="POST"
                        enctype="multipart/form-data" id="listing_show_form">
                        @csrf
                        @method('PUT')
                        <label for="avatar" class="listing-image-preview">
                            @if ($listing->imagepath)
                                <img id="avatar-preview" src="{{ asset('assets/uploads/images/' . $listing->imagepath) }}"
                                    alt="Listing image">
                            @else
                                <img id="avatar-preview" src="{{ asset('assets/images/avatar.png') }}" alt="Listing image">
                            @endif
                        </label>
                        <input type="file" id="avatar" name="avatar" accept="image/*" onchange="previewImage(event)">
                        <div id="listingImgError" class="listing-image-error"></div>
                        <button class="btn-outline-maroon upload-button avatar_img_upload" type="button"
                            onclick="confirmImage(this.form)">Update image</button>
                        <p class="image-help">Minimum image dimensions: 800 × 500 pixels.</p>
                    </form>
                </section>

                <section class="listing-card side-card actions-card">
                    <h2>Related workflow</h2>
                    <p class="workflow-copy">Manage this listing and access its supporting document.</p>
                    <a href="{{ route('edit.listing.form', $listing->ListingID) }}" class="workflow-button">Edit
                        listing</a>
                    <a href="{{ route('listing.admin.factsheet.preview', $listing->ListingID) }}" class="workflow-button"
                        target="_blank" rel="noopener">View listing factsheet</a>
                </section>
            </aside>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
        $(document).ready(function() {
            const $avatar = $('#avatar');
            const $uploadButton = $('.avatar_img_upload');
            const $error = $('#listingImgError');

            // Hide the upload button until a valid image is selected.
            $uploadButton.hide();

            $avatar.on('change', function() {
                const file = this.files && this.files[0];
                const preview = document.getElementById('avatar-preview');

                $uploadButton.hide();
                $error.text('');

                if (!file) {
                    return;
                }

                // Validate the file extension.
                if (!/\.(jpg|jpeg|png|svg)$/i.test(file.name)) {
                    $error.text('Only JPG, JPEG, PNG, and SVG files are allowed.');
                    this.value = '';
                    return;
                }

                // SVG dimensions need separate handling.
                if (/\.svg$/i.test(file.name)) {
                    $error.text('Please select a JPG, JPEG, or PNG image to validate dimensions.');
                    this.value = '';
                    return;
                }

                const imageUrl = URL.createObjectURL(file);
                const img = new Image();

                img.onload = function() {
                    const width = img.naturalWidth;
                    const height = img.naturalHeight;

                    if (width < 800 || height < 500) {
                        $error.text(
                            'Image must be at least 800 × 500 pixels. ' +
                            'Selected image: ' + width + ' × ' + height + ' pixels.'
                        );

                        $uploadButton.hide();
                        $avatar.val('');
                        URL.revokeObjectURL(imageUrl);
                        return;
                    }

                    // Show the preview and enable uploading only for valid dimensions.
                    preview.src = imageUrl;
                    $error.text('');
                    $uploadButton.show();
                };

                img.onerror = function() {
                    $error.text('Unable to read the image. Please select a valid image.');
                    $avatar.val('');
                    URL.revokeObjectURL(imageUrl);
                };

                img.src = imageUrl;
            });
        });

        function previewImage(event) {
            isValidImage = true;
            const preview = document.getElementById('avatar-preview');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    /* $('.avatar_img_upload').show(); */
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
