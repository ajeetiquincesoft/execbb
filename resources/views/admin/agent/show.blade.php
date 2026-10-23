@extends('admin.layout.master')
@section('content')
    {{-- <div class="container-fluid content nextPreviousButtons">
        <div class="next-back-page d-flex justify-content-between align-items-center">

          
            <div>
                @if ($previous)
                    <a href="{{ route('show.agent', $previous->id) }}" class="record-nav-btn previous-btn">
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
                    <a href="{{ route('show.agent', $next->id) }}" class="record-nav-btn next-btn">
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
                                <a href="{{ route('edit.agent', $agent->id) }}"><i class="fa fa-edit edit-icon"></i></a>
                            </div>
                            <div class="text-center">
                                <form action="{{ route('upload.agent.avatar', $agent->agent_info->AgentUserRegisterId) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="avatar-upload">
                                        <input type="file" id="avatar" name="avatar" accept="image/*"
                                            onchange="previewImage(event)">
                                        <label for="avatar" class="circular-image">
                                            @if ($agent->agent_info->image)
                                                <img id="avatar-preview"
                                                    src="{{ asset('assets/uploads/images/' . $agent->agent_info->image) }}"
                                                    alt="Avatar Preview" class="avatar">
                                            @else
                                                <img id="avatar-preview" src="{{ asset('assets/images/avatar.png') }}"
                                                    alt="Avatar Preview" class="avatar">
                                            @endif
                                        </label>
                                    </div>
                                    <button class="avatar_img_upload" type="button"
                                        onclick="confirmImage(this.form)">Confirm Image</button>
                                </form>
                                <h5>{{ $agent->agent_info->FName }} {{ $agent->agent_info->LName }}</h5>
                                <h6>{{ $agent->agent_info->AgentID }}</h6>
                            </div>
                            <div class="table-responsive">
                                <div>
                                    <h6>General Info</h6>
                                    <hr>
                                </div>
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td><img src="{{ url('assets/images/company.svg') }}" alt=""><span
                                                    class="ml-2 fw-600">Name</span></td>
                                            <td class="text-end">{{ $agent->agent_info->FName }}
                                                {{ $agent->agent_info->LName }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/phone.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Phone</span></td>
                                            <td class="text-end">{{ $agent->agent_info->Telephone }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/pager.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Pager</span></td>
                                            <td class="text-end">{{ $agent->agent_info->Pager }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/fax.png') }}" alt=""><span
                                                    class="ml-2 fw-600">fax</span></td>
                                            <td class="text-end">{{ $agent->agent_info->Fax }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/email.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Email</span></td>
                                            <td class="text-end">{{ $agent->agent_info->Email }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/location.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Address</span></td>
                                            <td class="text-end">{{ $agent->agent_info->Address1 }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/location.png') }}" alt=""><span
                                                    class="ml-2 fw-600">City</span></td>
                                            <td class="text-end">{{ $agent->agent_info->City }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/exp_date.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Date of Birth</span></td>
                                            <td class="text-end">{{ $agent->agent_info->DOB }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/spouse.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Spouse</span></td>
                                            <td class="text-end">{{ $agent->agent_info->Spouse }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/exp_date.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Hire Date</span></td>
                                            <td class="text-end">{{ $agent->agent_info->HireDate }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/exp_date.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Terminated</span></td>
                                            <td class="text-end">{{ $agent->agent_info->Termination }}</td>
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

        .agent-avatar-wrap {
            flex: 0 0 auto;
        }

        .agent-avatar-form {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
        }

        .agent-avatar-form .avatar-upload {
            position: relative;
        }

        .agent-avatar-form input[type="file"] {
            position: absolute;
            width: 1px;
            height: 1px;
            opacity: 0;
            overflow: hidden;
        }

        .agent-avatar-form .circular-image {
            display: block;
            cursor: pointer;
        }

        .agent-avatar-form .avatar {
            /*  width: 82px;
                height: 82px; */
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #f0dce4;
            display: block;
        }

        .agent-avatar-form .avatar_img_upload {
            display: none;
            align-items: center;
            gap: 5px;
            padding: 6px 9px;
            border: 1px solid var(--lp-maroon);
            border-radius: 6px;
            background: #fff;
            color: var(--lp-maroon);
            font-size: 11px;
            cursor: pointer;
        }

        .agent-avatar-form .avatar_img_upload:hover {
            background: var(--lp-maroon);
            color: #fff;
        }

        .agent-avatar-form input[type="file"]:focus+label {
            outline: 2px solid var(--lp-maroon);
        }

        @media(max-width:767px) {
            .asking-topline {
                flex-wrap: wrap;
            }

            .asking-topline>.d-flex {
                align-items: flex-start !important;
            }
        }
    </style>

    <div class="listing-page container-fluid">
        <div class="d-flex justify-content-between align-items-center gap-3 mb-4 flex-wrap">
            <div>
                @if ($previous)
                    <a href="{{ route('show.agent', $previous->id) }}" class="btn-outline-maroon btn-small">
                        <i class="fa fa-chevron-left"></i> Previous agent
                    </a>
                @endif
            </div>
            <div>
                @if ($next)
                    <a href="{{ route('show.agent', $next->id) }}" class="btn-outline-maroon btn-small">
                        Next agent <i class="fa fa-chevron-right"></i>
                    </a>
                @endif
            </div>
        </div>

        <div class="listing-page-header">
            <div>
                <div class="eyebrow">Agent management <span class="header-dot">/</span> Agent details</div>
                <h1>{{ trim(($agent->agent_info->FName ?? '') . ' ' . ($agent->agent_info->LName ?? '')) ?: 'Agent Details' }}
                </h1>
                <p>Agent ID: <strong>{{ $agent->agent_info->AgentID ?? 'N/A' }}</strong> <span class="header-dot">•</span>
                    Review agent contact and employment information.</p>
            </div>
            <a href="{{ route('edit.agent', $agent->id) }}" class="btn-outline-maroon">
                <i class="fa fa-pencil-alt"></i> Edit Agent
            </a>
        </div>

        <div class="listing-layout">
            <main class="listing-main-column">
                <section class="listing-card asking-card">
                    <div class="asking-topline">
                        <div class="d-flex align-items-center gap-3">
                            <div class="agent-avatar-wrap">
                                <form action="{{ route('upload.agent.avatar', $agent->agent_info->AgentUserRegisterId) }}"
                                    method="POST" enctype="multipart/form-data" class="agent-avatar-form">
                                    @csrf
                                    @method('PUT')
                                    <div class="avatar-upload">
                                        <input type="file" id="avatar" name="avatar" accept="image/*"
                                            onchange="previewImage(event)">
                                        <label for="avatar" class="circular-image">
                                            @if (!empty($agent->agent_info->image))
                                                <img id="avatar-preview"
                                                    src="{{ asset('assets/uploads/images/' . $agent->agent_info->image) }}"
                                                    alt="Agent avatar" class="avatar">
                                            @else
                                                <img id="avatar-preview" src="{{ asset('assets/images/avatar.png') }}"
                                                    alt="Agent avatar" class="avatar">
                                            @endif
                                        </label>
                                    </div>
                                    <button class="avatar_img_upload" type="button" onclick="confirmImage(this.form)">
                                        <i class="fa fa-check"></i> Confirm
                                    </button>
                                </form>
                            </div>
                            <div>
                                <span class="eyebrow">Agent profile</span>
                                <h2>{{ trim(($agent->agent_info->FName ?? '') . ' ' . ($agent->agent_info->LName ?? '')) ?: 'Agent' }}
                                </h2>
                                <p class="overview-copy">Agent ID: {{ $agent->agent_info->AgentID ?? 'N/A' }}</p>
                            </div>
                        </div>
                        <span class="status-pill">Agent</span>
                    </div>
                    <div class="card-rule"></div>
                    <div class="financial-grid">
                        <div class="financial-item">
                            <span>Email</span>
                            <strong>{{ $agent->agent_info->Email ?: 'N/A' }}</strong>
                        </div>
                        <div class="financial-item">
                            <span>Telephone</span>
                            <strong>{{ $agent->agent_info->Telephone ?: 'N/A' }}</strong>
                        </div>
                        <div class="financial-item">
                            <span>City</span>
                            <strong>{{ $agent->agent_info->City ?: 'N/A' }}</strong>
                        </div>
                        <div class="financial-item">
                            <span>Hire date</span>
                            <strong>{{ $agent->agent_info->HireDate ?: 'N/A' }}</strong>
                        </div>
                    </div>
                </section>

                <section class="listing-card">
                    <div class="section-heading-row">
                        <h2>Agent information</h2>
                    </div>
                    <div class="details-grid">
                        <div class="detail-group">
                            <h3>Contact information</h3>
                            <dl class="detail-list">
                                <div>
                                    <dt>First name</dt>
                                    <dd>{{ $agent->agent_info->FName ?? 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt>Last name</dt>
                                    <dd>{{ $agent->agent_info->LName ?? 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt>Email</dt>
                                    <dd>{{ $agent->agent_info->Email ?? 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt>Telephone</dt>
                                    <dd>{{ $agent->agent_info->Telephone ?? 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt>Pager</dt>
                                    <dd>{{ $agent->agent_info->Pager ?? 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt>Fax</dt>
                                    <dd>{{ $agent->agent_info->Fax ?? 'N/A' }}</dd>
                                </div>
                            </dl>
                        </div>
                        <div class="detail-group">
                            <h3>Address and personal details</h3>
                            <dl class="detail-list">
                                <div>
                                    <dt>Address</dt>
                                    <dd>{{ $agent->agent_info->Address1 ?? 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt>City</dt>
                                    <dd>{{ $agent->agent_info->City ?? 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt>Date of birth</dt>
                                    <dd>{{ $agent->agent_info->DOB ?? 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt>Spouse</dt>
                                    <dd>{{ $agent->agent_info->Spouse ?? 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt>Hire date</dt>
                                    <dd>{{ $agent->agent_info->HireDate ?? 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt>Termination date</dt>
                                    <dd>{{ $agent->agent_info->Termination ?? 'N/A' }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </section>
            </main>

            <aside class="listing-side-column">
                <section class="listing-card side-card">
                    <h2>Agent summary</h2>
                    <div class="side-info-item">
                        <span>Agent ID</span>
                        <strong>{{ $agent->agent_info->AgentID ?? 'N/A' }}</strong>
                    </div>
                    <div class="side-info-item">
                        <span>Name</span>
                        <strong>{{ trim(($agent->agent_info->FName ?? '') . ' ' . ($agent->agent_info->LName ?? '')) ?: 'N/A' }}</strong>
                    </div>
                    <div class="side-info-item">
                        <span>Email</span>
                        <strong>{{ $agent->agent_info->Email ?? 'N/A' }}</strong>
                    </div>
                    <div class="side-info-item">
                        <span>Telephone</span>
                        <strong>{{ $agent->agent_info->Telephone ?? 'N/A' }}</strong>
                    </div>
                    <div class="side-info-item">
                        <span>Employment status</span>
                        <strong>{{ !empty($agent->agent_info->Termination) ? 'Terminated' : 'Active' }}</strong>
                    </div>
                </section>

                <section class="listing-card side-card">
                    <h2>Quick links</h2>
                    <a href="{{ route('edit.agent', $agent->id) }}" class="quick-action">
                        <span><i class="fa fa-pencil-alt"></i></span> Edit agent <i class="fa fa-chevron-right"></i>
                    </a>
                    @if (!empty($agent->agent_info->Email))
                        <a href="mailto:{{ $agent->agent_info->Email }}" class="quick-action">
                            <span><i class="fa fa-envelope"></i></span> Send email <i class="fa fa-chevron-right"></i>
                        </a>
                    @endif
                    @if (!empty($agent->agent_info->Telephone))
                        <a href="tel:{{ $agent->agent_info->Telephone }}" class="quick-action">
                            <span><i class="fa fa-phone"></i></span> Call agent <i class="fa fa-chevron-right"></i>
                        </a>
                    @endif
                </section>
            </aside>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const preview = document.getElementById('avatar-preview');
            const file = event.target.files[0];

            if (file && preview) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    const confirmButton = document.querySelector('.avatar_img_upload');
                    if (confirmButton) {
                        confirmButton.style.display = 'inline-flex';
                    }
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
