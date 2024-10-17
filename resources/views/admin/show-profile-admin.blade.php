@extends('admin.layout.master')
@section('content')
<div class="container-fluid content bg-light">
      <div class="row">
        <div class="col-md-5">
          <div class="card">
            <div class="card-body">
              <div class="profile-info">
                <div class="text-end">
                  <a href="{{route('edit.profile',$user->id)}}"><i  class="fa fa-edit edit-icon"></i></a>
                </div>
                <div class="text-center">
                  <img src="{{ url('assets/images/user.png') }}" alt="User Image" width="100">
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
                        <td class="text-end">{{$user->name}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/email.png') }}" alt=""><span class="ml-2 fw-600">Email</span></td>
                        <td class="text-end">{{$user->email}}</td>
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

