@extends('admin.layout.master')
@section('content')
<div class="container-fluid content nextPreviousButtons">
  <div class="next-back-page d-flex justify-content-between">
    @if ($previous)
    <a href="{{ route('show.buyer', $previous->BuyerID) }}"><button><i class="fa fa-chevron-left"></i></button></a>
    @endif

    @if ($next)
    <a href="{{ route('show.buyer', $next->BuyerID) }}"><button><i class="fa fa-chevron-right"></i></button></a>
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
              <img id="avatar-preview" src="{{ asset('assets/images/user.png') }}" alt="Avatar Preview" width="100">
              <h5>{{$buyer->FName}} {{$buyer->LName}}</h5>
              <h6>{{$buyer->BuyerID }}</h6>
            </div>
            <div class="table-responsive">
              <div>
                <h6>General Info</h6>
                <hr>
              </div>
              <table class="table table-borderless">
                <tbody>
                  <tr>
                    <td><img src="{{ url('assets/images/company.svg') }}" alt=""><span class="ml-2 fw-600">Name</span></td>
                    <td class="text-end">{{$buyer->FName}} {{$buyer->LName}}</td>
                  </tr>
                  <tr>
                    <td><img src="{{ url('assets/images/phone.png') }}" alt=""><span class="ml-2 fw-600">Phone</span></td>
                    <td class="text-end">{{$buyer->HomePhone}}</td>
                  </tr>
                  <tr>
                    <td><img src="{{ url('assets/images/email.png') }}" alt=""><span class="ml-2 fw-600">Email</span></td>
                    <td class="text-end">{{$buyer->Email}}</td>
                  </tr>
                  <tr>
                    <td><img src="{{ url('assets/images/location.png') }}" alt=""><span class="ml-2 fw-600">Address</span></td>
                    <td class="text-end">{{$buyer->Address1 }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
            @if(!empty($hasSignedNda))
            <a href="{{route('buyer.nda.form.download', $buyer->user_id)}}" class=""><i class="fa fa-download"></i> Download NDA Form</a>
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