@extends('admin.layout.master')
@section('content')
<div class="container-fluid content nextPreviousButtons">
  <div class="next-back-page d-flex justify-content-between">
    @if ($previous)
    <a href="{{ route('show.agent', $previous->id) }}"><button><i class="fa fa-chevron-left"></i></button></a>
    @endif

    @if ($next)
    <a href="{{ route('show.agent', $next->id) }}"><button><i class="fa fa-chevron-right"></i></button></a>
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
              <a href="{{route('edit.agent',$agent->id)}}"><i class="fa fa-edit edit-icon"></i></a>
            </div>
            <div class="text-center">
              <form action="{{ route('upload.agent.avatar',$agent->agent_info->AgentUserRegisterId ) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="avatar-upload">
                  <input type="file" id="avatar" name="avatar" accept="image/*" onchange="previewImage(event)">
                  <label for="avatar" class="circular-image">
                    @if($agent->agent_info->image)
                    <img id="avatar-preview" src="{{ asset('assets/uploads/images/' . $agent->agent_info->image) }}" alt="Avatar Preview" class="avatar">
                    @else
                    <img id="avatar-preview" src="{{ asset('assets/images/avatar.png') }}" alt="Avatar Preview" class="avatar">
                    @endif
                  </label>
                </div>
                <button class="avatar_img_upload" type="button" onclick="confirmImage(this.form)">Confirm Image</button>
              </form>
              <h5>{{$agent->agent_info->FName}} {{$agent->agent_info->LName}}</h5>
              <h6>{{$agent->agent_info->AgentID }}</h6>
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
                    <td class="text-end">{{$agent->agent_info->FName}} {{$agent->agent_info->LName}}</td>
                  </tr>
                  <tr>
                    <td><img src="{{ url('assets/images/phone.png') }}" alt=""><span class="ml-2 fw-600">Phone</span></td>
                    <td class="text-end">{{$agent->agent_info->Telephone}}</td>
                  </tr>
                  <tr>
                    <td><img src="{{ url('assets/images/pager.png') }}" alt=""><span class="ml-2 fw-600">Pager</span></td>
                    <td class="text-end">{{$agent->agent_info->Pager}}</td>
                  </tr>
                  <tr>
                    <td><img src="{{ url('assets/images/fax.png') }}" alt=""><span class="ml-2 fw-600">fax</span></td>
                    <td class="text-end">{{$agent->agent_info->Fax}}</td>
                  </tr>
                  <tr>
                    <td><img src="{{ url('assets/images/email.png') }}" alt=""><span class="ml-2 fw-600">Email</span></td>
                    <td class="text-end">{{$agent->agent_info->Email}}</td>
                  </tr>
                  <tr>
                    <td><img src="{{ url('assets/images/location.png') }}" alt=""><span class="ml-2 fw-600">Address</span></td>
                    <td class="text-end">{{$agent->agent_info->Address1 }}</td>
                  </tr>
                  <tr>
                    <td><img src="{{ url('assets/images/location.png') }}" alt=""><span class="ml-2 fw-600">City</span></td>
                    <td class="text-end">{{$agent->agent_info->City}}</td>
                  </tr>
                  <tr>
                    <td><img src="{{ url('assets/images/exp_date.png') }}" alt=""><span class="ml-2 fw-600">Date of Birth</span></td>
                    <td class="text-end">{{$agent->agent_info->DOB}}</td>
                  </tr>
                  <tr>
                    <td><img src="{{ url('assets/images/spouse.png') }}" alt=""><span class="ml-2 fw-600">Spouse</span></td>
                    <td class="text-end">{{$agent->agent_info->Spouse}}</td>
                  </tr>
                  <tr>
                    <td><img src="{{ url('assets/images/exp_date.png') }}" alt=""><span class="ml-2 fw-600">Hire Date</span></td>
                    <td class="text-end">{{$agent->agent_info->HireDate}}</td>
                  </tr>
                  <tr>
                    <td><img src="{{ url('assets/images/exp_date.png') }}" alt=""><span class="ml-2 fw-600">Terminated</span></td>
                    <td class="text-end">{{$agent->agent_info->Termination}}</td>
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