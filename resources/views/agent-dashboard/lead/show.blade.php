@extends('agent-dashboard.layout.master')
@section('content')
<div class="container-fluid content nextPreviousButtons">
  <div class="next-back-page d-flex justify-content-between">
    @if ($previous)
    <a href="{{ route('agent.show.lead', $previous->LeadID) }}"><button><i class="fa fa-chevron-left"></i></button></a>
    @endif

    @if ($next)
    <a href="{{ route('agent.show.lead', $next->LeadID) }}"><button><i class="fa fa-chevron-right"></i></button></a>
    @endif
  </div>
</div>
<div class="container-fluid content bg-light">
  <div class="row">
    <div class="col-md-12 col-lg-12 col-xl-5 mb-5 mb-xl-0">
      <div class="card">
        <div class="card-body">
          <div class="profile-info">
            <div class="text-center">
              <img src="{{ url('assets/images/user.png') }}" alt="User Image" width="100">
              <h5>{{$lead->SellerFName}} {{$lead->SellerLName}}</h5>
              <h6>Lead ID: {{$lead->LeadID }}</h6>
            </div>
            <div class="table-responsive">
              <div>
                <h6>General Info</h6>
              </div>
              <table class="table table-borderless">
                <tbody>
                  <tr>
                    <td><img src="{{ url('assets/images/company.svg') }}" alt=""><span class="ml-2 fw-600">Business Name</span></td>
                    <td class="text-end">{{$lead->BusName}}</td>
                  </tr>
                  <tr>
                    <td><img src="{{ url('assets/images/fax.png') }}" alt=""><span class="ml-2 fw-600">Category</span></td>
                    <td class="text-end">{{$lead->Category}}</td>
                  </tr>
                  <tr>
                    <td><img src="{{ url('assets/images/phone.png') }}" alt=""><span class="ml-2 fw-600">Phone</span></td>
                    <td class="text-end">{{$lead->Phone}}</td>
                  </tr>
                  <tr>
                    <td><img src="{{ url('assets/images/email.png') }}" alt=""><span class="ml-2 fw-600">Email</span></td>
                    <td class="text-end"></td>
                  </tr>
                  <tr>
                    <td><img src="{{ url('assets/images/location.png') }}" alt=""><span class="ml-2 fw-600">Address</span></td>
                    <td class="text-end">{{$lead->Address}}</td>
                  </tr>
                  <tr>
                    <td><img src="{{ url('assets/images/exp_date.png') }}" alt=""><span class="ml-2 fw-600">Appointment</span></td>
                    <td class="text-end">{{$lead->AppointmentDate}}</td>
                  </tr>

                  <tr>
                    <td><img src="{{ url('assets/images/approx_sale.png') }}" alt=""><span class="ml-2 fw-600">Approx. Sales</span></td>
                    <td class="text-end">{{$lead->AnnSales}}</td>
                  </tr>
                  <tr>
                    <td><img src="{{ url('assets/images/ask_sale.png') }}" alt=""><span class="ml-2 fw-600">Ask Sales</span></td>
                    <td class="text-end">{{$lead->REAsking}}</td>
                  </tr>
                  <tr>
                    <td><img src="{{ url('assets/images/ask_sale.png') }}" alt=""><span class="ml-2 fw-600">Years In Bus</span></td>
                    <td class="text-end">{{$lead->YearsInBus}}</td>
                  </tr>
                  <tr>
                    <td><img src="{{ url('assets/images/press_owner.png') }}" alt=""><span class="ml-2 fw-600">Press Owner</span></td>
                    <td class="text-end">{{$lead->PresentOwner}}</td>
                  </tr>
                  <tr>
                    <td><img src="{{ url('assets/images/size_of_facility.png') }}" alt=""><span class="ml-2 fw-600">Size of Facility</span></td>
                    <td class="text-end">{{$lead->SizeOfFacility}}</td>
                  </tr>
                  <tr>
                    <td><img src="{{ url('assets/images/price.png') }}" alt=""><span class="ml-2 fw-600">If Yes Asking Price</span></td>
                    <td class="text-end">{{$lead->REAsking}}</td>
                  </tr>
                  <tr>
                    <td><img src="{{ url('assets/images/ad_date.png') }}" alt=""><span class="ml-2 fw-600">Ad Date</span></td>
                    <td class="text-end">{{$lead->AdDate}}</td>
                  </tr>
                  <tr>
                    <td><img src="{{ url('assets/images/ask_sale.png') }}" alt=""><span class="ml-2 fw-600">FSBO</span></td>
                    <td class="text-end">{{$lead->FSBO}}</td>
                  </tr>
                  <tr>
                    <td><img src="{{ url('assets/images/ad_copy.png') }}" alt=""><span class="ml-2 fw-600">Ad Copy</span></td>
                    <td class="text-end">{{$lead->AdCopy}}</td>
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
          @foreach($activities as $activity)
          <div class="activity mt-2">
            @php
            $user = App\Models\User::find($activity->user_id);
            @endphp
            <div class="activity-title fw-bold">{{ $activity->action }} by {{ ucfirst($user->name) }}</div>
            <div class="activity-time"><small class="profile-time">{{ $activity->created_at->format('H:i') }}
                @if ($activity->created_at->isYesterday())
                Yesterday
                @else
                {{ $activity->created_at->diffForHumans() }}
                @endif</small></div>
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