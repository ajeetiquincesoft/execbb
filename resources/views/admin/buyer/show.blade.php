@extends('admin.layout.master')
@section('content')
    {{--   <div class="container-fluid content nextPreviousButtons">
        <div class="next-back-page d-flex justify-content-between align-items-center">

           
            <div>
                @if ($previous)
                    <a href="{{ route('show.buyer', $previous->BuyerID) }}" class="record-nav-btn previous-btn">
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
                    <a href="{{ route('show.buyer', $next->BuyerID) }}" class="record-nav-btn next-btn">
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
    </div> --}}
    {{--   <div class="container-fluid content bg-light">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-5 mb-5 mb-xl-0">
                <div class="card">
                    <div class="card-body">
                        <div class="profile-info">

                            <div class="text-center">
                                <img id="avatar-preview" src="{{ asset('assets/images/user.png') }}" alt="Avatar Preview"
                                    width="100">
                                <h5>{{ $buyer->FName }} {{ $buyer->LName }}</h5>
                                <h6>{{ $buyer->BuyerID }}</h6>
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
                                            <td class="text-end">{{ $buyer->FName ?? 'N/A' }} {{ $buyer->LName ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="http://127.0.0.1:8000/assets/images/buyer.png"
                                                    alt=""><span class="ml-2 fw-600">Agent</span></td>
                                            <td class="text-end">
                                                {{ trim(($agent->FName ?? '') . ' ' . ($agent->LName ?? '')) ?: 'Unassigned' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><img src="http://127.0.0.1:8000/assets/images/exp_date.png"
                                                    alt=""><span class="ml-2 fw-600">Date of Birth</span></td>
                                            <td class="text-end">{{ $buyer->BDate ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/location.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Address</span></td>
                                            <td class="text-end">{{ $buyer->Address1 ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/location.png') }}" alt=""><span
                                                    class="ml-2 fw-600">City</span></td>
                                            <td class="text-end">{{ $buyer->City ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/location.png') }}" alt=""><span
                                                    class="ml-2 fw-600">State</span></td>
                                            <td class="text-end">{{ $buyer->State ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/location.png') }}" alt=""><span
                                                    class="ml-2 fw-600">ZIP Code</span></td>
                                            <td class="text-end">{{ $buyer->Zip ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/phone.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Home Phone</span></td>
                                            <td class="text-end">{{ $buyer->HomePhone ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/phone.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Business Phone</span></td>
                                            <td class="text-end">{{ $buyer->BusPhone ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="http://127.0.0.1:8000/assets/images/fax.png" alt=""><span
                                                    class="ml-2 fw-600">Fax</span></td>
                                            <td class="text-end">{{ $buyer->Fax ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="http://127.0.0.1:8000/assets/images/pager.png"
                                                    alt=""><span class="ml-2 fw-600">Pager</span></td>
                                            <td class="text-end">{{ $buyer->Pager ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/email.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Email</span></td>
                                            <td class="text-end">{{ $buyer->Email ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/phone.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Call When</span></td>
                                            <td class="text-end">{{ $buyer->callWhen ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="http://127.0.0.1:8000/assets/images/license.png"
                                                    alt=""><span class="ml-2 fw-600">Driver's License</span></td>
                                            <td class="text-end">{{ $buyer->DLNo ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="http://127.0.0.1:8000/assets/images/license.png"
                                                    alt=""><span class="ml-2 fw-600">SSN</span></td>
                                            <td class="text-end">{{ !empty($buyer->SocSecNo) ? 'Provided' : 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="http://127.0.0.1:8000/assets/images/buyer.png"
                                                    alt=""><span class="ml-2 fw-600">Corporate Buyer</span></td>
                                            <td class="text-end">{{ $buyer->CorporateBuyer ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="http://127.0.0.1:8000/assets/images/Vector.png"
                                                    alt=""><span class="ml-2 fw-600">Preferred Terms</span></td>
                                            <td class="text-end">{{ $buyer->Group ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="http://127.0.0.1:8000/assets/images/exp_date.png"
                                                    alt=""><span class="ml-2 fw-600">Month Expiration Date</span>
                                            </td>
                                            <td class="text-end">{{ $buyer->ExpDate ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/email.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Email Opt Out</span></td>
                                            <td class="text-end">{{ $buyer->OptOut ?? 'N/A' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            
                            <div class="table-responsive mt-4">
                                <div>
                                    <h6>Personal Business</h6>
                                    <hr>
                                </div>
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td><img src="http://127.0.0.1:8000/assets/images/accountant.png"
                                                    alt=""><span class="ml-2 fw-600">Partner Name</span></td>
                                            <td class="text-end">{{ $buyer->PartnerName ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/phone.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Partner Phone</span></td>
                                            <td class="text-end">{{ $buyer->PartnerPhone ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="http://127.0.0.1:8000/assets/images/accountant.png"
                                                    alt=""><span class="ml-2 fw-600">Current Employment</span>
                                            </td>
                                            <td class="text-end">{{ $buyer->CurrentEmploy ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="http://127.0.0.1:8000/assets/images/lease_option.png"
                                                    alt=""><span class="ml-2 fw-600">Motivation</span></td>
                                            <td class="text-end">
                                                @switch((string) ($buyer->Interest ?? ''))
                                                    @case('1')
                                                        Hot
                                                    @break

                                                    @case('2')
                                                        Medium
                                                    @break

                                                    @case('3')
                                                        Cold
                                                    @break

                                                    @default
                                                        N/A
                                                @endswitch
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                          
                            <div class="table-responsive mt-4">
                                <div>
                                    <h6>Business Interest</h6>
                                    <hr>
                                </div>
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td> <img src="{{ url('assets/images/company.svg') }}" alt="Business"><span
                                                    class="ml-2 fw-600">Business Type 1</span></td>
                                            <td class="text-end"> {{ $businessTypes[$buyer->BusType1 ?? ''] ?? 'N/A' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> <img src="{{ url('assets/images/company.svg') }}" alt="Business"><span
                                                    class="ml-2 fw-600">Business Type 2</span></td>
                                            <td class="text-end"> {{ $businessTypes[$buyer->BusType2 ?? ''] ?? 'N/A' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> <img src="{{ url('assets/images/company.svg') }}" alt="Business"><span
                                                    class="ml-2 fw-600">Business Type 3</span></td>
                                            <td class="text-end"> {{ $businessTypes[$buyer->BusType3 ?? ''] ?? 'N/A' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> <img src="{{ url('assets/images/company.svg') }}" alt="Business"><span
                                                    class="ml-2 fw-600">Business Type 4</span></td>
                                            <td class="text-end"> {{ $businessTypes[$buyer->BusType4 ?? ''] ?? 'N/A' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/location.png') }}" alt="County"><span
                                                    class="ml-2 fw-600">Desired County 1</span></td>
                                            <td class="text-end">{{ $buyer->BusCounty1 ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/location.png') }}" alt="County"><span
                                                    class="ml-2 fw-600">Desired County 2</span></td>
                                            <td class="text-end">{{ $buyer->BusCounty2 ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/location.png') }}" alt="County"><span
                                                    class="ml-2 fw-600">Desired County 3</span></td>
                                            <td class="text-end">{{ $buyer->BusCounty3 ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td> <img src="{{ url('assets/images/location.png') }}" alt="County"><span
                                                    class="ml-2 fw-600">Desired County 4</span></td>
                                            <td class="text-end">{{ $buyer->BusCounty4 ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td> <img src="{{ url('assets/images/location.png') }}" alt="location"><span
                                                    class="ml-2 fw-600">Desired Location</span></td>
                                            <td class="text-end">{{ $buyer->BusLocation ?? 'N/A' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                           
                            <div class="table-responsive mt-4">
                                <div>
                                    <h6>Pricing and Financial Information</h6>
                                    <hr>
                                </div>
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td><img src="http://127.0.0.1:8000/assets/images/price.png"
                                                    alt=""><span class="ml-2 fw-600">Maximum Price</span></td>
                                            <td class="text-end">
                                                {{ isset($buyer->PPMax) ? number_format((float) $buyer->PPMax, 2) : 'N/A' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><img src="http://127.0.0.1:8000/assets/images/price.png"
                                                    alt=""><span class="ml-2 fw-600">Maximum Down Payment</span>
                                            </td>
                                            <td class="text-end">
                                                {{ isset($buyer->DownPmtMax) ? number_format((float) $buyer->DownPmtMax, 2) : 'N/A' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><img src="http://127.0.0.1:8000/assets/images/price.png"
                                                    alt=""><span class="ml-2 fw-600">Minimum Annual Sales</span>
                                            </td>
                                            <td class="text-end">
                                                {{ isset($buyer->VolMin) ? number_format((float) $buyer->VolMin, 2) : 'N/A' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><img src="http://127.0.0.1:8000/assets/images/price.png"
                                                    alt=""><span class="ml-2 fw-600">Minimum Net Profit</span>
                                            </td>
                                            <td class="text-end">
                                                {{ isset($buyer->NetProfMin) ? number_format((float) $buyer->NetProfMin, 2) : 'N/A' }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                           
                            <div class="table-responsive mt-4">
                                <div>
                                    <h6>Probable Match Criteria</h6>
                                    <hr>
                                </div>
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td><img src="http://127.0.0.1:8000/assets/images/price.png"
                                                    alt=""><span class="ml-2 fw-600">Business Interest</span></td>
                                            <td class="text-end">{{ $buyer->BusInt ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="http://127.0.0.1:8000/assets/images/price.png"
                                                    alt=""><span class="ml-2 fw-600">Location</span></td>
                                            <td class="text-end">{{ $buyer->Location ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="http://127.0.0.1:8000/assets/images/price.png"
                                                    alt=""><span class="ml-2 fw-600">Price</span></td>
                                            <td class="text-end">{{ $buyer->Price ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="http://127.0.0.1:8000/assets/images/price.png"
                                                    alt=""><span class="ml-2 fw-600">Down Payment</span></td>
                                            <td class="text-end">{{ $buyer->DownPay ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="http://127.0.0.1:8000/assets/images/price.png"
                                                    alt=""><span class="ml-2 fw-600">Sales Volume</span></td>
                                            <td class="text-end">{{ $buyer->SalesVol ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="http://127.0.0.1:8000/assets/images/price.png"
                                                    alt=""><span class="ml-2 fw-600">Profit</span></td>
                                            <td class="text-end">{{ $buyer->Profit ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="http://127.0.0.1:8000/assets/images/price.png"
                                                    alt=""><span class="ml-2 fw-600">Total</span></td>
                                            <td class="text-end">{{ $buyer->Total ?? 'N/A' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>


                            @if ($ndaExists)
                                <a href="{{ route('buyer.nda.form.download', $buyer->user_id) }}" class=""><i
                                        class="fa fa-download"></i> Download NDA Form</a>
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
    </style>

    <div class="listing-page container-fluid">
        <div class="d-flex justify-content-between align-items-center gap-3 mb-4 flex-wrap">
            <div>
                @if ($previous)
                    <a href="{{ route('show.buyer', $previous->BuyerID) }}" class="btn-outline-maroon btn-small">
                        <i class="fa fa-chevron-left"></i> Previous buyer
                    </a>
                @endif
            </div>
            <div>
                @if ($next)
                    <a href="{{ route('show.buyer', $next->BuyerID) }}" class="btn-outline-maroon btn-small">
                        Next buyer <i class="fa fa-chevron-right"></i>
                    </a>
                @endif
            </div>
        </div>
        <div class="listing-page-header">
            <div>
                <div class="eyebrow">Buyer management <span class="header-dot">/</span> Buyer details</div>
                <h1>{{ trim(($buyer->FName ?? '') . ' ' . ($buyer->LName ?? '')) ?: 'Buyer Details' }}</h1>
                <p>Buyer ID: <strong>{{ $buyer->BuyerID }}</strong> <span class="header-dot">•</span> Review contact
                    details, interests, and purchase criteria.</p>
            </div>
            <a href="{{ route('edit.buyer.form', $buyer->BuyerID) }}" class="btn-outline-maroon">
                <i class="fa fa-pencil-alt"></i> Edit Buyer
            </a>
        </div>

        <div class="listing-layout">
            <main class="listing-main-column">
                <section class="listing-card asking-card">
                    <div class="asking-topline">
                        <div>
                            <span class="eyebrow">Buyer profile</span>
                            <h2>{{ trim(($buyer->FName ?? '') . ' ' . ($buyer->LName ?? '')) ?: 'Buyer' }}</h2>
                            <p class="overview-copy">Buyer record #{{ $buyer->BuyerID }}</p>
                        </div>
                        <span
                            class="status-pill">{{ trim(($agent->FName ?? '') . ' ' . ($agent->LName ?? '')) ?: 'Unassigned' }}</span>
                    </div>
                    <div class="card-rule"></div>
                    <div class="financial-grid">
                        <div class="financial-item"><span>Maximum
                                price</span><strong>{{ isset($buyer->PPMax) ? '$' . number_format((float) $buyer->PPMax, 0) : 'N/A' }}</strong>
                        </div>
                        <div class="financial-item"><span>Down
                                payment</span><strong>{{ isset($buyer->DownPmtMax) ? '$' . number_format((float) $buyer->DownPmtMax, 0) : 'N/A' }}</strong>
                        </div>
                        <div class="financial-item"><span>Home
                                phone</span><strong>{{ $buyer->HomePhone ?: ($buyer->BusPhone ?: 'N/A') }}</strong></div>
                        <div class="financial-item"><span>Email</span><strong>{{ $buyer->Email ?? 'N/A' }}</strong></div>
                    </div>
                </section>

                <section class="listing-card">
                    <div class="section-heading-row">
                        <h2>Buyer information</h2>
                    </div>
                    <div class="details-grid">
                        <div class="detail-group">
                            <h3>General information</h3>
                            <dl class="detail-list">
                                <div>
                                    <dt>Buyer name</dt>
                                    <dd>{{ trim(($buyer->FName ?? '') . ' ' . ($buyer->LName ?? '')) ?: 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt>Agent</dt>
                                    <dd>{{ trim(($agent->FName ?? '') . ' ' . ($agent->LName ?? '')) ?: 'Unassigned' }}
                                    </dd>
                                </div>
                                <div>
                                    <dt>Date of birth</dt>
                                    <dd>{{ $buyer->BDate ?? 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt>Address</dt>
                                    <dd>{{ $buyer->Address1 ?? 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt>City</dt>
                                    <dd>{{ $buyer->City ?? 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt>State</dt>
                                    <dd>{{ $buyer->State ?? 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt>ZIP code</dt>
                                    <dd>{{ $buyer->Zip ?? 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt>Home phone</dt>
                                    <dd>{{ $buyer->HomePhone ?? 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt>Business phone</dt>
                                    <dd>{{ $buyer->BusPhone ?? 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt>Fax</dt>
                                    <dd>{{ $buyer->Fax ?? 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt>Pager</dt>
                                    <dd>{{ $buyer->Pager ?? 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt>Email</dt>
                                    <dd>{{ $buyer->Email ?? 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt>Call when</dt>
                                    <dd>{{ $buyer->callWhen ?? 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt>Driver's license</dt>
                                    <dd>{{ $buyer->DLNo ?? 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt>SSN</dt>
                                    <dd>{{ !empty($buyer->SocSecNo) ? 'Provided' : 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt>Corporate buyer</dt>
                                    <dd>{{ $buyer->CorporateBuyer ?? 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt>Preferred terms</dt>
                                    <dd>{{ $buyer->Group ?? 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt>Month expiration date</dt>
                                    <dd>{{ $buyer->ExpDate ?? 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt>Email opt out</dt>
                                    <dd>{{ $buyer->OptOut ?? 'N/A' }}</dd>
                                </div>
                            </dl>
                        </div>
                        <div class="detail-group">
                            <h3>Personal and employment</h3>
                            <dl class="detail-list">
                                <div>
                                    <dt>Partner name</dt>
                                    <dd>{{ $buyer->PartnerName ?? 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt>Partner phone</dt>
                                    <dd>{{ $buyer->PartnerPhone ?? 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt>Current employment</dt>
                                    <dd>{{ $buyer->CurrentEmploy ?? 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt>Motivation</dt>
                                    <dd>
                                        @switch((string) ($buyer->Interest ?? ''))
                                            @case('1')
                                                Hot
                                            @break

                                            @case('2')
                                                Medium
                                            @break

                                            @case('3')
                                                Cold
                                            @break

                                            @default
                                                N/A
                                        @endswitch
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </section>

                <section class="listing-card">
                    <div class="section-heading-row">
                        <h2>Business interest</h2>
                    </div>
                    <div class="details-grid">
                        <div class="detail-group">
                            <h3>Preferred business types</h3>
                            <dl class="detail-list">
                                <div>
                                    <dt>Business type 1</dt>
                                    <dd>{{ $businessTypes[$buyer->BusType1 ?? ''] ?? 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt>Business type 2</dt>
                                    <dd>{{ $businessTypes[$buyer->BusType2 ?? ''] ?? 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt>Business type 3</dt>
                                    <dd>{{ $businessTypes[$buyer->BusType3 ?? ''] ?? 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt>Business type 4</dt>
                                    <dd>{{ $businessTypes[$buyer->BusType4 ?? ''] ?? 'N/A' }}</dd>
                                </div>
                            </dl>
                        </div>
                        <div class="detail-group">
                            <h3>Preferred locations</h3>
                            <dl class="detail-list">
                                <div>
                                    <dt>Desired county 1</dt>
                                    <dd>{{ $buyer->BusCounty1 ?? 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt>Desired county 2</dt>
                                    <dd>{{ $buyer->BusCounty2 ?? 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt>Desired county 3</dt>
                                    <dd>{{ $buyer->BusCounty3 ?? 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt>Desired county 4</dt>
                                    <dd>{{ $buyer->BusCounty4 ?? 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt>Desired location</dt>
                                    <dd>{{ $buyer->BusLocation ?? 'N/A' }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </section>

                <section class="listing-card">
                    <div class="section-heading-row">
                        <h2>Pricing and financial information</h2>
                    </div>
                    <div class="details-grid">
                        <div class="detail-group">
                            <h3>Financial requirements</h3>
                            <dl class="detail-list">
                                <div>
                                    <dt>Maximum price</dt>
                                    <dd>{{ isset($buyer->PPMax) ? number_format((float) $buyer->PPMax, 2) : 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt>Maximum down payment</dt>
                                    <dd>{{ isset($buyer->DownPmtMax) ? number_format((float) $buyer->DownPmtMax, 2) : 'N/A' }}
                                    </dd>
                                </div>
                                <div>
                                    <dt>Minimum annual sales</dt>
                                    <dd>{{ isset($buyer->VolMin) ? number_format((float) $buyer->VolMin, 2) : 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt>Minimum net profit</dt>
                                    <dd>{{ isset($buyer->NetProfMin) ? number_format((float) $buyer->NetProfMin, 2) : 'N/A' }}
                                    </dd>
                                </div>
                            </dl>
                        </div>
                        <div class="detail-group">
                            <h3>Probable match criteria</h3>
                            <dl class="detail-list">
                                <div>
                                    <dt>Business interest</dt>
                                    <dd>{{ $buyer->BusInt ?? 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt>Location</dt>
                                    <dd>{{ $buyer->Location ?? 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt>Price</dt>
                                    <dd>{{ $buyer->Price ?? 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt>Down payment</dt>
                                    <dd>{{ $buyer->DownPay ?? 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt>Sales volume</dt>
                                    <dd>{{ $buyer->SalesVol ?? 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt>Profit</dt>
                                    <dd>{{ $buyer->Profit ?? 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt>Total</dt>
                                    <dd>{{ $buyer->Total ?? 'N/A' }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </section>
            </main>

            <aside class="listing-side-column">
                <section class="listing-card side-card">
                    <h2>Buyer summary</h2>
                    <div class="side-info-item"><span>Buyer ID</span><strong>{{ $buyer->BuyerID }}</strong></div>
                    <div class="side-info-item"><span>Assigned
                            agent</span><strong>{{ trim(($agent->FName ?? '') . ' ' . ($agent->LName ?? '')) ?: 'Unassigned' }}</strong>
                    </div>
                    <div class="side-info-item"><span>Email</span><strong>{{ $buyer->Email ?? 'N/A' }}</strong></div>
                    <div class="side-info-item">
                        <span>Phone</span><strong>{{ $buyer->HomePhone ?: ($buyer->BusPhone ?: 'N/A') }}</strong></div>
                    <div class="side-info-item"><span>Motivation</span><strong>
                            @switch((string) ($buyer->Interest ?? ''))
                                @case('1')
                                    Hot
                                @break

                                @case('2')
                                    Medium
                                @break

                                @case('3')
                                    Cold
                                @break

                                @default
                                    N/A
                            @endswitch
                        </strong></div>
                    @if ($ndaExists)
                        <a href="{{ route('buyer.nda.form.download', $buyer->user_id) }}" class="quick-action">
                            <span><i class="fa fa-download"></i></span> Download NDA Form <i
                                class="fa fa-chevron-right"></i>
                        </a>
                    @endif
                </section>

                <section class="listing-card side-card">
                    <h2>Quick links</h2>
                    <a href="{{ route('edit.buyer.form', $buyer->BuyerID) }}" class="quick-action">
                        <span><i class="fa fa-pencil-alt"></i></span> Edit buyer <i class="fa fa-chevron-right"></i>
                    </a>
                    @if ($ndaExists)
                        <a href="{{ route('buyer.nda.form.download', $buyer->user_id) }}" class="quick-action">
                            <span><i class="fa fa-download"></i></span> Download NDA form <i
                                class="fa fa-chevron-right"></i>
                        </a>
                    @endif
                    @if (!empty($buyer->Email))
                        <a href="mailto:{{ $buyer->Email }}" class="quick-action">
                            <span><i class="fa fa-envelope"></i></span> Send email <i class="fa fa-chevron-right"></i>
                        </a>
                    @endif
                    @if (!empty($buyer->HomePhone) || !empty($buyer->BusPhone))
                        <a href="tel:{{ $buyer->HomePhone ?: $buyer->BusPhone }}" class="quick-action">
                            <span><i class="fa fa-phone"></i></span> Call buyer <i class="fa fa-chevron-right"></i>
                        </a>
                    @endif
                </section>

            </aside>
        </div>
    </div>
@endsection
