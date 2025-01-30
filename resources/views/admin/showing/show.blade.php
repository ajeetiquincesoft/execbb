@extends('admin.layout.master')
@section('content')
<div class="container-fluid content nextPreviousButtons">
  <div class="next-back-page d-flex justify-content-between">
    @if ($previous)
    <a href="{{ route('show.showing', $previous->ShowingID) }}"><button><i class="fa fa-chevron-left"></i></button></a>
    @endif

    @if ($next)
    <a href="{{ route('show.showing', $next->ShowingID) }}"><button><i class="fa fa-chevron-right"></i></button></a>
    @endif
  </div>
</div>
<div class="container-fluid content bg-light">
  <div class="row">
    <div class="col-md-12 col-lg-12 col-xl-5 mb-5 mb-xl-0">
      <div class="card">
        <div class="card-body">
          <div class="profile-info">
            <div class="text-end">
              <a href="{{route('edit.showing',$showing->ShowingID)}}"><i class="fa fa-edit edit-icon"></i></a>
            </div>
            <div class="text-center">
              <img id="avatar-preview" src="{{ asset('assets/images/user.png') }}" alt="Avatar Preview" width="100">
              <h5>{{$dbaName[$showing->ListingID] ?? 'N/A'}}</h5>
              <h6>Showing ID: {{$showing->ShowingID}}</h6>
            </div>
            <div class="table-responsive">
              <div>
                <h6>General Info</h6>
              </div>
              <table class="table table-borderless">
                <tbody>
                  <tr>
                    <td><img src="{{ url('assets/images/company.png') }}" alt=""><span class="ml-2 fw-600">Agent</span></td>
                    <td class="text-end">{{ $showing->AgentID }}</td>
                  </tr>
                  <tr>
                    <td><img src="{{ url('assets/images/company.png') }}" alt=""><span class="ml-2 fw-600">Buyer</span></td>
                    <td class="text-end">{{$buyerName[$showing->BuyerID] ?? 'N/A'}}</td>
                  </tr>
                  <tr>
                    <td><img src="{{ url('assets/images/press_owner.png') }}" alt=""><span class="ml-2 fw-600">Date</span></td>
                    <td class="text-end">{{$showing->Date}}</td>
                  </tr>
                  <tr>
                    <td><img src="{{ url('assets/images/location.png') }}" alt=""><span class="ml-2 fw-600">DBA</span></td>
                    <td class="text-end">{{$dbaName[$showing->ListingID] ?? 'N/A'}}</td>
                  </tr>
                  <tr>
                    <td><img src="{{ url('assets/images/location.png') }}" alt=""><span class="ml-2 fw-600">Offer Made</span></td>
                    <td class="text-end">{{$showing->OfferMade}}</td>
                  </tr>
                  <tr>
                    <td><img src="{{ url('assets/images/phone.png') }}" alt=""><span class="ml-2 fw-600">Follow Up</span></td>
                    <td class="text-end">{{$showing->FollowUp}}</td>
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
</script>
@endsection