@extends('agent-dashboard.layout.master')
@section('content')
    <div class="container-fluid content nextPreviousButtons">
        <div class="next-back-page d-flex justify-content-between align-items-center">

            {{-- Previous Record --}}
            <div>
                @if ($previous)
                    <a href="{{ route('agent.show.buyer', $previous->BuyerID) }}" class="record-nav-btn previous-btn">
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

            {{-- Next Record --}}
            <div>
                @if ($next)
                    <a href="{{ route('agent.show.buyer', $next->BuyerID) }}" class="record-nav-btn next-btn">
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

                            <div class="text-center">
                                <img id="avatar-preview" src="{{ asset('assets/images/user.png') }}" alt="Avatar Preview"
                                    width="100">
                                <h5>{{ $buyer->FName }} {{ $buyer->LName }}</h5>
                                <h6>{{ $buyer->BuyerID }}</h6>
                            </div>
                            {{-- General Info --}}
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

                            {{-- Personal Business --}}
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

                            {{-- Business Interest --}}
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

                            {{-- Pricing and Financial Information --}}
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

                            {{-- Probable Match Criteria --}}
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
                            @if ($hasBuyerSignedNda)
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
    </div>
@endsection
