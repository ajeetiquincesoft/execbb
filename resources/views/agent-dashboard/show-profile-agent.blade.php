@extends('agent-dashboard.layout.master')
@section('content')
<div class="container-fluid content bg-light">
      <div class="row">
        <div class="col-md-5">
          <div class="card">
            <div class="card-body">
              <div class="profile-info">
                <div class="text-end">
                  <a href="{{route('agent.edit.profile',$user->id)}}"><i  class="fa fa-edit edit-icon"></i></a>
                </div>
                <div class="text-center">
                    <form action="{{ route('agent.upload.agent.avatar',$user->agent_info->AgentUserRegisterId ) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="avatar-upload">
                          <input type="file" id="avatar" name="avatar" accept="image/*" onchange="previewImage(event)">
                          <label for="avatar" class="circular-image">
                          @if($user->agent_info->image)
                              <img id="avatar-preview" src="{{ asset('assets/uploads/images/' . $user->agent_info->image) }}" alt="Avatar Preview" class="avatar">
                              @else
                              <img id="avatar-preview" src="{{ asset('assets/images/avatar.png') }}" alt="Avatar Preview" class="avatar">
                              @endif
                          </label>
                        </div>
                        <button class="avatar_img_upload" type="submit">Upload Image</button>
                    </form>
                  <!-- <img src="{{ url('assets/images/user.png') }}" alt="User Image" width="100"> -->
                  <h5>{{$user->name}}</h5>
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
                        <td class="text-end">{{$user->agent_info->FName}} {{$user->agent_info->LName}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/phone.png') }}" alt=""><span class="ml-2 fw-600">Phone</span></td>
                        <td class="text-end">{{$user->agent_info->Telephone}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/pager.png') }}" alt=""><span class="ml-2 fw-600">Pager</span></td>
                        <td class="text-end">{{$user->agent_info->Pager}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/fax.png') }}" alt=""><span class="ml-2 fw-600">fax</span></td>
                        <td class="text-end">{{$user->agent_info->Fax}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/email.png') }}" alt=""><span class="ml-2 fw-600">Email</span></td>
                        <td class="text-end">{{$user->agent_info->Email}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/location.png') }}" alt=""><span class="ml-2 fw-600">Address</span></td>
                        <td class="text-end">{{$user->agent_info->Address1	}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/location.png') }}" alt=""><span class="ml-2 fw-600">City</span></td>
                        <td class="text-end">{{$user->agent_info->City}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/exp_date.png') }}" alt=""><span class="ml-2 fw-600">Date of Birth</span></td>
                        <td class="text-end">{{$user->agent_info->DOB}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/spouse.png') }}" alt=""><span class="ml-2 fw-600">Spouse</span></td>
                        <td class="text-end">{{$user->agent_info->Spouse}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/exp_date.png') }}" alt=""><span class="ml-2 fw-600">Hire Date</span></td>
                        <td class="text-end">{{$user->agent_info->HireDate}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/exp_date.png') }}" alt=""><span class="ml-2 fw-600">Terminated</span></td>
                        <td class="text-end">{{$user->agent_info->Termination}}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-7">
          <div class="card">
            <div class="card-header">
              <h5>Activities</h5>
            </div>
            <div class="card-body scrollable-activity">
              <div class="activity mt-2">
                <div class="activity-title fw-bold">Unknown</div>
                <div class="activity-time"><small class="profile-time">12:00 Yesterday</small></div>
                <div class="activity-content ">
                  Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                  industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                  scrambled it to make a type specimen book.
                </div>
              </div>
              <div class="activity mt-2">
                <div class="activity-title fw-bold">Unknown</div>
                <div class="activity-time"><small class="profile-time">12:00 Yesterday</small></div>
                <div class="activity-content ">
                  Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                  industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                  scrambled it to make a type specimen book.
                </div>
              </div>
              <div class="activity mt-2">
                <div class="activity-title fw-bold">Unknown</div>
                <div class="activity-time"><small class="profile-time">12:00 Yesterday</small></div>
                <div class="activity-content ">
                  Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                  industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                  scrambled it to make a type specimen book.
                </div>
              </div>
              <div class="activity mt-2">
                <div class="activity-title fw-bold">Unknown</div>
                <div class="activity-time"><small class="profile-time">12:00 Yesterday</small></div>
                <div class="activity-content ">
                  Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                  industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                  scrambled it to make a type specimen book.
                </div>
              </div>
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

