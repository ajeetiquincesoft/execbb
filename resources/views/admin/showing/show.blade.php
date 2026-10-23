@extends('admin.layout.master')
@section('content')
    {{-- <div class="container-fluid content nextPreviousButtons">
        <div class="next-back-page d-flex justify-content-between align-items-center">


            <div>
                @if ($previous)
                    <a href="{{ route('show.showing', $previous->ShowingID) }}" class="record-nav-btn previous-btn">
                        <span class="nav-icon">
                            <i class="fa fa-chevron-left"></i>
                        </span>
                        <span class="nav-text">
                            <small>Navigate</small>
                            <strong>Previous Record</strong>
                        </span>
                    </a>
                @endif
            </div>


            <div>
                @if ($next)
                    <a href="{{ route('show.showing', $next->ShowingID) }}" class="record-nav-btn next-btn">
                        <span class="nav-text text-end">
                            <small>Navigate</small>
                            <strong>Next Record</strong>
                        </span>
                        <span class="nav-icon">
                            <i class="fa fa-chevron-right"></i>
                        </span>
                    </a>
                @endif
            </div>

        </div>
    </div>
    <div class="container-fluid content bg-light">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-5 mb-5 mb-xl-0">
                <div class="card">
                    <div class="card-body">
                        <div class="profile-info">
                            <div class="text-end">
                                <a href="{{ route('edit.showing', $showing->ShowingID) }}"><i
                                        class="fa fa-edit edit-icon"></i></a>
                            </div>
                            <div class="text-center">
                                <img id="avatar-preview" src="{{ asset('assets/images/user.png') }}" alt="Avatar Preview"
                                    width="100">
                                <h5>{{ $dbaName[$showing->ListingID] ?? 'N/A' }}</h5>
                                <h6>Showing ID: {{ $showing->ShowingID }}</h6>
                            </div>
                            <div class="table-responsive">
                                <div>
                                    <h6>General Info</h6>
                                </div>
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td><img src="{{ url('assets/images/press_owner.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Agent</span></td>
                                            <td class="text-end">{{ $showing->AgentID }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/press_owner.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Buyer</span></td>
                                            <td class="text-end">{{ $buyerName[$showing->BuyerID] ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/exp_date.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Date</span></td>
                                            <td class="text-end">{{ $showing->Date }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/company.svg') }}" alt=""><span
                                                    class="ml-2 fw-600">DBA</span></td>
                                            <td class="text-end">{{ $dbaName[$showing->ListingID] ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/location.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Offer Made</span></td>
                                            <td class="text-end">{{ $showing->OfferMade == 1 ? 'Yes' : 'No' }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/phone.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Follow Up</span></td>
                                            <td class="text-end">{{ $showing->FollowUp }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
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
    </div>
    <script>
        function previewImage(event) {
            const preview = document.getElementById('avatar-preview');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    $('.avatar_img_upload').show();
                }
                reader.readAsDataURL(file);
            }
        }
    </script> --}}
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

        /* Style only the icon badge; do not constrain the text wrapper. */
        .quick-action .quick-action-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 31px;
            width: 31px;
            height: 31px;
            border-radius: 8px;
            background: #f8edf1;
            color: var(--lp-maroon)
        }

        .quick-action .quick-action-text {
            display: block;
            flex: 1 1 auto;
            width: auto;
            min-width: 0;
            height: auto;
            background: transparent;
            color: inherit;
            line-height: 1.4;
        }

        .quick-action .quick-action-text strong,
        .quick-action .quick-action-text small {
            display: block;
            white-space: normal;
            overflow-wrap: anywhere;
        }

        .quick-action .quick-action-text strong {
            font-size: 13px;
            line-height: 1.35;
        }

        .quick-action .quick-action-text small {
            margin-top: 2px;
            color: var(--lp-muted);
            font-size: 11px;
            font-weight: 400;
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

        .buyer-profile-mark {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 58px;
            height: 58px;
            border-radius: 15px;
            background: #f8edf1;
            color: var(--lp-maroon);
            font-size: 22px;
            font-weight: 800;
            margin-bottom: 14px;
        }

        @media(max-width: 767px) {
            .listing-page {
                padding: 18px 12px 28px;
            }
        }
    </style>

    <style>
        .header-actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .btn-maroon {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 11px 16px;
            border-radius: 8px;
            background: var(--lp-maroon);
            color: #fff !important;
            text-decoration: none;
            font-weight: 700;
            font-size: 13px;
        }

        .btn-maroon:hover {
            background: var(--lp-maroon-dark);
        }

        .record-navigation {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin: 0 auto 20px;
            max-width: 1600px;
        }

        .record-nav-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border: 1px solid var(--lp-border);
            border-radius: 10px;
            background: #fff;
            color: var(--lp-ink);
            text-decoration: none;
        }

        .record-nav-btn:hover {
            border-color: var(--lp-maroon);
            color: var(--lp-maroon);
        }

        .record-nav-btn small {
            display: block;
            color: var(--lp-muted);
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: .06em;
        }

        .record-nav-btn strong {
            display: block;
            font-size: 12px;
        }

        .nav-icon {
            color: var(--lp-maroon);
        }

        .status-active {
            background: #e7f7ee !important;
            color: #167447 !important;
        }

        .card-subtitle {
            margin: 4px 0 0;
            color: var(--lp-muted);
            font-size: 13px;
        }

        @media(max-width:767px) {
            .listing-page {
                padding: 16px 12px 28px;
            }

            .listing-page-header {
                flex-direction: column;
            }

            .record-navigation {
                align-items: stretch;
            }

            .record-nav-btn {
                padding: 9px;
            }
        }
    </style>

    <style>
        /* Match the compact Referral details layout and typography. */
        .listing-page .listing-page-header {
            margin-bottom: 20px;
        }

        .listing-page .listing-page-header h1 {
            font-size: 22px;
            font-weight: 700;
        }

        .listing-page .listing-card h2 {
            font-size: 16px;
        }

        .listing-page .listing-card h3 {
            font-size: 17px;
            line-height: 1.35;
            font-weight: 700;
            margin: 0 0 16px;
            color: var(--lp-ink);
        }

        .listing-page .side-card h3 {
            font-size: 17px;
            margin: 0 0 18px;
        }

        .listing-page .section-heading {
            margin-bottom: 12px;
        }

        .listing-page .asking-price {
            font-size: 30px;
        }

        .listing-page .record-navigation {
            margin-bottom: 20px;
        }

        .listing-page .btn-outline-maroon {
            padding: 9px 13px;
        }

        .listing-page .quick-action {
            min-height: 52px;
        }

        .listing-page .quick-action .quick-action-text {
            min-width: 0;
            flex: 1 1 auto;
        }

        .listing-page .quick-action .quick-action-text strong {
            white-space: normal;
            overflow-wrap: break-word;
        }

        @media(max-width:767px) {
            .listing-page .listing-page-header h1 {
                font-size: 20px;
            }
        }
    </style>

    <div class="listing-page container-fluid">

        <div class="d-flex justify-content-between align-items-center gap-3 mb-4 flex-wrap">
            <div>
                @if ($previous)
                    <a href="{{ route('show.showing', $previous->ShowingID) }}" class="btn-outline-maroon btn-small">
                        <i class="fa fa-chevron-left"></i> Previous showing
                    </a>
                @endif
            </div>
            <div>
                @if ($next)
                    <a href="{{ route('show.showing', $next->ShowingID) }}" class="btn-outline-maroon btn-small">
                        Next showing <i class="fa fa-chevron-right"></i>
                    </a>
                @endif
            </div>
        </div>


        <div class="listing-page-header">
            <div>
                <div class="header-dot"><span></span> Showing Details</div>
                <h1>{{ $dbaName[$showing->ListingID] ?? 'Showing Record' }}</h1>
                <p>Showing ID: {{ $showing->ShowingID }} · Review showing details, participants, and follow-up.</p>
            </div>
            <div class="header-actions">
                <a href="{{ route('edit.showing', $showing->ShowingID) }}" class="btn-outline-maroon">
                    <i class="fa fa-edit"></i> Edit Showing
                </a>
            </div>
        </div>

        <div class="listing-layout">
            <main class="listing-main-column">
                <section class="listing-card asking-card">
                    <div class="asking-topline">
                        <div>
                            <span class="eyebrow">SHOWING SUMMARY</span>
                            <h2>{{ $dbaName[$showing->ListingID] ?? 'N/A' }}</h2>
                            <p class="card-subtitle">Showing record #{{ $showing->ShowingID }}</p>
                        </div>
                        <span class="status-pill {{ $showing->OfferMade == 1 ? 'status-active' : '' }}">
                            {{ $showing->OfferMade == 1 ? 'Offer Made' : 'No Offer Made' }}
                        </span>
                    </div>
                    <div class="card-rule"></div>
                    <div class="financial-grid">
                        <div class="financial-item">
                            <span>Showing Date</span>
                            <strong>{{ $showing->Date ?: 'N/A' }}</strong>
                        </div>
                        <div class="financial-item">
                            <span>Follow Up</span>
                            <strong>{{ $showing->FollowUp ?: 'N/A' }}</strong>
                        </div>
                        <div class="financial-item">
                            <span>Agent</span>
                            <strong>{{ $showing->AgentID ?: 'N/A' }}</strong>
                        </div>
                    </div>
                </section>


                <section class="listing-card">
                    <div class="section-heading-row" bis_skin_checked="1">
                        <h2>Showing Information</h2>
                    </div>
                    <div class="details-grid" bis_skin_checked="1">
                        <div class="detail-group" bis_skin_checked="1">
                            <h3>Showing Details</h3>
                            <dl class="detail-list">
                                <div bis_skin_checked="1">
                                    <dt>Showing ID</dt>
                                    <dd>{{ $showing->ShowingID }}</dd>
                                </div>
                                <div bis_skin_checked="1">
                                    <dt>Date</dt>
                                    <dd>{{ $showing->Date ?: 'N/A' }}</dd>
                                </div>
                                <div bis_skin_checked="1">
                                    <dt>Offer Made</dt>
                                    <dd>{{ $showing->OfferMade == 1 ? 'Yes' : 'No' }}</dd>
                                </div>
                                <div bis_skin_checked="1">
                                    <dt>Follow Up</dt>
                                    <dd>{{ $showing->FollowUp ?: 'N/A' }}</dd>
                                </div>
                            </dl>
                        </div>
                        <div class="detail-group" bis_skin_checked="1">
                            <h3>Listing Information</h3>
                            <dl class="detail-list">
                                <div bis_skin_checked="1">
                                    <dt>DBA / Business</dt>
                                    <dd>{{ $dbaName[$showing->ListingID] ?? 'N/A' }}</dd>
                                </div>
                                <div bis_skin_checked="1">
                                    <dt>Listing ID</dt>
                                    <dd>{{ $showing->ListingID ?: 'N/A' }}</dd>
                                </div>
                                <div bis_skin_checked="1">
                                    <dt>Agent ID</dt>
                                    <dd>{{ $showing->AgentID ?: 'N/A' }}</dd>
                                </div>
                                <div bis_skin_checked="1">
                                    <dt>Buyer</dt>
                                    <dd>{{ $buyerName[$showing->BuyerID] ?? 'N/A' }}</dd>
                                </div>

                            </dl>
                        </div>
                    </div>
                </section>
            </main>

            <aside class="listing-side-column">
                <section class="listing-card side-card">
                    <span class="eyebrow">PARTICIPANTS</span>
                    <h3>Showing Summary</h3>
                    <div class="side-info-item">
                        <span>Business</span><strong>{{ $dbaName[$showing->ListingID] ?? 'N/A' }}</strong>
                    </div>
                    <div class="side-info-item">
                        <span>Buyer</span><strong>{{ $buyerName[$showing->BuyerID] ?? 'N/A' }}</strong>
                    </div>
                    <div class="side-info-item"><span>Agent ID</span><strong>{{ $showing->AgentID ?: 'N/A' }}</strong>
                    </div>
                    <div class="side-info-item"><span>Date</span><strong>{{ $showing->Date ?: 'N/A' }}</strong></div>
                    <div class="side-info-item"><span>Offer
                            Made</span><strong>{{ $showing->OfferMade == 1 ? 'Yes' : 'No' }}</strong></div>
                </section>

                <section class="listing-card side-card">
                    <span class="eyebrow">SHORTCUTS</span>
                    <h3>Quick Links</h3>
                    <a class="quick-action" href="{{ route('edit.showing', $showing->ShowingID) }}"><span
                            class="quick-action-icon"><i class="fa fa-edit"></i></span><span
                            class="quick-action-text"><strong>Edit Showing</strong><small>Update showing
                                information</small></span><i class="fa fa-chevron-right"></i></a>
                    @if (!empty($showing->BuyerID))
                        <a class="quick-action" href="{{ route('show.buyer', $showing->BuyerID) }}"><span
                                class="quick-action-icon"><i class="fa fa-user"></i></span><span
                                class="quick-action-text"><strong>View Buyer</strong><small>Open buyer
                                    record</small></span><i class="fa fa-chevron-right"></i></a>
                    @endif
                </section>
            </aside>
        </div>
    </div>
@endsection
