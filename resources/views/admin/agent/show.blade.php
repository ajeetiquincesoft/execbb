@extends('admin.layout.master')
@section('content')
<div class="container-fluid content" style="background-color: #f8f9fa; padding: 2rem 2rem 0rem 2rem;">
    <div class="next-back-page d-flex justify-content-between">
        @if ($previous)
            <a href="{{ route('show.agent', $previous->id) }}"><button><i class="fa fa-chevron-left"></i>Back</button></a>
        @endif

        @if ($next)
            <a href="{{ route('show.agent', $next->id) }}"><button>Next <i class="fa fa-chevron-right"></i></button></a>
        @endif
        
        
    </div>
</div>
<div class="container-fluid content bg-light">
      <div class="row">
        <div class="col-md-5">
          <div class="card">
            <div class="card-body">
              <div class="profile-info">
                <div class="text-end">
                  <a href="{{route('edit.agent',$agent->id)}}"><i  class="fa fa-edit edit-icon"></i></a>
                </div>
                <div class="text-center">
                  <img src="{{ url('assets/images/user.png') }}" alt="User Image" width="100">
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
                        <td class="text-end">{{$agent->agent_info->Address1	}}</td>
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
@endsection

